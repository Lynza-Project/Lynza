<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        $organizations = Organization::all();

        $randomColors = [
            '#3490dc',
            '#e3342f',
            '#6c757d',
            '#6cb2eb',
            '#38c172',
            '#ffed4a',
        ];

        foreach ($organizations as $org) {
            $theme = Theme::create([
                'organization_id' => $org->id,
                'title' => 'Thème ' . $org->name,
                'primary' => $randomColors[array_rand($randomColors)],
                'danger' => $randomColors[array_rand($randomColors)],
                'gray' => $randomColors[array_rand($randomColors)],
                'info' => $randomColors[array_rand($randomColors)],
                'success' => $randomColors[array_rand($randomColors)],
                'warning' => $randomColors[array_rand($randomColors)],
                'font' => 'Arial',
            ]);
            $org->update(['theme_id' => $theme->id]);
        }
    }
}
