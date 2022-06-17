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
            'password' => bcrypt('123456'),
            'avatar'   => 'pic1.jpg',
            'role'     => 'Admin',
            'status'   => 1,
        ]);
    }
}
