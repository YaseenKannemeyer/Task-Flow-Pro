<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeederAMY::class,
            UserSeederAMY::class,
            CategorySeederAMY::class,
            TaskSeederAMY::class,
        ]);
    }
}
