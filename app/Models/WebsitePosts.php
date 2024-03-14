<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePosts extends Model
{
    use HasFactory;

    public function comments() {
        return $this->hasMany('App\Models\Comments');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
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
