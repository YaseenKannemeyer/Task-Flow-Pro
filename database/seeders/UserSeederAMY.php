<?php

namespace Database\Seeders;

use App\Models\RoleAMY;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeederAMY extends Seeder
{
    public function run(): void
    {
        $adminRole  = RoleAMY::where('name', 'admin')->first();
        $memberRole = RoleAMY::where('name', 'team_member')->first();
        $guestRole  = RoleAMY::where('name', 'guest')->first();

        // Seed one admin
        User::factory()->create([
            'name'     => 'Admin User',
            'email'    => 'admin@taskapp.test',
            'password' => Hash::make('password'),
            'role_id'  => $adminRole->id,
        ]);

        // Seed 5 team members
        User::factory(5)->create(['role_id' => $memberRole->id]);

        // Seed 3 guests
        User::factory(3)->create(['role_id' => $guestRole->id]);
    }
}
