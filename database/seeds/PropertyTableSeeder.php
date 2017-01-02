<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Property;
class PropertyTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,20) as $i)
        {
            for($j = 0; $j < 3; $j++){
                Property::create([
                    'uid' => $i,
                    'name' => $faker->secondaryAddress,
                    'lat' => $faker->latitude(50,58), //these can be in the sea. Should use api.postcodes.io/random/postcodes if I want them not to be
                    'lng' => $faker->longitude(-10,1),
                    'value' => $faker->randomFloat(2,0,9999999)
                ]);
            }

        }

    }
}
