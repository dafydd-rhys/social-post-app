<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{

    public function run()
{
    $tags = [
        'Technology',
        'Travel',
        'Food',
        'Health & Wellness',
        'Fashion',
        'Sports',
        'Music',
        'Art & Design',
        'Books & Literature',
        'Movies & TV Shows',
        'Education',
        'Politics',
        'Business & Finance',
        'Science & Nature',
        'History',
        'Lifestyle'
    ];

    foreach ($tags as $tagName) {
        Tag::create(['name' => $tagName]);
    }
}
}
