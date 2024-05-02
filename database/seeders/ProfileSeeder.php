<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class ProfileSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            if (!$user->profile) {
                $profileData = [
                    'avatar' => 'images/profile.png',
                ];

                $user->profile()->create($profileData);
            } 
        }
    }
}
