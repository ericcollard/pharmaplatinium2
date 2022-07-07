<?php

namespace Database\Seeders;

use App\Models\OrderTemplateContent;
use Illuminate\Database\Seeder;

class OrderTemplateContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('order_template_contents')->delete();
        \DB::table('order_template_contents')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'ean' => '12214X667',
                    'ordertemplate_id' => '1',
                    'name' => 'Doliprane',
                    'variant' => 'Tab 1000',
                    'price' => '3.15',
                    'step_price' => '2.95',
                    'step_value' => '100',
                    'package_qty' => '20',
                    'comment' => 'promo spéciale été',
                ),
            1 =>
                array (
                    'id' => 2,
                    'ean' => '12214X669',
                    'ordertemplate_id' => '1',
                    'name' => 'Doliprane',
                    'variant' => 'Tab 500',
                    'price' => '3.15',
                    'step_price' => '2.95',
                    'step_value' => '100',
                    'package_qty' => '20',
                    'comment' => 'promo spéciale été',
                ),
            2 =>
                array (
                    'id' => 3,
                    'ean' => '12214X668',
                    'ordertemplate_id' => '1',
                    'name' => 'Doliprane',
                    'variant' => 'cap 1000',
                    'price' => '3.15',
                    'step_price' => '2.95',
                    'step_value' => '100',
                    'package_qty' => '20',
                    'comment' => 'promo spéciale été',
                ),
            3 =>
                array (
                    'id' => 4,
                    'ean' => '12214X670',
                    'ordertemplate_id' => '1',
                    'name' => 'Doliprane',
                    'variant' => 'cap 500',
                    'price' => '3.15',
                    'step_price' => '2.95',
                    'step_value' => '100',
                    'package_qty' => '20',
                    'comment' => 'promo spéciale été',
                ),
        ));


        OrderTemplateContent::factory()->count(10)->create();
    }
}
