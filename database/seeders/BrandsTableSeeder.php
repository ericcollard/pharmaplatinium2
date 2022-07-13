<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Biogaran',
                'contact_email' => 'info@biogarant.com',
                'contact_phone' => '07 52 65 44 87',
                'contact_name' => 'Albert DURANT',
                'discount' => 0.3,
                'manager_id' => 2,
                'comment' => NULL,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-03-18 12:31:19',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Aven',
                'contact_email' => 'info@aven.com',
                'contact_phone' => '07 52 65 44 87',
                'contact_name' => 'Albert DUPONT',
                'discount' => 0.35,
                'manager_id' => 3,
                'comment' => NULL,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-03-18 12:31:19',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Viatris',
                'contact_email' => 'info@viatris.com',
                'contact_phone' => '07 52 65 44 87',
                'contact_name' => 'Catherine VIOUX',
                'discount' => 0.21,
                'manager_id' => 3,
                'comment' => NULL,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-03-18 12:31:19',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Bayer',
                'contact_email' => 'info@bayer.com',
                'contact_phone' => '07 52 65 44 87',
                'contact_name' => 'Catherine PINCHON',
                'discount' => 0.25,
                'manager_id' => 3,
                'comment' => NULL,
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-03-18 12:31:19',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Actifed',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 4,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-13 12:51:32',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Pfizer',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.11,
                'manager_id' => 1,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Akileine',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 2,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Apaisyl',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 2,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Baccide',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 4,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Bergasol',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 4,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Biafine',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 4,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Bioethic',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 1,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Bledilait',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 1,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Caudalie',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 1,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Clarins',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 2,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Compeed',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 2,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Cryopharma',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 2,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Dexeryl',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 2,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Drill',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 2,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Efferalgan',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 3,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Elmex',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 3,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Gallia',
                'contact_email' => NULL,
                'contact_phone' => NULL,
                'contact_name' => NULL,
                'discount' => 0.0,
                'manager_id' => 3,
                'comment' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}