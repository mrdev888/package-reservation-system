<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//route for getting list of all orders along with related data
Route::get('orders', [OrderController::class, 'index']);

//route for posting(creating) a new order and related order_package model
Route::post('orders', [OrderController::class, 'store']);
