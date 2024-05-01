<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;
use App\Models\User;
use App\Models\Tag;

class WebsitePosts extends Model
{
    use HasFactory;

    public function comments() {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected $fillable = [
        'user_id',
        'content',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];

}
