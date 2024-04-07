<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UploadBookImage extends Controller
{
    public function uploadFile(Request $request) {
        
        $request->validate([
            'file' => 'required|image|max:2048', 
        ]);

        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->store('uploads', 'books');
            return response()->json(['path' => 'public/' . $path]);
        }

        return response()->json(['message' => ['File could not be uploaded.']], 500);
    }
}
