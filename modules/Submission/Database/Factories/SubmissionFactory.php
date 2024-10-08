<?php

declare(strict_types=1);

namespace Modules\Submission\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Submission\Models\Submission;

class SubmissionFactory extends Factory
{
    protected $model = Submission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
