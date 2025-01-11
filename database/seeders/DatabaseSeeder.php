<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            OrganizationSeeder::class,
            ThemeSeeder::class,
            AddressSeeder::class,
            UserSeeder::class,
            EventSeeder::class,
            NewsSeeder::class,
            DocumentationSeeder::class,
            LostAndFoundCategorySeeder::class,
            LostAndFoundSeeder::class,
            TicketSeeder::class,
            TicketMessageSeeder::class,
        ]);
    }
}
