<?php

namespace Database\Factories;

use App\Models\Archive;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Archive>
 */
class ArchiveFactory extends Factory
{
    protected $model = Archive::class;

    public function definition(): array
    {
        $name = fake()->unique()->lexify('imagem-????');
        $extension = fake()->randomElement(['png', 'jpg', 'webp']);

        return [
            'archive' => $name . '.' . $extension,
            'filename' => $name,
            'extension' => $extension,
            'path' => '/images/not-image.png',
        ];
    }
}
