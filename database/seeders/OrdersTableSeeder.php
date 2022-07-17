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
            10 => 
            array (
                'id' => 17,
                'ordertemplatecontent_id' => 6,
                'user_id' => 3,
                'qty' => 30,
                'comment' => NULL,
                'created_at' => '2022-07-15 08:39:35',
                'updated_at' => '2022-07-15 08:39:53',
            ),
            11 => 
            array (
                'id' => 18,
                'ordertemplatecontent_id' => 7,
                'user_id' => 3,
                'qty' => 0,
                'comment' => NULL,
                'created_at' => '2022-07-15 08:39:35',
                'updated_at' => '2022-07-15 08:39:35',
            ),
            12 => 
            array (
                'id' => 19,
                'ordertemplatecontent_id' => 9,
                'user_id' => 1,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:29:31',
                'updated_at' => '2022-07-15 16:29:40',
            ),
            13 => 
            array (
                'id' => 20,
                'ordertemplatecontent_id' => 10,
                'user_id' => 1,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:29:31',
                'updated_at' => '2022-07-15 16:29:40',
            ),
            14 => 
            array (
                'id' => 21,
                'ordertemplatecontent_id' => 11,
                'user_id' => 1,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:29:31',
                'updated_at' => '2022-07-15 16:29:40',
            ),
            15 => 
            array (
                'id' => 22,
                'ordertemplatecontent_id' => 9,
                'user_id' => 2,
                'qty' => 60,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:30:52',
                'updated_at' => '2022-07-15 16:31:07',
            ),
            16 => 
            array (
                'id' => 23,
                'ordertemplatecontent_id' => 10,
                'user_id' => 2,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:30:52',
                'updated_at' => '2022-07-15 16:31:07',
            ),
            17 => 
            array (
                'id' => 24,
                'ordertemplatecontent_id' => 11,
                'user_id' => 2,
                'qty' => 20,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:30:52',
                'updated_at' => '2022-07-15 16:31:07',
            ),
            18 => 
            array (
                'id' => 25,
                'ordertemplatecontent_id' => 9,
                'user_id' => 3,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:31:40',
                'updated_at' => '2022-07-15 16:31:48',
            ),
            19 => 
            array (
                'id' => 26,
                'ordertemplatecontent_id' => 10,
                'user_id' => 3,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:31:40',
                'updated_at' => '2022-07-15 16:31:48',
            ),
            20 => 
            array (
                'id' => 27,
                'ordertemplatecontent_id' => 11,
                'user_id' => 3,
                'qty' => 40,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:31:40',
                'updated_at' => '2022-07-15 16:31:48',
            ),
            21 => 
            array (
                'id' => 28,
                'ordertemplatecontent_id' => 9,
                'user_id' => 4,
                'qty' => 20,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:32:45',
                'updated_at' => '2022-07-15 16:32:56',
            ),
            22 => 
            array (
                'id' => 29,
                'ordertemplatecontent_id' => 10,
                'user_id' => 4,
                'qty' => 30,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:32:45',
                'updated_at' => '2022-07-15 16:32:56',
            ),
            23 => 
            array (
                'id' => 30,
                'ordertemplatecontent_id' => 11,
                'user_id' => 4,
                'qty' => 10,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:32:45',
                'updated_at' => '2022-07-15 16:32:56',
            ),
            24 => 
            array (
                'id' => 31,
                'ordertemplatecontent_id' => 7,
                'user_id' => 2,
                'qty' => 0,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:35:38',
                'updated_at' => '2022-07-15 16:35:38',
            ),
            25 => 
            array (
                'id' => 32,
                'ordertemplatecontent_id' => 12,
                'user_id' => 2,
                'qty' => 300,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:53:28',
                'updated_at' => '2022-07-15 17:07:16',
            ),
            26 => 
            array (
                'id' => 33,
                'ordertemplatecontent_id' => 13,
                'user_id' => 2,
                'qty' => 100,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:53:28',
                'updated_at' => '2022-07-15 16:53:41',
            ),
            27 => 
            array (
                'id' => 34,
                'ordertemplatecontent_id' => 14,
                'user_id' => 2,
                'qty' => 100,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:53:28',
                'updated_at' => '2022-07-15 16:53:41',
            ),
            28 => 
            array (
                'id' => 35,
                'ordertemplatecontent_id' => 15,
                'user_id' => 2,
                'qty' => 100,
                'comment' => NULL,
                'created_at' => '2022-07-15 16:53:28',
                'updated_at' => '2022-07-15 16:53:41',
            ),
        ));
        
        
    }
}