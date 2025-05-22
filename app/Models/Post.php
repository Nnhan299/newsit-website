<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Bạn có thể định nghĩa các thuộc tính fillable nếu muốn
    protected $fillable = [
        'title', 
        'content', 
        'category_id', 
        'author',
        'image',
       
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Post.php (Model)

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    

}