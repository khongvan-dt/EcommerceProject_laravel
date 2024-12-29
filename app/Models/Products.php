<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'slug',
        'status',
        'brandId',
    ];

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brandId', 'id');
    }

    public function media()
    {
        return $this->hasMany(ProductMedia::class, 'productId', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_category', 'productId', 'categoryId');
    }

    public function mainImage()
    {
        return $this->hasOne(ProductMedia::class, 'productId', 'id')
            ->where('mainImage', '1');
    }

    public function attributeValues()
    {
        return $this->hasManyThrough(AttributeValues::class, ProductAttribute::class, 'productId', 'attributeId');
    }

    // Model Product
    public function attributes()
    {
        return $this->belongsToMany(Attributes::class, 'product_attribute', 'productId', 'attributeId');
    }


    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'productId');
    }

    public function types()
    {
        return $this->belongsToMany(Types::class, 'product_types', 'productId');
    }
}
