<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'fullName' =>'God account',
                'email' => 'god@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'admin',
                'status'=> 'enabled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'God account',
                'email' => 'admin@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'admin',
                'status'=> 'enabled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing account',
                'email' => 'test@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status'=> 'enabled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing second account',
                'email' => 'test2@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status'=> 'enabled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing third account',
                'email' => 'test3@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status'=> 'enabled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
