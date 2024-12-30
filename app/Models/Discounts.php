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
        'endDate',
        'status'
    ];
   public function isValid()
    {
        $now = now();
        return $now <= $this->endDate;  
    }

    public function updateStatusBasedOnDate()
    {
        $this->status = $this->isValid() ? 1 : 0;
        $this->save();
    }
    
    public function product(){
        return $this->belongsTo(Products::class, 'productId');
    }
}
