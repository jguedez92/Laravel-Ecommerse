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
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'God account',
                'email' => 'admin@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'admin',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 1',
                'email' => 'test1@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 2',
                'email' => 'test2@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 3',
                'email' => 'test3@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 4',
                'email' => 'test4@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 5',
                'email' => 'test5@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 6',
                'email' => 'test6@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 7',
                'email' => 'test7@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 8',
                'email' => 'test8@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 9',
                'email' => 'test9@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 10',
                'email' => 'test10@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 11',
                'email' => 'test11@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 12',
                'email' => 'test12@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 13',
                'email' => 'test13@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 14',
                'email' => 'test14@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 15',
                'email' => 'test15@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 16',
                'email' => 'test16@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 17',
                'email' => 'test17@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 18',
                'email' => 'test18@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 19',
                'email' => 'test19@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' =>'testing 20',
                'email' => 'test20@mail.com',
                'password' => Hash::make('1234'),
                'role'=> 'user',
                'status_for_renting'=> 'enabled',
                'email_verified_at'=>Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
