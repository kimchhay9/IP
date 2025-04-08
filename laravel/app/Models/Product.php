<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'category_id', 'pricing', 'description', 'images'];
    protected $dates = ['deleted_at']; // Enable soft delete timestamps

    protected $casts = [
        'images' => 'array', // Ensures images are stored as JSON
    ];

    public function category() // Changed from categories() to category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
