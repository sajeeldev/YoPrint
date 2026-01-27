<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request) {
        $request->validate([
            'csvfile' => 'required|file|mimes:csv|max:100000',
        ]);

            $csvFile = $request->file('csvfile');
            $fileName = $csvFile->getClientOriginalName();
            $filePath = FileUpload::FILE_PATH . $fileName;
            $userId = user()->id;

            FileUpload::updateOrCreate([
                'user_id' => $userId,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'size' => $csvFile->getSize(),
                'status' => 'uploaded',
                'hashname' => md5($csvFile->getClientOriginalName()) . '.' . $csvFile->getClientOriginalExtension(),
            ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');

    }
}
