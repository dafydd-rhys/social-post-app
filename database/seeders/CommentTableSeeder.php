<?php

namespace Database\Seeders;

use App\Models\Comments;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{

    public function run(): void
    {
        Comments::factory()->count(75)->create();
    }
    
}
