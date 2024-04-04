<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emp_no',
        'name',
        'email',
        'contact',
        'department',
    ];
    
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
