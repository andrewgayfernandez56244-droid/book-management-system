<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'genre' => fake()->randomElement(['Fiction', 'Non-Fiction', 'Fantasy', 'Science', 'History']),
            'publication_year' => fake()->numberBetween(1900, (int) date('Y')),
        ];
    }
}
