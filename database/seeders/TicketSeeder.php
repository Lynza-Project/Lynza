<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Random\RandomException;

class TicketSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $organizations = Organization::all();
        $users = User::all();

        foreach ($organizations as $organization) {
            for ($i = 1; $i <= 5; $i++) {
                Ticket::create([
                    'organization_id' => $organization->id,
                    'user_id' => $users->random()->id,
                    'subject' => 'Problème n°' . $i . ' - ' . $organization->name,
                    'description' => 'Détails du problème n°' . $i,
                    'status' => random_int(0, 1) ? 'open' : 'closed',
                ]);
            }
        }
    }
}
