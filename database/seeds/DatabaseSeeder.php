<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    const NUMBER_OF_CATEGORIES = 30;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pl_PL');

        for($category_id = 1; $category_id <= self::NUMBER_OF_CATEGORIES; $category_id++)
        {
            DB::table('categories')->insert([
                'name' => $faker->word,
            ]
            );
        }
    }
}
