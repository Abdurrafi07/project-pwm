<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access',
            ],
            [
                'name' => 'user',
                'display_name' => 'Regular User',
                'description' => 'Regular user with limited access',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}