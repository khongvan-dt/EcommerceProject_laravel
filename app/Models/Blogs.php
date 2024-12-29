<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title', 
        'slug', 
        'content',
        'image',
        'status',
    ];

    public function reviews()
    {
        return $this->hasMany(ReviewBlogs::class)->onDelete('cascade');;
    }
}
