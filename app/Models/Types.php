<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'name', 
        'status', 
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_types', 'typeId');
    }
}
