<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RestoreMissingUsersTableMigrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_restores_a_missing_users_table_for_authentication(): void
    {
        Schema::drop('users');

        $migration = require database_path('migrations/2026_11_03_034332_restore_missing_users_table.php');
        $migration->up();

        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'client',
            'verification_status' => 'pending',
            'password' => 'hashed-password',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => 'client',
            'verification_status' => 'pending',
        ]);
    }

    public function test_it_preserves_an_existing_users_table(): void
    {
        DB::table('users')->insert([
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'password' => 'hashed-password',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $migration = require database_path('migrations/2026_11_03_034332_restore_missing_users_table.php');
        $migration->up();

        $this->assertDatabaseHas('users', [
            'email' => 'existing@example.com',
        ]);
    }
}
