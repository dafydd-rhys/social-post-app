<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebsitePosts;
use App\Models\Tag;

class TagWebsitePostSeeder extends Seeder
{
    public function run()
    {
        // Retrieve all website posts and tags
        $posts = WebsitePosts::all();
        $tags = Tag::all();

        // Attach random tags to each website post
        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(1)->pluck('id')->toArray()
            );
        });
    }
}
