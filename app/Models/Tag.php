<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WebsitePosts;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function websitePosts()
    {
        return $this->belongsToMany(WebsitePosts::class);
    }
}
