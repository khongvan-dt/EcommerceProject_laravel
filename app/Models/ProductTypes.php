<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    use HasFactory;

    protected $table = 'product_types';

    protected $fillable = [
        'productId',
        'typeId',
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'productId');
    }

    public function type(){
        return $this->belongsTo(Types::class, 'typeId');
    }
}
