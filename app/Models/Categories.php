<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parend_id',
        'slug',
        'description',
        'status',
    ];

    public function parentId()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_category', 'categoryId', 'productId');
    }
}
