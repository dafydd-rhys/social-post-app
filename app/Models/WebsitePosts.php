<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;
use App\Models\User;

class WebsitePosts extends Model
{
    use HasFactory;

    public function comments() {
        return $this->hasMany(Comments::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
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
