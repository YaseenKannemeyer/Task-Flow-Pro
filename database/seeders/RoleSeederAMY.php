<?php

namespace Database\Seeders;

use App\Models\RoleAMY;
use Illuminate\Database\Seeder;

class RoleSeederAMY extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin',       'display_name' => 'Administrator',  'description' => 'Full system access'],
            ['name' => 'team_member', 'display_name' => 'Team Member',    'description' => 'Can create and manage tasks'],
            ['name' => 'guest',       'display_name' => 'Guest',          'description' => 'View only assigned tasks'],
        ];

        foreach ($roles as $role) {
            RoleAMY::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
