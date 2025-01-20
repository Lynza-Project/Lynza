<?php

namespace Database\Seeders;

use App\Models\LostAndFound;
use App\Models\LostAndFoundCategory;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Random\RandomException;

class LostAndFoundSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $organizations = Organization::all();
        $categories = LostAndFoundCategory::all();

        foreach ($organizations as $organization) {
            for ($i = 1; $i <= 10; $i++) {
                LostAndFound::create([
                    'organization_id' => $organization->id,
                    'title' => 'Objet perdu ' . $i . ' - ' . $organization->name,
                    'description' => 'Description de l’objet perdu ' . $i,
                    'lost_and_found_category_id' => $categories->random()->id,
                    'location' => 'Lieu ' . random_int(1, 10),
                    'status' => random_int(0, 1) ? 'found' : 'lost',
                ]);
            }
        }
    }
}
