<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function topics()
    {
        return $this->hasMany(ForumTopic::class, 'category_id');
    }

    public function activeTopics()
    {
        return $this->hasMany(ForumTopic::class, 'category_id')
                    ->orderBy('is_pinned', 'desc')
                    ->orderBy('last_activity_at', 'desc');
    }

    public function getTopicsCountAttribute()
    {
        return $this->topics()->count();
    }

    public function getRepliesCountAttribute()
    {
        return ForumReply::whereHas('topic', function($q) {
            $q->where('category_id', $this->id);
        })->count();
    }
}
