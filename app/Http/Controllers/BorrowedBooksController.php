<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BorrowedBooksController extends Controller
{
    //
    public function index() {

        return Inertia::render('Borrow/Index');
    }
}
