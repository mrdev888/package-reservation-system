<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'first_name',
      'last_name',
      'email',
      'phone',
      'total',
      'total_fee',
      'status',
      'created_at',
      'updated_at',
    ];

    protected $casts = [
      'total' => 'float',
      'total_fee' => 'float',
    ];

    public function order_packages()
    {
        return $this->hasMany(OrderPackage::class, 'order_id');
    }
}
