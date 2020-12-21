<?php

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
        DB::table('users')->insert([
        	[
        		'name'=>'thanh',
        		'email'=>'thanh1@gmail.com',
        		'password'=>bcrypt('thanh1'),
        	],
            [
                'name'=>'user',
                'email'=>'user1@gmail.com',
                'password'=>bcrypt('user1'),
            ],
            [
                'name'=>'liên',
                'email'=>'liên1@gmail.com',
                'password'=>bcrypt('liên1'),
            ],
            [
                'name'=>'hạ',
                'email'=>'ha1@gmail.com',
                'password'=>bcrypt('ha1'),
            ],
        ]);
    }
}

// 1: tạo migrateion
// 2: tạo seed
// 3: tạo giao diện
// 1: tạo migrateion
// 1: tạo migrateion