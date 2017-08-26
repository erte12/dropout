<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Website;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Const numbers of particular elements in database
     * @var integer
     */
    const NUMBER_OF_CATEGORIES = 15;
    const NUMBER_OF_SUBCATEGORIES = 8;
    const NUMBER_OF_USERS = 20;
    const MAX_NUMBER_OF_WEBSITES_PER_SUBCATEGORY = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_UK');

        /**
         * Roles seeds
         */
         DB::table('roles')->insert([
             'id' => 1,
             'name' => 'admin',
         ]);

         DB::table('roles')->insert([
             'id' => 2,
             'name' => 'user',
         ]);

        /**
         * Users seeds
         */
        for($user_id = 1; $user_id <= self::NUMBER_OF_USERS; $user_id++)
        {
            if($user_id === 1) {
                DB::table('users')->insert([
                    'name' => 'Admin',
                    'email' => 'bartek.iskrzycki@gmail.com',
                    'password' => bcrypt('pass'),
                    'role_id' => 1,
                ]);
            } else if($user_id === 2) {
                DB::table('users')->insert([
                    'name' => 'User',
                    'email' => 'user@example.org',
                    'password' => bcrypt('pass'),
                    'role_id' => 2,
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
            $name = $faker->unique()->firstName;
            DB::table('categories')->insert([
                'name' => $name,
                'slug' => str_slug($name),
            ]);

            /**
             * Subcategories seeds
             */
            for($subcategory_id = 1; $subcategory_id <= self::NUMBER_OF_SUBCATEGORIES; $subcategory_id++)
            {
                $name = $faker->unique()->lastName;
                DB::table('subcategories')->insert([
                    'name' => $name,
                    'slug' => str_slug($name),
                    'category_id' => $category_id,
                ]);

                /**
                 * Websites seeds
                 *
                 */
                $subcategory_id_for_website_to_database = ($category_id - 1) * self::NUMBER_OF_SUBCATEGORIES + $subcategory_id;
                for($website_id = 1; $website_id <= $faker->numberBetween(1, self::MAX_NUMBER_OF_WEBSITES_PER_SUBCATEGORY); $website_id++)
                {
                    /**
                     * Inserts only main website
                     */
                    $url = $faker->unique()->url;
                    $last_index = strrpos($url, '/');

                    try {
                        $website_id = DB::table('websites')->insertGetId([
                            'user_id' => $faker->numberBetween(2,self::NUMBER_OF_USERS),
                            'name' => $faker->firstName,
                            'subcategory_id' => $subcategory_id_for_website_to_database,
                            'url' => substr($url, 0, $last_index),
                            'description' => $faker->paragraph($nbSentences = 20, $variableNbSentences = true),
                            'active' => $faker->numberBetween(0,1),
                            'created_at' => $faker->dateTime(),
                        ]);

                        $website = Website::findOrFail($website_id);

                        foreach ($faker->words($nb = 5, $asText = false) as $tag_name) {
                            $tag = Tag::where(['name' => $tag_name])->first();

                            if(is_null($tag)) {
                                $website->tags()->create([
                                    'name' => $tag_name,
                                ]);
                            } else {
                                $website->tags()->attach($tag->id);
                            }
                        }

                    } catch(PDOException $expection) {
                        continue;
                    }
                }
            }
        }
    }
}
