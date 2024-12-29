<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $fillable = [
        'orderId',
        'productId',
        'sizeId',
        'colorId',
        'quantity',
        'price',
        'discount_percentage',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'productId', 'id');
    }

    public function media()
    {
        return $this->hasOne(ProductMedia::class, 'productId', 'productId')
            ->where('mainImage', 1);
    }


    public function size()
    {
        return $this->belongsTo(AttributeValues::class, 'sizeId', 'id');
    }

    public function color()
    {
        return $this->belongsTo(AttributeValues::class, 'colorId', 'id');
    }
}
