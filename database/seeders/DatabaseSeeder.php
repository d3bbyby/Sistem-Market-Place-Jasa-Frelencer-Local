<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> ac707d7 (Set up crud)

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
<<<<<<< HEAD

        User::updateOrCreate(
            ['email' => 'freelancer@example.com'],
            [
                'name' => 'Freelancer Contoh',
                'password' => Hash::make('password'),
                'role' => 'freelancer',
            ],
        );
=======
>>>>>>> ac707d7 (Set up crud)
    }
}
