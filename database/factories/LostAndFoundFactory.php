<?php

namespace Database\Factories;

use App\Models\LostAndFound;
use App\Models\LostAndFoundCategory;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LostAndFoundFactory extends Factory
{
    protected $model = LostAndFound::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'location' => $this->faker->word(),
            'status' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'organization_id' => Organization::factory(),
            'lost_and_found_category_id' => LostAndFoundCategory::factory(),
        ];
    }
}
