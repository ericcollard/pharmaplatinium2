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
                'name' => 'Administrateur général',
                'email' => 'eric@glissattitude.com',
                'email_verified_at' => '2022-06-01 01:00:00',
                'password' => '$2y$10$Qy.UROfMdVwkZKQlopVjWOapcHwDxLeLIG.4z7E.AJ7C0x2nv7b8e',
                'roles' => '["ROLE_ADMIN"]',
                'avatar_path' => 'JkG1ZzUdXlkvOs77HIGUtfUjOpReEy6ksccYtJuC.jpeg',
                'adress' => '17 montée du Cdt Robien',
                'postal_code' => '13011',
                'city' => 'Marseille',
                'phone' => '06 03 24 19 77',
                'last_login' => '2022-06-01 01:00:00',
                'comment' => NULL,
                'remember_token' => 'CLu5MlTNuldXa7PaWWbjtAxnZrFlEXzYWiO8rhontM2Cq6JJ4zAIEGwpNGaK',
                'created_at' => '2022-06-01 01:00:00',
                'updated_at' => '2022-07-21 15:35:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Pharmacie St Jean',
                'email' => 'phcie.saintjean@gmail.com',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$dQyDGllaafGFY0GsvjkGVuOcfIOmTMiMVayD30f/m3ufr/VkX3Jsm',
                'roles' => '["ROLE_GESTIONNAIRE"]',
                'avatar_path' => NULL,
                'adress' => 'Av. Théodore Aubanel',
                'postal_code' => '13600',
                'city' => 'La Ciotat',
                'phone' => '04 42 83 13 18',
                'last_login' => '2022-09-01 01:00:00',
                'comment' => NULL,
                'remember_token' => 'MydtjRsskyILUw3Qet0qPE7jhQ0QhdfagmIdTl75HAjTO6dRKaIrgHObV0qo',
                'created_at' => '2020-01-01 01:00:00',
                'updated_at' => '2022-07-26 13:00:58',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pharmacie Petit Bosquet',
                'email' => 'pharmacie.panetta@wanadoo.fr',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$z53uaS3rt6CHpN8oDbw8FeRM07g4L4TxgBIncUCpBE0ujfHzPNdRO',
                'roles' => '["ROLE_ADMIN","ROLE_GESTIONNAIRE"]',
                'avatar_path' => NULL,
                'adress' => '243 Av. de Montolivet',
                'postal_code' => '13012',
                'city' => 'Marseille',
                'phone' => '04 91 66 23 42',
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => '8jYyVKRzTbFhjdyi8qMEeVlTFBB2pCUjXUE8cOwWkTeqS3iyMTTEzM9pyMoD',
                'created_at' => '2020-01-01 01:00:00',
                'updated_at' => '2022-07-21 10:37:56',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Pharmacie des roches',
                'email' => 'pharmacie.des.roches@orange.fr',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$ySsDAwrGMuEOiSiBkbKcqu2p5N37D.z/ZKIVRDADdTOSiWrN5mas6',
                'roles' => '["ROLE_ADMIN","ROLE_GESTIONNAIRE"]',
                'avatar_path' => NULL,
                'adress' => '3 Rue André Audoli',
                'postal_code' => '13010',
                'city' => 'Marseille',
                'phone' => '04 91 75 57 74',
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => 'Av5rRe72lbmWQoc3NkKlSV5JoLlGQtyglkfRILamXpCFDDShrcpFdzvxTXC2',
                'created_at' => '2020-01-01 01:00:00',
                'updated_at' => '2022-07-26 12:59:22',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Pharmacie Dencausse',
                'email' => 'pharmacie.ferrieres@wanadoo.fr',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$uVp37hmPVwGHGovI/DqG5eLxu5nEgsqAEidTIthRYbDJRUs8Rjidq',
                'roles' => '["ROLE_GESTIONNAIRE"]',
                'avatar_path' => NULL,
                'adress' => '14 RUE COLONEL DENFERT',
                'postal_code' => '13500',
                'city' => 'Martigues',
                'phone' => NULL,
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => 'OGD439aNmvnxgZbN6PWx8MXb3JXtJ29ACAxucA7XeM9cNhLOyo0palGImwD5',
                'created_at' => NULL,
                'updated_at' => '2022-07-21 13:11:40',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Pharmacie Conciatori',
                'email' => 'pharmacieflammarion@gmail.com',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$6/cUZhWNi.8.HLDhxZp3.OI/THd06p5ejS0edXmXeTBxnk0FCLMP6',
                'roles' => '["ROLE_GESTIONNAIRE"]',
                'avatar_path' => NULL,
                'adress' => '100 BD FLAMMARION',
                'postal_code' => '13004',
                'city' => 'Marseille',
                'phone' => NULL,
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-21 15:39:53',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Pharmacie Simonet',
                'email' => 'pharmacie.technopole@gmail.com',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$TZIC5/.FJuM/oB//6eECFOOqhL/6aljxe1Pm162qQMmqRlBJJxPIC',
                'roles' => '["ROLE_GESTIONNAIRE"]',
                'avatar_path' => NULL,
                'adress' => '1 RUE AUGUSTIN FRESNEL',
                'postal_code' => '13013',
                'city' => 'Marseille',
                'phone' => NULL,
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-21 13:12:10',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Pharmacie Tamborini-Ducassou',
                'email' => 'phciedairbel@perso.alliadis.net',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$A6GrbNi9mdwvoWmyL.NwmuDTYRBKbC8OZH6T9I7RA9jb4s4U723bG',
                'roles' => '["ROLE_GESTIONNAIRE"]',
                'avatar_path' => NULL,
                'adress' => 'CC BEL AIR 117 CH DE LA PARE',
                'postal_code' => '13011',
                'city' => 'Marseille',
                'phone' => NULL,
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-21 13:13:22',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Pharmacie Placidi',
                'email' => 'pharmacie.placidi@perso.alliadis.net',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$1xovU8JKyuONQWSv1YWX4.7BLXhaMfyAodRLjqv3idbS/QELf53yu',
                'roles' => '["ROLE_CLIENT"]',
                'avatar_path' => NULL,
                'adress' => '138 RUE DU DOCTEUR CAUVIN',
                'postal_code' => '13012',
                'city' => 'Marseille',
                'phone' => NULL,
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-21 10:38:51',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Pharmacie Gastaldi',
                'email' => 'pharmacie.chanteperdrix@gmail.com',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$0cbpu2CaLN7Vc.8KMIsjAeLg8HCH2NYdQbNg9Rqe1.SetEItH9lnO',
                'roles' => '["ROLE_GESTIONNAIRE"]',
                'avatar_path' => NULL,
                'adress' => '22 TRAVERSE CHANTE PERDRIX',
                'postal_code' => '13010',
                'city' => 'Marseille',
                'phone' => '0491447703',
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => '2kh3bPlOOTDvMPTUblS9zuQ2nTQGqk3pJ3cVUg0FeaA6anBLNOgpSvzRVrhL',
                'created_at' => NULL,
                'updated_at' => '2022-07-27 10:36:49',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Pharmacie de l\'Hippodrome',
                'email' => 'pharmahippo13@gmail.com',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$8zZZ.Dy1lSEqUAiufSeuGuimLB5gzqoE6R81Y1UMSF7ca.2clg82.',
                'roles' => '["ROLE_CLIENT"]',
                'avatar_path' => NULL,
                'adress' => '88 bvd mireille lauze',
                'postal_code' => '13010',
                'city' => 'Marseille',
                'phone' => NULL,
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-21 10:36:20',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Pharmacie Cayol',
                'email' => 'pharmacie.cayol@wanadoo.fr',
                'email_verified_at' => '2022-01-01 01:00:00',
                'password' => '$2y$10$DUMO3iPBqU0wHjHjPUdiHurmQ31s2lg6S1jbQ9l4mHUzTggcQ9WM2',
                'roles' => '["ROLE_CLIENT"]',
                'avatar_path' => NULL,
                'adress' => '1 Rue des Camélias',
                'postal_code' => '13500',
                'city' => 'Martigues',
                'phone' => NULL,
                'last_login' => '2022-07-01 01:00:00',
                'comment' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-21 10:35:19',
            ),
        ));
        
        
    }
}