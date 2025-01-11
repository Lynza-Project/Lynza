<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Random\RandomException;

class AddressSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $organizations = Organization::all();

        foreach ($organizations as $org) {
            for ($i = 1; $i <= 15; $i++) {
                $address = Address::create([
                    'organization_id' => $org->id,
                    'number' => random_int(1, 100),
                    'name' => 'Rue Exemple ' . $i,
                    'zip_code' => random_int(75000, 75999),
                    'country' => 'France',
                    'region' => 'Région ' . chr(64 + $i),
                ]);
                $org->update(['address_id' => $address->id]);
            }
        }
    }
}
