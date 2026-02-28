<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    const FILE_PATH = "csv_uploads/";
    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
        'size',
        'hashname',
        'status',
        'row_count',
        'processed_count',
        'failed_count',
        'errors',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function getFileUrlAttribute()
    {
        return asset('storage/' . self::FILE_PATH . $this->hashname);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
