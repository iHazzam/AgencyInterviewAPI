<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Property;
class PropertyTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,22) as $i)//now 22 users, (20+2 admins)
        {
            for($j = 0; $j < 3; $j++){
                $json = json_decode(file_get_contents('https://api.postcodes.io/random/postcodes'), true);
                Property::create([
                    'uid' => $i,
                    'name' => $faker->secondaryAddress,
                    'lat' => $json['result']['latitude'],
                    'lng' => $json['result']['longitude'],
                    'value' => $faker->randomFloat(2,0,9999999)
                ]);
            }

        }

    }
}
