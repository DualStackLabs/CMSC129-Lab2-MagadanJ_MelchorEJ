<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color_theme'];

    public function entries()
    {
        return $this->hasMany(\App\Models\Entry::class);
    }
}