<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritySeeder extends Seeder
{
    public function run(): void
    {
        $priorities = [
            [
                'name' => 'Low',
                'description' => 'Complaint with low urgency that does not require immediate action.',
                'level' => 1,
            ],
            [
                'name' => 'Medium',
                'description' => 'Complaint requiring normal processing and follow-up.',
                'level' => 2,
            ],
            [
                'name' => 'High',
                'description' => 'Complaint requiring prompt attention from the responsible LGU personnel.',
                'level' => 3,
            ],
            [
                'name' => 'Urgent',
                'description' => 'Complaint requiring immediate attention and action.',
                'level' => 4,
            ],
        ];

        foreach ($priorities as $priority) {
            DB::table('priorities')->updateOrInsert(
                ['name' => $priority['name']],
                [
                    'description' => $priority['description'],
                    'level' => $priority['level'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}