<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\WebsitePosts;
use App\Models\Comments;
use App\Models\Profile;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function websitePosts() {
        return $this->hasMany(WebsitePosts::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
