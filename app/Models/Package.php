<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'type',
      'name',
      'price',
      'fee',
      'duration_hours',
      'created_at',
      'updated_at',
    ];

    protected $casts = [
      'price' => 'float',
      'fee' => 'float',
      'duration_hours' => 'int',
    ];

    public function order_packages()
    {
        return $this->hasMany(OrderPackage::class, 'package_id');
    }
}
