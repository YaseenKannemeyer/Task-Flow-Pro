<?php

namespace Database\Seeders;

use App\Models\TaskAMY;
use Illuminate\Database\Seeder;

class TaskSeederAMY extends Seeder
{
    public function run(): void
    {
        // Use the factory to generate realistic test data
        TaskAMY::factory(50)->create();
    }
}

