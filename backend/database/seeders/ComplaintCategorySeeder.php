<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Roads',
                'description' => 'Complaints involving roads, potholes, and road conditions.',
            ],
            [
                'name' => 'Garbage',
                'description' => 'Complaints involving garbage collection, disposal, and accumulation.',
            ],
            [
                'name' => 'Drainage',
                'description' => 'Complaints involving drainage systems, flooding, and blocked waterways.',
            ],
            [
                'name' => 'Public Safety',
                'description' => 'Complaints involving public safety and related community concerns.',
            ],
            [
                'name' => 'Health',
                'description' => 'Complaints involving public health, sanitation, and health-related services.',
            ],
            [
                'name' => 'Noise',
                'description' => 'Complaints involving excessive or disruptive noise.',
            ],
            [
                'name' => 'Other',
                'description' => 'Complaints that do not fall under the other available categories.',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('complaint_categories')->updateOrInsert(
                ['name' => $category['name']],
                [
                    'description' => $category['description'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}