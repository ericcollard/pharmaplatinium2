<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatisticsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('statistics')->delete();
        
        \DB::table('statistics')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ip' => NULL,
                'user_id' => 5,
                'hits' => 3,
                'statisticable_id' => 168,
                'statisticable_type' => 'App\\Models\\Device',
            'agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
                'created_at' => '2022-03-20 23:51:17',
                'updated_at' => '2022-03-21 00:13:24',
            ),
            1 => 
            array (
                'id' => 2,
                'ip' => NULL,
                'user_id' => 5,
                'hits' => 2,
                'statisticable_id' => 141,
                'statisticable_type' => 'App\\Models\\Device',
            'agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
                'created_at' => '2022-03-20 23:51:57',
                'updated_at' => '2022-03-21 00:13:28',
            ),
            2 => 
            array (
                'id' => 3,
                'ip' => NULL,
                'user_id' => 5,
                'hits' => 1,
                'statisticable_id' => 161,
                'statisticable_type' => 'App\\Models\\Device',
            'agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
                'created_at' => '2022-03-20 23:53:35',
                'updated_at' => '2022-03-20 23:53:35',
            ),
            3 => 
            array (
                'id' => 4,
                'ip' => NULL,
                'user_id' => 5,
                'hits' => 1,
                'statisticable_id' => 190,
                'statisticable_type' => 'App\\Models\\Device',
            'agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
                'created_at' => '2022-03-21 00:23:26',
                'updated_at' => '2022-03-21 00:23:26',
            ),
            4 => 
            array (
                'id' => 5,
                'ip' => NULL,
                'user_id' => 5,
                'hits' => 1,
                'statisticable_id' => 162,
                'statisticable_type' => 'App\\Models\\Device',
            'agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
                'created_at' => '2022-03-21 00:23:30',
                'updated_at' => '2022-03-21 00:23:30',
            ),
        ));
        
        
    }
}