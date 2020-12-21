<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact')->delete();
        DB::table('contact')->insert([
            [
                'type'=>'1', //1 ::email,nôi dung
            ], 
            [
                'type'=>'2', //2 ::Tên,email,nôi dung
            ],
            [
                'type'=>'3', //3 ::Tên,email,dia chi,sdt,nôi dung
            ],
        ]);
    }
}
