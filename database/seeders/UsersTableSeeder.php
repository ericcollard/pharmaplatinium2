<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pharmacie Admin',
                'email' => 'info@glissattitude.com',
                'email_verified_at' => '2022-06-01 00:00:00',
                'password' => '$2y$10$Qy.UROfMdVwkZKQlopVjWOapcHwDxLeLIG.4z7E.AJ7C0x2nv7b8e',
                'roles' => '["ROLE_ADMIN"]',
                'avatar_path' => 'JkG1ZzUdXlkvOs77HIGUtfUjOpReEy6ksccYtJuC.jpeg',
                'adress' => '17 montée du Cdt Robien',
                'postal_code' => '13011',
                'city' => 'Marseille',
                'phone' => '06 03 24 19 77',
                'last_login' => '2022-06-01 00:00:00',
                'comment' => NULL,
                'remember_token' => 'OS7oxrV4D1VuklBgdfINvl4G00hlnvO1dMsAJ2icG74ivSiPF9PKyXoXlgIl',
                'created_at' => '2022-06-01 00:00:00',
                'updated_at' => '2022-06-01 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Pharmacie St Jean',
                'email' => 'info@pharmaciestjean.com',
                'email_verified_at' => '2022-01-01 00:00:00',
                'password' => '$2y$10$Qy.UROfMdVwkZKQlopVjWOapcHwDxLeLIG.4z7E.AJ7C0x2nv7b8e',
                'roles' => '["ROLE_GESTIONNAIRE"]',
                'avatar_path' => 'JkG1ZzUdXlkvOs77HIGUtfUjOpReEy6ksccYtJuC.jpeg',
                'adress' => 'Av. Théodore Aubanel',
                'postal_code' => '13600',
                'city' => 'La Ciotat',
                'phone' => '04 42 83 13 18',
                'last_login' => '2022-09-01 00:00:00',
                'comment' => NULL,
                'remember_token' => 'kJN58WjNj5PcYsmDZdWd8DSvF6cRDQ9ZXKKpDI0rXlOI7YXs9oRZU3CkjfH1',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-03-18 12:31:19',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pharmacie Petit Bosquet',
                'email' => 'pharmacie.panetta@wanadoo.fr',
                'email_verified_at' => '2022-01-01 00:00:00',
                'password' => '$2y$10$Qy.UROfMdVwkZKQlopVjWOapcHwDxLeLIG.4z7E.AJ7C0x2nv7b8e',
                'roles' => '["ROLE_GESTIONNAIRE"]',
                'avatar_path' => 'JkG1ZzUdXlkvOs77HIGUtfUjOpReEy6ksccYtJuC.jpeg',
                'adress' => '243 Av. de Montolivet',
                'postal_code' => '13012',
                'city' => 'Marseille',
                'phone' => '04 91 66 23 42',
                'last_login' => '2022-09-01 00:00:00',
                'comment' => NULL,
                'remember_token' => 'e0nOi78AB28vLVFK9MKVS6JzjQMmeKryztRIS8C0lwfXK7XRC9HLKbC3aX2f',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-03-18 12:31:19',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Pharmacie des roches',
                'email' => 'pharmacie.desroches@wanadoo.fr',
                'email_verified_at' => '2022-01-01 00:00:00',
                'password' => '$2y$10$Qy.UROfMdVwkZKQlopVjWOapcHwDxLeLIG.4z7E.AJ7C0x2nv7b8e',
                'roles' => '["ROLE_CLIENT"]',
                'avatar_path' => 'JkG1ZzUdXlkvOs77HIGUtfUjOpReEy6ksccYtJuC.jpeg',
                'adress' => '3 Rue André Audoli',
                'postal_code' => '13010',
                'city' => 'Marseille',
                'phone' => '04 91 75 57 74',
                'last_login' => '2022-09-01 00:00:00',
                'comment' => NULL,
                'remember_token' => 'vzkUUCYhyelStFcWIhEGcOkuDYppje7IMHK8OjYi133DFLX0ycPvudpb0hjO',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-03-18 12:31:19',
            ),
        ));
        
        
    }
}