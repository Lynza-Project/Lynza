<?php

namespace Database\Seeders;

use App\Models\Documentation;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class DocumentationSeeder extends Seeder
{
    public function run(): void
    {
        $organizations = Organization::all();
        $users = User::all();

        foreach ($organizations as $organization) {
            for ($i = 1; $i <= 10; $i++) {
                Documentation::create([
                    'organization_id' => $organization->id,
                    'user_id' => $users->random()->id,
                    'title' => 'Documentation ' . $i . ' - ' . $organization->name,
                    'content' => 'Contenu détaillé de la documentation ' . $i,
                ]);
            }
        }
    }
}
