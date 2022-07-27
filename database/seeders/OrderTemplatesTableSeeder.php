<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_templates')->delete();
        
        \DB::table('order_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Commande mise en place annuelle 2022',
                'dead_line' => '2022-01-02 01:00:00',
                'franco' => 2000.0,
                'brand_id' => 14,
                'comment' => 'Commande annuelle, fréquence 12 mois',
                'status' => 'Fermée',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2021-11-01 01:00:00',
                'updated_at' => '2022-06-01 01:00:00',
            ),
            1 => 
            array (
                'id' => 3,
                'title' => 'Réassort rentrée',
                'dead_line' => '2022-08-30 15:28:40',
                'franco' => 2000.0,
                'brand_id' => 14,
                'comment' => '<p>R&eacute;assort</p>',
                'status' => 'Ouverte',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-21 15:28:40',
                'updated_at' => '2022-07-21 22:07:00',
            ),
            2 => 
            array (
                'id' => 7,
                'title' => 'baush et lomb réassort',
                'dead_line' => '2022-08-27 14:13:12',
                'franco' => 200.0,
                'brand_id' => 13,
                'comment' => NULL,
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-27 14:15:39',
                'updated_at' => '2022-07-27 14:15:39',
            ),
        ));
        
        
    }
}