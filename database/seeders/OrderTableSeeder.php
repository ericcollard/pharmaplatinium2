<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                    'ordertemplatecontent_id' => '1',
                    'user_id' => '1',
                    'qty' => '10',
                    'comment' => 'user 1, otc 1',
                ),
            1 =>
                array (
                    'id' => 2,
                    'ordertemplatecontent_id' => '2',
                    'user_id' => '1',
                    'qty' => '20',
                    'comment' => 'user 1, otc 2',
                ),
            2 =>
                array (
                    'id' => 3,
                    'ordertemplatecontent_id' => '3',
                    'user_id' => '1',
                    'qty' => '30',
                    'comment' => 'user 1, otc 3',
                ),
            3 =>
                array (
                    'id' => 4,
                    'ordertemplatecontent_id' => '4',
                    'user_id' => '1',
                    'qty' => '30',
                    'comment' => 'user 1, otc 4',
                ),
            4 =>
                array (
                    'id' => 5,
                    'ordertemplatecontent_id' => '1',
                    'user_id' => '2',
                    'qty' => '40',
                    'comment' => 'user 2, otc 1',
                ),
            5 =>
                array (
                    'id' => 6,
                    'ordertemplatecontent_id' => '1',
                    'user_id' => '4',
                    'qty' => '50',
                    'comment' => 'user 4, otc 1',
                ),
        ));


        Order::factory()->count(30)->create();
    }
}
