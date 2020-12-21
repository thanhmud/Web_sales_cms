<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->delete();
        DB::table('company')->insert([
            [
                'name'=>'thanh', 
                'address'=>'Liên trung',
                'favicon'=> '1',
                'share_icon'=>'2',
                'hotline'=>'0967461697',
                'email'=> 'hoangtuanthanh@gmail.com',
                'copyright'=>'PD', 
                'facebook'=>'than3',
                'twitter'=> 'than3',
                'google'=>'than3', 
                'youtube'=>'than4@gmail.com',
                'pinterest'=> 'than3',
                'instagram'=>'than3', 
                'iframe_map'=>'than4@gmail.com',
                'user_id'=> 1,
            ],
        ]);
    }
}


