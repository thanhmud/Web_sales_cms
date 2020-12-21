<?php

use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('media')->insert([
        	[
                'id'=>'208',
        		'type'=>'1', //1 ảnh; 2 video
        		'url'=>'1607063792980user.jpg',
        		'user_id'=> 2,
        	],
        	[
                'id'=>'207',
        		'type'=>'1', //1 ảnh; 2 video
        		'url'=>'1607063792980user.jpg',
        		'user_id'=> 4,
        	],
        	[
                'id'=>'206',
        		'type'=>'2', //1 ảnh; 2 video
        		'url'=>'1607063792980user.jpg',
        		'user_id'=> 3,
        	],
        	[
                'id'=>'205',
        		'type'=>'2', //1 ảnh; 2 video
        		'url'=>'1607063792980user.jpg',
        		'user_id'=> 2,
        	],
        ]);
    }
}
 
