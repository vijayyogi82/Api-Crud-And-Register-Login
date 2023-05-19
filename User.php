<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */




    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // one to one
    public function post()
    {
        return $this->hasOne(Post::class);
    }

    // one to many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // hasOneThrough
    public function postComment()
    {
        return $this->hasOneThrough(Comment::class, Post::class);
    }

    // hasManyThrough
    public function postComments()
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    // hasManyThrough
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imagealbe');
    }
}
