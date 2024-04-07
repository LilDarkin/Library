<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BooksController extends Controller
{
    //
    public function index() {
        $user = Auth::user()->role;
        $permission = false;
        if ($user == 0 || $user == 3) {
            $permission = true;
        }

        $books = Books::all();

        return Inertia::render('Books/Index', [
            'books' => $books,
            'permission' => $permission
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'genre' => 'required',
        ]);

        Books::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'description' => $request->description,
            'image_path' => $request->image_path,
        ]);

        return response()->json(['message' => 'Book created successfully!']);
    }

    public function edit(Request $request, $id) {
        $book = Books::where('id', $id)->first();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->description = $request->description;
        $book->image_path = $request->image_path;
        $book->save();
        return response()->json(['message' => 'Book updated successfully!']);
    }

    public function destroy($id) {
        $book = Books::where('id', $id)->first();
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully!']);
    }
}
