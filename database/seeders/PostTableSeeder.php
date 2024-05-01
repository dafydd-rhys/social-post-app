<?php

namespace Database\Seeders;

use App\Models\WebsitePosts;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{

    public function run(): void
    {
        WebsitePosts::factory()->count(10)->create();
    }
    
}
