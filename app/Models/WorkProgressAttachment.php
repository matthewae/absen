<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkProgressAttachment extends Model
{
    protected $fillable = [
        'work_progress_id',
        'file_name',
        'file_path',
        'mime_type',
        'file_size'
    ];

    public function workProgress(): BelongsTo
    {
        return $this->belongsTo(WorkProgress::class);
    }
}