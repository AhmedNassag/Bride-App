<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create
        ([
            'name'        => 'Ahmed Nabil',
            'avatar'      => 'pic1.jpg',
            'email'       => 'ahmednassag@gmail.com',
            'password'    => bcrypt('0101685643320111993'),
            'role'        => 0,
            'city_id'     => 1,
            'location_id' => 2
        ]);

        User::create
        ([
            'name'        => 'Ahmed Nassag',
            'avatar'      => 'pic1.jpg',
            'email'       => 'ahmednassag@yahoo.com',
            'password'    => bcrypt('18199320111993'),
            'role'        => 1,
            'city_id'     => 1,
            'location_id' => 2
        ]);

        User::create
        ([
            'name'        => 'Ahmed Nabil',
            'avatar'       => 'pic1.jpg',
            'email'       => 'ahmednabil@yahoo.com',
            'password'    => bcrypt('123456789'),
            'role'        => 2,
            'city_id'     => 1,
            'location_id' => 2
        ]);
    }
}
