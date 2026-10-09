<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi
    protected $fillable = ['title', 'slug', 'content', 'image', 'views'];

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
