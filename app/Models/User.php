<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'discord_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the user's Discord avatar (as url)
     * @return string|null
     */
    public function getDiscordAvatarUrl(): ?string
    {
        return $this->avatar
            ? "https://cdn.discordapp.com/avatars/{$this->discord_id}/{$this->avatar}.png"
            : null;
    }

    /**
     * A User can have many Post
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Post, User>
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Posts that the user (up|down)voted
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Post, User, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function votedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_votes')
            ->withPivot('vote_type')
            ->withTimestamps();
    }
}
