<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeerStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

        DB::table('beer_style')->truncate();



        DB::table('beer_style')->insert([
            ['name' => 'Klasyczny Lager', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'description' => $faker->sentence],
            ['name' => 'Piwo pszeniczne', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'description' => $faker->sentence],
            ['name' => 'Piwa owocowe', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'description' => $faker->sentence],
            ['name' => 'Piwo pszeniczne', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'description' => $faker->sentence],
            ['name' => 'Piwo ciemne', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'description' => $faker->sentence],
            ['name' => 'Inne', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'description' => $faker->sentence],
        ]);
    }
}
