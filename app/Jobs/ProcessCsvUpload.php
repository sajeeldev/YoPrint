<?php

namespace App\Jobs;

use Exception;
use League\Csv\Reader;
use App\Models\Product;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessCsvUpload implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public FileUpload $fileUpload)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->fileUpload->update([
            'status' => 'processing',
            'started_at' => now(),
        ]);

        $path = Storage::disk('public')->path($this->fileUpload->file_path);

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        // Count total rows first so frontend can show progress percentage
        $totalRows = iterator_count($csv->getRecords());
        $this->fileUpload->update([
            'row_count' => $totalRows,
        ]);

        $processed = 0;
        $failedCount = 0;
        $batchSize = 100; // Update DB every 100 rows for live progress

        foreach ($csv->getRecords() as $index => $row) {
            try {
                Product::updateOrCreate([
                    'unique_key' => $row['UNIQUE_KEY'],
                ], [
                    'product_title' => $row['PRODUCT_TITLE'] ?? null,
                    'product_description' => $row['PRODUCT_DESCRIPTION'] ?? null,
                    'style' => $row['STYLE#'] ?? null,
                    'sanmar_mainframe_color' => $row['SANMAR_MAINFRAME_COLOR'] ?? null,
                    'available_sizes' => $row['AVAILABLE_SIZES'] ?? null,
                    'color_name' => $row['COLOR_NAME'] ?? null,
                    'piece_price' => $row['PIECE_PRICE'] ?? null,
                ]);
                $processed++;
            } catch (Exception $e) {
                $failedCount++;
                Log::error($e->getMessage());
            }

            // Update progress every batchSize rows for real-time tracking
            if (($processed + $failedCount) % $batchSize === 0) {
                $this->fileUpload->update([
                    'processed_count' => $processed,
                    'failed_count' => $failedCount,
                ]);
            }
        }

        $this->fileUpload->update([
            'status' => 'completed',
            'processed_count' => $processed,
            'row_count' => $totalRows,
            'failed_count' => $failedCount,
            'completed_at' => now(),
        ]);
    }
}
