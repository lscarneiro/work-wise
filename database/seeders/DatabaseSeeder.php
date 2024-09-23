<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('abcd1234'),
                'is_admin' => true
            ],
            [
                'name' => 'Job Seeker',
                'email' => 'test@example.com',
                'password' => Hash::make('abcd1234'),
                'is_admin' => false
            ]
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }

        Company::factory()
            ->count(15)
            ->create()->each(function ($company) {
                $company->jobPosts()->saveMany(
                    JobPost::factory()->count(rand(0, 10))->make()
                );
            });
        ;

    }
}
