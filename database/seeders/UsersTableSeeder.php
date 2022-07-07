<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Info Glissattitude',
                    'email' => 'info@glissattitude.com',
                    'email_verified_at' => '2020-01-01 00:00:00',
                    'password' => '$2y$10$Qy.UROfMdVwkZKQlopVjWOapcHwDxLeLIG.4z7E.AJ7C0x2nv7b8e',
                    'remember_token' => 'lCbi4dCTIr5bJM2Jd3FEO1oFIdZrDgs6f5OOFIPx9CfvoP5GNG7GZQ4m00Ok',
                    'roles' => '["ROLE_ADMIN"]',
                    'avatar_path' => 'JkG1ZzUdXlkvOs77HIGUtfUjOpReEy6ksccYtJuC.jpeg',
                    'adress' => '17 montée du Cdt Robien',
                    'postal_code' => '13011',
                    'city' => 'Marseille',
                    'phone' => '06 03 24 19 77',
                    'last_login'=> '2021-09-01 00:00:00',
                    'created_at' => '2020-01-01 00:00:00',
                    'updated_at' => '2020-03-18 12:31:19',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'St Jean',
                    'email' => 'info@pharmaciestjean.com',
                    'email_verified_at' => '2022-01-01 00:00:00',
                    'password' => '$2y$10$Qy.UROfMdVwkZKQlopVjWOapcHwDxLeLIG.4z7E.AJ7C0x2nv7b8e',
                    'remember_token' => 'lCbi4dCTIr5bJM2Jd3FEO1oFIdZrDgs6f5OOFIPx9CfvoP5GNG7GZQ4m00Ok',
                    'roles' => '["ROLE_GESTIONNAIRE"]',
                    'avatar_path' => 'JkG1ZzUdXlkvOs77HIGUtfUjOpReEy6ksccYtJuC.jpeg',
                    'adress' => 'Av. Théodore Aubanel',
                    'postal_code' => '13600',
                    'city' => 'La Ciotat',
                    'phone' => '04 42 83 13 18',
                    'last_login'=> '2022-09-01 00:00:00',
                    'created_at' => '2020-01-01 00:00:00',
                    'updated_at' => '2020-03-18 12:31:19',
                ),

            2 =>
                array (
                    'id' => 3,
                    'name' => 'Petit Bosquet',
                    'email' => 'pharmacie.panetta@wanadoo.fr',
                    'email_verified_at' => '2022-01-01 00:00:00',
                    'password' => '$2y$10$Qy.UROfMdVwkZKQlopVjWOapcHwDxLeLIG.4z7E.AJ7C0x2nv7b8e',
                    'remember_token' => 'lCbi4dCTIr5bJM2Jd3FEO1oFIdZrDgs6f5OOFIPx9CfvoP5GNG7GZQ4m00Ok',
                    'roles' => '["ROLE_GESTIONNAIRE"]',
                    'avatar_path' => 'JkG1ZzUdXlkvOs77HIGUtfUjOpReEy6ksccYtJuC.jpeg',
                    'adress' => '243 Av. de Montolivet',
                    'postal_code' => '13012',
                    'city' => 'Marseille',
                    'phone' => '04 91 66 23 42',
                    'last_login'=> '2022-09-01 00:00:00',
                    'created_at' => '2020-01-01 00:00:00',
                    'updated_at' => '2020-03-18 12:31:19',
                ),

        ));


        User::factory()->count(10)->create();

    }
}
