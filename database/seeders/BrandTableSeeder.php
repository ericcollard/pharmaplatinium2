<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                    'manager_id' => '2',
                    'created_at' => '2021-01-01 00:00:00',
                    'updated_at' => '2021-03-18 12:31:19',
                )));


        Brand::factory()->count(10)->create();
    }
}
