<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ordertemplatecontent_id' => 1,
                'user_id' => 1,
                'qty' => 1000,
                'comment' => 'user 1, otc 1',
                'created_at' => NULL,
                'updated_at' => '2022-07-13 17:22:34',
            ),
            1 => 
            array (
                'id' => 2,
                'ordertemplatecontent_id' => 2,
                'user_id' => 1,
                'qty' => 20,
                'comment' => 'user 1, otc 2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'ordertemplatecontent_id' => 3,
                'user_id' => 1,
                'qty' => 40,
                'comment' => 'user 1, otc 3',
                'created_at' => NULL,
                'updated_at' => '2022-07-13 13:41:48',
            ),
            3 => 
            array (
                'id' => 4,
                'ordertemplatecontent_id' => 4,
                'user_id' => 1,
                'qty' => 60,
                'comment' => 'user 1, otc 4',
                'created_at' => NULL,
                'updated_at' => '2022-07-13 13:41:48',
            ),
            4 => 
            array (
                'id' => 11,
                'ordertemplatecontent_id' => 5,
                'user_id' => 1,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-13 14:06:12',
                'updated_at' => '2022-07-13 14:06:40',
            ),
            5 => 
            array (
                'id' => 12,
                'ordertemplatecontent_id' => 6,
                'user_id' => 1,
                'qty' => 30,
                'comment' => NULL,
                'created_at' => '2022-07-13 14:06:12',
                'updated_at' => '2022-07-13 14:06:34',
            ),
            6 => 
            array (
                'id' => 13,
                'ordertemplatecontent_id' => 7,
                'user_id' => 1,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-13 14:06:12',
                'updated_at' => '2022-07-13 14:06:34',
            ),
            7 => 
            array (
                'id' => 14,
                'ordertemplatecontent_id' => 5,
                'user_id' => 2,
                'qty' => 20,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 15,
                'ordertemplatecontent_id' => 6,
                'user_id' => 2,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 16,
                'ordertemplatecontent_id' => 5,
                'user_id' => 3,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}