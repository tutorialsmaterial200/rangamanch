<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video_url',
        'language_id',
        'status',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
