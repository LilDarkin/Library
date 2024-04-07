<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\BorrowedBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BorrowedBooksController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user()->role;
        $permission = false;
        if ($user == 0 || $user == 3) {
            $permission = true;
        }

        if ($permission == true) {
            $borrowed_books = BorrowedBooks::all();
        } else {
            $borrowed_books = BorrowedBooks::where('borrower', Auth::user()->student_no ?? Auth::user()->emp_no)->get();
        }

        $borrowed_books->transform(function ($borrow) {
            $borrow->book_name = Books::find($borrow->book_id)->title;
            $borrow->borrower_id = $borrow->borrower;
            $borrow->status_name = BorrowedBooks::STATUSES[$borrow->status];
            return $borrow;
        });

        return Inertia::render('Borrow/Index', [
            'permission' => $permission,
            'borrowed_books' => $borrowed_books
        ]);
    }

    public function store(Request $request)
    {
        BorrowedBooks::create([
            'book_id' => $request->book_id,
            'borrower' => $request->user_id,
            'status' => 0,
        ]);

        return response()->json(['message' => 'Book borrowed successfully!']);
    }

    public function edit(Request $request, $id) {
        $borrowed_book = BorrowedBooks::where('id', $id)->first();
        $borrowed_book->status = BorrowedBooks::STATUS[$request->status];
        $borrowed_book->save();
        return response()->json(['message' => 'Record updated successfully!']);
    }

    public function view($id)
    {
        $borrowed_book = BorrowedBooks::find($id);
        $book = Books::find($borrowed_book->book_id);
        if ($book) {
            $book->genre = ucfirst($book->genre);
            $book->status = BorrowedBooks::STATUSES[$borrowed_book->status];
        }

        Log::info($borrowed_book);
        return response()->json($book);
    }

    public function destroy($id)
    {

        $borrowed_book = BorrowedBooks::where('id', $id)->first();
        $borrowed_book->delete();
        return response()->json(['message' => 'Record deleted successfully!']);
    }
}
