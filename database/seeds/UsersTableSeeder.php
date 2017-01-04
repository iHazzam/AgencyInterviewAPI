<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,20) as $i)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => bcrypt($faker->password()),
                'api_token' =>  str_random(60)
            ]);
        }
        User::create([
            'name' => 'Harry Messenger',
            'email' => 'Harry@harrymessenger.co.uk',
            'password' => bcrypt('harry123'),
            'api_token' =>  str_random(60),
            'admin' => true
        ]);
    }
}
