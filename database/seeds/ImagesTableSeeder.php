<?php

use Illuminate\Database\Seeder;
use App\Image;
use Faker\Generator as Faker;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 25; $i++) {
            $newImage = new Image;
            $newImage->name = $faker->words(3);
            $newImage->path = 'https://picsum.photos/200/300';
            $newImage->save();
        }
    }
}
