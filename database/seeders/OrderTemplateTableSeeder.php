<?php

namespace Database\Seeders;

use App\Models\OrderTemplate;
use Illuminate\Database\Seeder;

class OrderTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('order_templates')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'title' => 'Biogarant janvier',
                    'dead_line' => '2022-06-25 00:00:00',
                    'franco' => '2000',
                    'brand_id' => '1',
                    'comment' => 'Commande annuelle',
                    'status' => 'Brouillon',
                    'multi_deliveries' => '1',
                    'created_at' => '2022-06-01 00:00:00',
                    'updated_at' => '2022-06-01 00:00:00',
                ),
        ));


        OrderTemplate::factory()->count(5)->create();

    }
}
