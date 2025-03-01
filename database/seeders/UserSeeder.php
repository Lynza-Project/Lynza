<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin unique
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'organization_id' => null,
            'role' => 'super-admin',
            'profile_picture' => null,
        ]);

        // Liste des organisations et utilisateurs dédiés
        $organizations = Organization::all();

        foreach ($organizations as $org) {
            User::create([
                'email' => 'admin@' . strtolower(str_replace(' ', '', $org->name)) . '.com',
                'password' => Hash::make('password'),
                'first_name' => 'Admin',
                'last_name' => $org->name,
                'organization_id' => $org->id,
                'role' => 'admin',
                'profile_picture' => null,
            ]);

            User::create([
                'email' => 'user@' . strtolower(str_replace(' ', '', $org->name)) . '.com',
                'password' => Hash::make('password'),
                'first_name' => 'User',
                'last_name' => $org->name,
                'organization_id' => $org->id,
                'role' => 'user',
                'profile_picture' => null,
            ]);
        }
    }
}
