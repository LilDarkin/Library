<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'genre', 'image_path'];

    public function borrowedBooks()
    {
        return $this->hasMany(BorrowedBooks::class);
    }
}
