<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'name', 
        'description', 
        'logo', 
        'description',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'brandId', 'id');
    }
}
