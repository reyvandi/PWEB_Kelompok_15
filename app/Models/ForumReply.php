<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'topic_id',
        'user_id',
        'parent_id',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            // Update topic replies count dan last activity
            $topic = $reply->topic;
            $topic->increment('replies_count');
            $topic->updateLastActivity($reply->user_id);
        });

        static::deleted(function ($reply) {
            // Update topic replies count
            $reply->topic->decrement('replies_count');
        });
    }

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(ForumReply::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ForumReply::class, 'parent_id');
    }

}
