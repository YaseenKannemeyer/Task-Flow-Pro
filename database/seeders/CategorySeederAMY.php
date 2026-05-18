<?php

namespace Database\Seeders;

use App\Models\CategoryAMY;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeederAMY extends Seeder
{
    public function run(): void
    {
        $admin = User::first(); // first user = admin

        $categories = [
            ['name' => 'Development',  'color' => '#6366f1', 'description' => 'Software development tasks'],
            ['name' => 'Design',       'color' => '#ec4899', 'description' => 'UI/UX design tasks'],
            ['name' => 'Marketing',    'color' => '#f59e0b', 'description' => 'Marketing and outreach tasks'],
            ['name' => 'DevOps',       'color' => '#10b981', 'description' => 'Infrastructure and deployment tasks'],
            ['name' => 'Management',   'color' => '#3b82f6', 'description' => 'Project management tasks'],
            ['name' => 'QA Testing',   'color' => '#ef4444', 'description' => 'Quality assurance tasks'],
        ];

        foreach ($categories as $cat) {
            CategoryAMY::firstOrCreate(
                ['name' => $cat['name']],
                array_merge($cat, ['created_by' => $admin->id])
            );
        }
    }
}
