<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'status',
    ];

    public function attributeValues()
    {
        return $this->hasMany(AttributeValues::class, 'attributeId', 'id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'attributeId');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_attribute', 'attributeId', 'productId');
    }
}
