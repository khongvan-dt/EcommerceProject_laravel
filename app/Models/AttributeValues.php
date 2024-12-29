<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValues extends Model
{
    use HasFactory;

    protected $table = "attribute_values";

    protected $fillable = [
        'attributeId',
        'name',
        'stock',
        'priceIn',
        'priceOut',
        'status',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attributes::class, 'attributeId');
    }
}
