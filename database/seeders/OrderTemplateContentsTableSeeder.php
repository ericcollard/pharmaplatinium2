<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderTemplateContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
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
                'ordertemplate_id' => 1,
                'name' => 'Doliprane',
                'variant' => 'Tab 1000',
                'price' => '3.1500',
                'discount' => '0.0000',
                'step_price' => '2.9500',
                'step_value' => 100,
                'package_qty' => 20,
                'demi_package' => 0,
                'multi_delivery' => 0,
                'free' => 0,
                'free_stp' => NULL,
                'free_qty' => NULL,
                'comment' => 'promo spéciale été',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'ean' => '12214X669',
                'ordertemplate_id' => 1,
                'name' => 'Doliprane',
                'variant' => 'Tab 500',
                'price' => '3.1500',
                'discount' => '0.0000',
                'step_price' => '2.9500',
                'step_value' => 100,
                'package_qty' => 20,
                'demi_package' => 0,
                'multi_delivery' => 0,
                'free' => 0,
                'free_stp' => NULL,
                'free_qty' => NULL,
                'comment' => 'promo spéciale été',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'ean' => '12214X668',
                'ordertemplate_id' => 1,
                'name' => 'Doliprane',
                'variant' => 'cap 1000',
                'price' => '3.1500',
                'discount' => '0.0000',
                'step_price' => '2.9500',
                'step_value' => 100,
                'package_qty' => 20,
                'demi_package' => 0,
                'multi_delivery' => 0,
                'free' => 0,
                'free_stp' => NULL,
                'free_qty' => NULL,
                'comment' => 'promo spéciale été',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'ean' => '12214X670',
                'ordertemplate_id' => 1,
                'name' => 'Doliprane',
                'variant' => 'cap 500',
                'price' => '3.1500',
                'discount' => '0.0000',
                'step_price' => '2.9500',
                'step_value' => 100,
                'package_qty' => 20,
                'demi_package' => 0,
                'multi_delivery' => 0,
                'free' => 0,
                'free_stp' => NULL,
                'free_qty' => NULL,
                'comment' => 'promo spéciale été',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'ean' => '3400933231521',
                'ordertemplate_id' => 2,
                'name' => 'ADVIL 200 mg',
            'variant' => 'comprimé (brique) ; boîte de 20',
                'price' => '4.3200',
                'discount' => '0.0200',
                'step_price' => '3.9500',
                'step_value' => 100,
                'package_qty' => 20,
                'demi_package' => 0,
                'multi_delivery' => 0,
                'free' => 0,
                'free_stp' => NULL,
                'free_qty' => NULL,
                'comment' => NULL,
                'created_at' => '2022-07-13 12:57:27',
                'updated_at' => '2022-07-13 13:37:38',
            ),
            5 => 
            array (
                'id' => 6,
                'ean' => '3400933231522',
                'ordertemplate_id' => 2,
                'name' => 'ADVIL 200 mg',
            'variant' => 'comprimé (brique) ; boîte de 30',
                'price' => '4.9200',
                'discount' => '0.0200',
                'step_price' => '4.5000',
                'step_value' => 100,
                'package_qty' => 20,
                'demi_package' => 1,
                'multi_delivery' => 0,
                'free' => 0,
                'free_stp' => NULL,
                'free_qty' => NULL,
                'comment' => NULL,
                'created_at' => '2022-07-13 13:15:28',
                'updated_at' => '2022-07-13 13:37:44',
            ),
            6 => 
            array (
                'id' => 7,
                'ean' => '3400933231523',
                'ordertemplate_id' => 2,
                'name' => 'ADVIL 400 mg',
            'variant' => 'comprimé (brique) ; boîte de 14',
                'price' => '2.1000',
                'discount' => '0.0200',
                'step_price' => '1.9500',
                'step_value' => 70,
                'package_qty' => 10,
                'demi_package' => 0,
                'multi_delivery' => 0,
                'free' => 0,
                'free_stp' => NULL,
                'free_qty' => NULL,
                'comment' => NULL,
                'created_at' => '2022-07-13 13:16:35',
                'updated_at' => '2022-07-13 13:37:56',
            ),
        ));
        
        
    }
}