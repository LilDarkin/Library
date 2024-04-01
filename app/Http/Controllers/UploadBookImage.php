<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UploadBookImage extends Controller
{
    public function uploadFile(Request $request) {
        // Validate the request
        $request->validate([
            'file' => 'required|file',
        ]);

        // Retrieve the file from the request
        $file = $request->file('file');

        // Store the file in the local storage
        $path = Storage::disk('local')->put('books/images/', $file);

        // Optionally, you can return the path of the uploaded file
        return response()->json(['path' => $path]);
    }
}
