<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id'; // Set the primary key to 'id' since it's storing the book key
    public $incrementing = false; // 'id' is not auto-incrementing
    protected $keyType = 'string'; // Specify that 'id' is a string
    
    protected $fillable = ['id', 'title', 'author', 'description', 'subjects', 'cover']; // Include 'id' in the fillable fields

    protected $table = 'books'; // Specify the table name if it's different from the model's plural name

    // Define the relationship with categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'shelf', 'book_id', 'categories_id');
    }
}
