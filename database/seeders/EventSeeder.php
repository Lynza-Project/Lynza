<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Random\RandomException;

class EventSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $organizations = Organization::all();
        $users = User::all();

        foreach ($organizations as $organization) {
            for ($i = 1; $i <= 10; $i++) {
                Event::create([
                    'organization_id' => $organization->id,
                    'user_id' => $users->random()->id,
                    'title' => 'Événement ' . $i . ' - ' . $organization->name,
                    'description' => 'Description de l’événement ' . $i,
                    'date' => now()->addDays(random_int(1, 30)),
                    'location' => 'Lieu ' . random_int(1, 10),
                ]);
            }
        }
    }
}
