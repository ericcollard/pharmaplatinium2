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
                'id' => 7,
                'title' => 'baush et lomb réassort',
                'dead_line' => '2022-08-27 15:13:12',
                'franco' => 200.0,
                'brand_id' => 13,
                'comment' => NULL,
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-27 15:15:39',
                'updated_at' => '2022-07-27 15:15:39',
            ),
            1 => 
            array (
                'id' => 8,
                'title' => 'grimberg by st jean',
                'dead_line' => '2022-08-28 11:26:49',
                'franco' => 150.0,
                'brand_id' => 18,
                'comment' => NULL,
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-28 11:27:20',
                'updated_at' => '2022-07-28 11:27:20',
            ),
            2 => 
            array (
                'id' => 9,
                'title' => 'ARKOPHARMA FORCAPIL',
                'dead_line' => '2022-08-28 14:07:12',
                'franco' => 200.0,
                'brand_id' => 4,
                'comment' => '<p><strong>8 DZ</strong> PANACHEES =<strong> 42%</strong></p>',
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-28 14:08:09',
                'updated_at' => '2022-07-28 14:24:29',
            ),
            3 => 
            array (
                'id' => 10,
                'title' => 'ARKORELAX STRESS & SOMMEIL',
                'dead_line' => '2022-08-28 14:21:18',
                'franco' => 150.0,
                'brand_id' => 4,
                'comment' => '<p><strong>6DZ = 45%</strong></p>
<p><strong>8DZ = 50%</strong></p>
<p>&nbsp;</p>',
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-28 14:22:39',
                'updated_at' => '2022-07-28 14:26:46',
            ),
            4 => 
            array (
                'id' => 11,
                'title' => 'CYS CONTROL',
                'dead_line' => '2022-08-28 14:35:16',
                'franco' => 150.0,
                'brand_id' => 4,
                'comment' => '<p><strong>6DZ = 40%</strong></p>
<p><strong>8DZ = 42%</strong></p>',
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-28 14:36:06',
                'updated_at' => '2022-07-28 14:41:50',
            ),
            5 => 
            array (
                'id' => 12,
                'title' => 'ARKO VITAMINES ET MINERAUX',
                'dead_line' => '2022-08-28 14:45:47',
                'franco' => 150.0,
                'brand_id' => 4,
                'comment' => NULL,
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-28 14:46:10',
                'updated_at' => '2022-07-28 14:46:10',
            ),
            6 => 
            array (
                'id' => 13,
                'title' => 'PRODUITS DE LA RUCHE',
                'dead_line' => '2022-08-28 15:10:56',
                'franco' => 150.0,
                'brand_id' => 4,
                'comment' => NULL,
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-28 15:11:20',
                'updated_at' => '2022-07-28 15:11:20',
            ),
            7 => 
            array (
                'id' => 14,
                'title' => 'COOPER CONSEIL',
                'dead_line' => '2022-08-28 19:23:36',
                'franco' => 150.0,
                'brand_id' => 5,
                'comment' => '<p>ARNICAN 144U+72UG</p>
<p>MOUSTIQUES 360U+120UG. &nbsp;LOTS comptent double</p>',
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-28 19:24:16',
                'updated_at' => '2022-07-28 21:10:57',
            ),
            8 => 
            array (
                'id' => 15,
                'title' => 'NUTERGIA',
                'dead_line' => '2022-08-29 08:39:19',
                'franco' => 150.0,
                'brand_id' => 16,
                'comment' => NULL,
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-29 08:39:45',
                'updated_at' => '2022-07-29 08:39:45',
            ),
            9 => 
            array (
                'id' => 16,
                'title' => 'NUXE',
                'dead_line' => '2022-08-29 10:39:06',
                'franco' => 150.0,
                'brand_id' => 14,
                'comment' => NULL,
                'status' => 'Brouillon',
                'multi_deliveries' => 0,
                'franco_required' => 0,
                'created_at' => '2022-07-29 10:39:27',
                'updated_at' => '2022-07-29 10:39:27',
            ),
        ));
        
        
    }
}