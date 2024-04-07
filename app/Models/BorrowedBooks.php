<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBooks extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'borrower', 'status'];

    public const STATUSES = [
        0 => 'PENDING',
        1 => 'BORROWED',
        2 => 'RETURNED',
        3 => 'OVERDUE',
        4 => 'LOST',
        5 => 'DAMAGED',
        6 => 'MISSING',
    ];

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
