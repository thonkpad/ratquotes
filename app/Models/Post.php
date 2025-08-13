<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;

class Post extends Model
{
    public $timestamps = false; // we already have 'uploaded_at'

    protected $fillable = [
        'user_id',
        'filepath',
        'uploaded_at',
    ];

    public function upvote()
    {
        $this->increment('upvotes');
    }

    public function downvote()
    {
        $this->decrement('upvotes');
    }

    /**
     * Users that (up|down)voted on the post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User, Post, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function voters()
    {
        return $this->belongsToMany(User::class, 'post_votes')
            ->withPivot('vote_type')
            ->withTimestamps();
    }

    /**
     * A Post belongs to a User
     * @return BelongsTo<User, Post>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUrlAttribute(): string
    {
        return assert('storage/' . $this->filepath);
    }
}
