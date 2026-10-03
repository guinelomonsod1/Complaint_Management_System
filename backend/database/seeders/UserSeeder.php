<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = DB::table('roles')
            ->pluck('id', 'name');

        $barangays = DB::table('barangays')
            ->pluck('id', 'name');

        $departments = DB::table('departments')
            ->pluck('id', 'name');

        $users = [
            [
                'supabase_user_id' => '00000000-0000-0000-0000-000000000001',
                'role_id' => $roles['Citizen'],
                'barangay_id' => $barangays['Poblacion'],
                'department_id' => null,
                'first_name' => 'Juan',
                'middle_name' => 'Dela',
                'last_name' => 'Cruz',
                'email' => 'citizen@example.com',
                'phone' => '09170000001',
                'profile_image' => null,
                'is_active' => true,
            ],
            [
                'supabase_user_id' => '00000000-0000-0000-0000-000000000002',
                'role_id' => $roles['LGU Staff'],
                'barangay_id' => null,
                'department_id' => $departments['General Services'],
                'first_name' => 'Maria',
                'middle_name' => 'Santos',
                'last_name' => 'Reyes',
                'email' => 'lgu.staff@example.com',
                'phone' => '09170000002',
                'profile_image' => null,
                'is_active' => true,
            ],
            [
                'supabase_user_id' => '00000000-0000-0000-0000-000000000003',
                'role_id' => $roles['Department Head'],
                'barangay_id' => null,
                'department_id' => $departments['Engineering'],
                'first_name' => 'Pedro',
                'middle_name' => 'Garcia',
                'last_name' => 'Ramos',
                'email' => 'department.head@example.com',
                'phone' => '09170000003',
                'profile_image' => null,
                'is_active' => true,
            ],
            [
                'supabase_user_id' => '00000000-0000-0000-0000-000000000004',
                'role_id' => $roles['Assigned Personnel'],
                'barangay_id' => null,
                'department_id' => $departments['Engineering'],
                'first_name' => 'Jose',
                'middle_name' => 'M.',
                'last_name' => 'Santos',
                'email' => 'assigned.personnel@example.com',
                'phone' => '09170000004',
                'profile_image' => null,
                'is_active' => true,
            ],
            [
                'supabase_user_id' => '00000000-0000-0000-0000-000000000005',
                'role_id' => $roles['System Administrator'],
                'barangay_id' => null,
                'department_id' => null,
                'first_name' => 'Admin',
                'middle_name' => null,
                'last_name' => 'User',
                'email' => 'admin@example.com',
                'phone' => '09170000005',
                'profile_image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['supabase_user_id' => $user['supabase_user_id']],
                [
                    'role_id' => $user['role_id'],
                    'barangay_id' => $user['barangay_id'],
                    'department_id' => $user['department_id'],
                    'first_name' => $user['first_name'],
                    'middle_name' => $user['middle_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'profile_image' => $user['profile_image'],
                    'is_active' => $user['is_active'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}