<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Comic;

// Helpers
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;


class ComicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            $title = $faker->unique()->sentence(4);
            $slug = Str::slug($title);
            $description = $faker->paragraph();
            $image = $faker->imageUrl(640, 480, 'comics');
            $price = $faker->randomFloat(2, 5, 50);
            $quantity = $faker->numberBetween(0, 100);

            Comic::create([
                'name' => $title,
                'slug' => $slug,
                'description' => $description,
                'image' => $image,
                'price' => $price,
                'quantity' => $quantity,
            ]);
        }
    }
}
