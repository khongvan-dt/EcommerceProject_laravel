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
}
