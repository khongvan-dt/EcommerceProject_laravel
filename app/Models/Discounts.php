<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = [
        'productId',
        'discountPercentage',
        'startDate',
        'endDate'
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'productId');
    }
}
