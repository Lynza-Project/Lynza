<?php

namespace Database\Seeders;

use App\Models\LostAndFoundCategory;
use Illuminate\Database\Seeder;

class LostAndFoundCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Clés',
            'Téléphones',
            'Portefeuilles',
            'Cartes d\'identité',
            'Vêtements',
            'Lunettes',
            'Sacs',
            'Bijoux',
            'Électronique',
            'Autres'
        ];

        foreach ($categories as $category) {
            LostAndFoundCategory::create([
                'name' => $category,
            ]);
        }
    }
}
