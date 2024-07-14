<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    // Fillable attributes
    protected $fillable = ['name', 'user_id'];

    // Define the relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with books
    public function books()
    {
        return $this->belongsToMany(Book::class, 'shelf', 'categories_id', 'book_id');
    }
}
