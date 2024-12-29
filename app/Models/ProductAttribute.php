<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attribute';
    protected $fillable = [
        'productId',
        'attributeId'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'productId');
    }
}
