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
                'title' => 'Biogarant janvier',
                'dead_line' => '2022-06-25 00:00:00',
                'franco' => 2000.0,
                'brand_id' => 1,
                'comment' => 'Commande annuelle',
                'status' => 'Ouverte',
                'multi_deliveries' => 1,
                'franco_required' => 0,
                'created_at' => '2022-06-01 00:00:00',
                'updated_at' => '2022-06-01 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Commande rentrée 2022',
                'dead_line' => '2022-08-20 12:52:10',
                'franco' => 2500.0,
                'brand_id' => 6,
                'comment' => '<p>Commande de r&eacute;assort pour livraison d&eacute;but Septembre 2022. Commande suivante pr&eacute;vue courant Novembre 2022</p>',
                'status' => 'Ouverte',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-13 12:53:28',
                'updated_at' => '2022-07-13 13:23:04',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Commande Noel 2021',
                'dead_line' => '2021-11-13 18:54:14',
                'franco' => 2500.0,
                'brand_id' => 6,
                'comment' => '<p>Commande de r&eacute;assort pour livraison d&eacute;but Septembre 2022. Commande suivante pr&eacute;vue courant Novembre 2022</p>',
                'status' => 'Fermée',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-13 18:54:14',
                'updated_at' => '2022-07-15 16:33:26',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Test franco obligatoire',
                'dead_line' => '2022-08-15 16:28:29',
                'franco' => 2000.0,
                'brand_id' => 1,
                'comment' => '<p>Commande annuelle</p>',
                'status' => 'Ouverte',
                'multi_deliveries' => 1,
                'franco_required' => 1,
                'created_at' => '2022-07-15 16:28:29',
                'updated_at' => '2022-07-15 16:52:53',
            ),
        ));
        
        
    }
}