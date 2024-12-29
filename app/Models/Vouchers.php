<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    protected $fillable = [
        'code',
        'discountPercentage',
        'startDate',
        'endDate',
        'quantity',
        'minPurchaseAmount',
        'status',
    ];
}
