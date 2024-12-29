<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'userId',
        'totalPrice',
        'discountAmount',
        'voucherCode',
        'status',
        'paymentMethod',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
