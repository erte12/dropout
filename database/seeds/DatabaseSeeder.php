<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Const numbers of particular elements in database
     * @var integer
     */
    const NUMBER_OF_CATEGORIES = 30;
    const NUMBER_OF_SUBCATEGORIES = 20;
    const NUMBER_OF_USERS = 10;
    const MAX_NUMBER_OF_WEBSITES_PER_SUBCATEGORY = 30;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pl_PL');

        /**
         * Users seeds
         */
        for($user_id = 1; $user_id <= self::NUMBER_OF_USERS; $user_id++)
        {
             if($user_id === 1) {
                 DB::table('users')->insert([
                     'name' => 'Bartek Iskrzycki',
                     'email' => 'bartek.iskrzycki@gmail.com',
                     'password' => bcrypt('pass'),
                 ]);
             } else {
                 DB::table('users')->insert([
                     'name' => $faker->firstNameMale . ' ' . $faker->lastName,
                     'email' => $faker->safeEmail,
                     'password' => bcrypt('pass'),
                ]);
            }
        }

        /**
         * Categories seeds
         */
        for($category_id = 1; $category_id <= self::NUMBER_OF_CATEGORIES; $category_id++)
        {
            DB::table('categories')->insert([
                'name' => $faker->firstName,
            ]);

            /**
             * Subcategories seeds
             */
            for($subcategory_id = 1; $subcategory_id <= self::NUMBER_OF_SUBCATEGORIES; $subcategory_id++)
            {
                DB::table('subcategories')->insert([
                    'name' => $faker->firstName,
                    'category_id' => $category_id,
                ]);

                /**
                 * Websites seeds
                 *
                 */
                for($website_id = 1; $website_id <= $faker->numberBetween(1, self::MAX_NUMBER_OF_WEBSITES_PER_SUBCATEGORY); $website_id++)
                {
                    /**
                     * Inserts only main website
                     */
                    $url = $faker->unique()->url;
                    $last_index = strrpos($url, '/');

                    try {
                        DB::table('websites')->insert([
                            'user_id' => $faker->numberBetween(1,self::NUMBER_OF_USERS),
                            'name' => $faker->firstName,
                            'subcategory_id' => $subcategory_id,
                            'url' => substr($url, 0, $last_index),
                            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                        ]);
                    } catch(PDOException $expection) {
                        continue;
                    }
                }
            }
        }
    }
}
