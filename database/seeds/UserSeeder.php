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
            'name'     => 'Ahmed Nabil',
            'email'    => 'ahmed@admin.com',
            'password' => bcrypt('123456789'),
            'avatar'   => 'pic1.jpg',
            'role'     => 'Admin',
            'status'   => 1,
        ]);

        User::create
        ([
            'name'     => 'Ahmed Nabil',
            'email'    => 'ahmednassag@gmail.com',
            'password' => bcrypt('18199320111993'),
            'avatar'   => 'pic1.jpg',
            'role'     => 'MakeupArtist',
            'status'   => 0,
        ]);

        User::create
        ([
            'name'     => 'Ahmed Nassag',
            'email'    => 'ahmednassag@yahoo.com',
            'password' => bcrypt('20111993'),
            'avatar'   => 'pic1.jpg',
            'role'     => 'User',
        ]);
    }
}
