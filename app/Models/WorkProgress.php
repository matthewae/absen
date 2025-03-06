<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'description',
        'attachment',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    public static function categories()
    {
        return ['Perencanaan', 'Pengawasan', 'Kajian'];
    }

    public static function statuses()
    {
        return ['pending', 'revision', 'approved'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}