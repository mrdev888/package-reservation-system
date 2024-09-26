<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPackage;
use App\Models\Package;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'order_packages',
            'order_packages.package'
        ])
            ->get();

        return response()->json($orders);
    }

    public function store(Request $request)
    {
        //validate the request data
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'package_id' => 'required|numeric|exists:packages,id',
            'tickets_purchased' => 'required|numeric',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email specified.',
            'phone.required' => 'Phone number is required.',
            'package_id.required' => 'Package ID is required.',
            'package_id.numeric' => 'Package ID should be numeric.',
            'package_id.exists' => "This package ID doesn't exists.",
            'tickets_purchased.required' => 'Tickets purchased is required.',
            'tickets_purchased.numeric' => 'Tickets purchased should be numeric.',
        ]);

        //get the selected package from the database
        $package = Package::find($request->get('package_id'));

        //first create the order model
        $order = Order::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'created_at' => now(),
        ]);

        //create the related order_package model
        $order_package = OrderPackage::create([
            'order_id' => $order->id,
            'package_id' => $package->id,
            'tickets_purchased' => $request->get('tickets_purchased'),
            'created_at' => now(),
        ]);

        //order created, now calculate the total and total_fee, also change status to approved
        $order->update([
            'total' => $package->price * $order_package->tickets_purchased,
            'total_fee' => $package->fee * $order_package->tickets_purchased,
            'status' => 'approved',
        ]);

        //return back the success message
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully.'
        ]);
    }
}
