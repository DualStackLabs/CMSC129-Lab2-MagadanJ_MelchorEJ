<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Brings in the soft delete powers!

class Entry extends Model
{
    // This line activates both standard model features and soft deletes
    use HasFactory, SoftDeletes; 

    // This is the security shield we built earlier
    protected $fillable = [
        'title', 
        'content', 
        'mood', 
        'location', 
        'is_favorite',
        'image',
        'category_id'
    ];

    // Inside app/Models/Entry.php
    public function category()
    {
        // Giving Laravel the absolute path so it can't possibly get lost!
        return $this->belongsTo(\App\Models\Category::class);
    }
}