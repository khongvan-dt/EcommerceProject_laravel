<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewProducts extends Model
{
    use HasFactory;

    protected $table ='review_products';

    protected $fillable = [
        'userId', 
        'productId', 
        'rating', 
        'comment',
        'status',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'productId', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
