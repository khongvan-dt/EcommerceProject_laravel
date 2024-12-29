<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewBlogs extends Model
{
    use HasFactory;

    protected $table ='review_blogs';

    protected $fillable = [
        'userId', 
        'blogId', 
        'rating', 
        'comment',
        'status',
    ];

    public function blog()
    {
        return $this->belongsTo(Blogs::class);
    }
}
