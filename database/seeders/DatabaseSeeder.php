<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $faker = Faker::create();
        foreach(range(1,100) as $key=>$value){
            DB::table('blogs')->insert(
                [
                'title'=>$faker->text,
                'slug'=>$faker->slug,
                'keywords'=>$faker->text,
                'description' => $faker->text,
                'content' => $faker->paragraph,
                ]
        );
        }
    }
}
