<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Engineering',
                'description' => 'Handles infrastructure, roads, drainage, and related engineering concerns.',
            ],
            [
                'name' => 'Health',
                'description' => 'Handles public health and sanitation-related concerns.',
            ],
            [
                'name' => 'Social Welfare',
                'description' => 'Handles social welfare and community assistance concerns.',
            ],
            [
                'name' => 'Environment',
                'description' => 'Handles environmental and waste-management concerns.',
            ],
            [
                'name' => 'General Services',
                'description' => 'Handles general municipal services and operational concerns.',
            ],
        ];

        foreach ($departments as $department) {
            DB::table('departments')->updateOrInsert(
                ['name' => $department['name']],
                [
                    'description' => $department['description'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}