<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'order_id',
      'package_id',
      'tickets_purchased',
      'created_at',
      'updated_at',
    ];

    protected $casts = [
      'tickets_purchased' => 'int',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
