<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WebsitePosts;
use App\Models\User;

class Comments extends Model
{
    use HasFactory;

    public function post() {
        return $this->belongsTo(WebsitePosts::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'website_posts_id',
        'content',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}
