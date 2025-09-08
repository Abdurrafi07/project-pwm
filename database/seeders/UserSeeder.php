<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        
        // Create default admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role_id' => $adminRole->id,
            'is_approved' => true,
            'approved_at' => now(),
        ]);
    }
}