<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use App\Jobs\ProcessCsvUpload;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate([
            'csvfile' => 'required|file|mimes:csv|max:100000',
        ]);

        $csvFile = $request->file('csvfile');
        $fileName = $csvFile->getClientOriginalName();
        $filePath = FileUpload::FILE_PATH . $fileName;
        $userId = user()->id;

        $fileUpload = FileUpload::updateOrCreate([
            'user_id' => $userId,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'size' => $csvFile->getSize(),
            'status' => 'uploaded',
            'hashname' => md5($csvFile->getClientOriginalName()) . '.' . $csvFile->getClientOriginalExtension(),
        ]);

        Log::info('File uploaded successfully', $fileUpload->toArray());

        $csvFile->storeAs('/' . FileUpload::FILE_PATH, $fileName, 'public');

        ProcessCsvUpload::dispatch($fileUpload);
        Log::info('Job dispatched');

        return redirect()->back()->with('success', 'File uploaded successfully.');

    }

    /**
     * Return file upload statuses as JSON for real-time polling.
     */
    public function getFileStatuses()
    {
        $files = FileUpload::where('user_id', user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($file) {
                $progress = 0;
                if ($file->row_count > 0) {
                    $progress = round((($file->processed_count + $file->failed_count) / $file->row_count) * 100, 1);
                }

                return [
                    'id' => $file->id,
                    'file_name' => $file->file_name,
                    'status' => $file->status,
                    'row_count' => $file->row_count,
                    'processed_count' => $file->processed_count,
                    'failed_count' => $file->failed_count,
                    'progress' => $progress,
                    'created_at' => $file->created_at->format('h:i :- d-m-Y'),
                    'time_ago' => $file->created_at->diffForHumans(),
                    'completed_at' => $file->completed_at,
                ];
            });

        return response()->json(['files' => $files]);
    }
}
