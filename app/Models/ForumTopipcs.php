<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ForumTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id',
        'category_id',
        'is_pinned',
        'is_locked',
        'views_count',
        'replies_count',
        'last_activity_at',
        'last_reply_user_id'
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_locked' => 'boolean',
        'last_activity_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($topic) {
            $topic->slug = Str::slug($topic->title);
            $topic->last_activity_at = now();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'topic_id');
    }

    public function approvedReplies()
    {
        return $this->hasMany(ForumReply::class, 'topic_id')
                    ->where('is_approved', true)
                    ->orderBy('created_at', 'asc');
    }

    public function lastReplyUser()
    {
        return $this->belongsTo(User::class, 'last_reply_user_id');
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function updateLastActivity($userId = null)
    {
        $this->update([
            'last_activity_at' => now(),
            'last_reply_user_id' => $userId
        ]);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
