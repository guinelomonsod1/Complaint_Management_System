<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    public function run(): void
    {
        $barangays = [
            [
                'name' => 'Poblacion',
                'code' => 'BRGY-001',
                'description' => 'Development reference barangay.',
            ],
            [
                'name' => 'San Isidro',
                'code' => 'BRGY-002',
                'description' => 'Development reference barangay.',
            ],
            [
                'name' => 'San Roque',
                'code' => 'BRGY-003',
                'description' => 'Development reference barangay.',
            ],
            [
                'name' => 'Bagong Silang',
                'code' => 'BRGY-004',
                'description' => 'Development reference barangay.',
            ],
            [
                'name' => 'Santa Cruz',
                'code' => 'BRGY-005',
                'description' => 'Development reference barangay.',
            ],
            [
                'name' => 'Casinglot',
                'code' => 'BRGY-006',
                'description' => 'Development reference barangay.',

            ]
        ];

        foreach ($barangays as $barangay) {
            DB::table('barangays')->updateOrInsert(
                ['code' => $barangay['code']],
                [
                    'name' => $barangay['name'],
                    'description' => $barangay['description'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}