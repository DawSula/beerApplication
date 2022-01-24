<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $beers = [];
        $countStyles = DB::table('beer_style')->count();


        DB::table('beers')->truncate();

        for($i = 0; $i < 50; $i++){
            $beers[] = [
                'name'=> $faker->words($faker->numberBetween(1,3), true),
                'description'=>$faker->sentence,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'score'=> $faker->numberBetween(1,5),
                'id_style'=>$faker->numberBetween(1,$countStyles)
            ];
        }

        DB::table('beers')->insert($beers);
    }
}
