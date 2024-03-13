<?php

namespace Database\Seeders;

use App\Models\WebsitePosts;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsitePosts::factory()->count(50)->create();
    }
}
