<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'type',
        'read_time',
        'duration',
        'thumbnail',
        'video_url'
    ];

    // Relationship with users who have read/watched
    public function readers()
    {
        return $this->belongsToMany(User::class, 'user_article_progress')
                   ->withPivot('progress', 'completed')
                   ->withTimestamps();
    }
}
