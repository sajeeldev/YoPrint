<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request) {
        $validatedFile = $request->validate([
            'csvfile' => 'required|file|mimes:csv|max:100000',
        ]);

        // dd($validatedFile);

        // if($validatedFile){
            $csvFile = $request->file('csvfile');
            $fileName = $csvFile->getClientOriginalName();
            $filePath = FileUpload::FILE_PATH . $fileName;
            $userId = user()->id;
            // dd($userId);

            $file = new FileUpload();
            $file->user_id = $userId;
            $file->file_name = $fileName;
            $file->file_path = $filePath;
            $file->size = $csvFile->getSize();
            $file->status = 'uploaded';
            $file->hashname = md5($csvFile->getClientOriginalName()) . '.' . $csvFile->getClientOriginalExtension();
            // dd($file);
            $existingFile = FileUpload::where('hashname', $file->hashname)->exists();
            if($existingFile){
                return redirect()->back()->withErrors(['csvfile' => 'This file has already been uploaded. Please upload a different file.'])->withInput();
            } else {
                $file->save();
            }
        // }

        return redirect()->back()->with('success', 'File uploaded successfully.');

    }
}
