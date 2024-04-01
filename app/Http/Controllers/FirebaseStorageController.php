<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Storage\StorageClient;

class FirebaseStorageController extends Controller
{
    public function uploadFile(Request $request)
    {
        // Get the file from the request
        $uploadedFile = $request->file('file');

        // Check if file is valid
        if ($uploadedFile->isValid()) {
            // Get the filename
            $fileName = $uploadedFile->getClientOriginalName();

            // Move the file to a temporary location on your server
            $tempFilePath = $uploadedFile->storeAs('temp', $fileName);

            // Initialize StorageClient
            $storage = new StorageClient([
                'keyFilePath' => storage_path('firebase-credentials.json'),
                'verify' => storage_path('cacert.pem'),
            ]);

            // Get a bucket
            $bucket = $storage->bucket('library-e94c5.appspot.com');

            // Upload the file to Firebase Cloud Storage
            $bucket->upload(
                fopen(storage_path('app/' . $tempFilePath), 'r'),
                ['name' => 'path/to/remote/' . $fileName]
            );

            // Delete the file from the temporary location on your server
            unlink(storage_path('app/' . $tempFilePath));

            // Optionally, return a response or redirect
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            // File is not valid
            return response()->json(['error' => 'File is not valid'], 400);
        }
    }
}
