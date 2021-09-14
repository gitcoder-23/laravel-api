<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// required
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Rahul Kumar',
            'email' => 'rahul@gmail.com',
            'password' => Hash::make('Rahul@123')
        ]);
    }
}
