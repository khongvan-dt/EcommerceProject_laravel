<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    use HasFactory;

    protected $table = 'product_media';
    protected $fillable = [
        'productId', 
        'media_url', 
        'media_type',
        'mainImage'
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'productId', 'id');
    }
}
