<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function post() {
        return $this->belongsTo('App\Models\WebsitePosts');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
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
