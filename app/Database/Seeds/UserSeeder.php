<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        //membuat data seed
        #--------------
        // Admin 1
        // PTA/Hakim/Panitera/Panmud 2
        // Pa Se Wilayah 3
        // BHP - 4
        #---------------------

        $users = [
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Pengadilan Agama Bitung',
                'whatsapp' => '082346909192',
                'email' => 'pabitung@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Pengadilan Agama Boroko',
                'whatsapp' => '082259666646',
                'email' => 'paboroko@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Pengadilan Tinggi Agama Manado',
                'whatsapp' => '082259666646',
                'email' => 'ptamanado@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Admin',
                'whatsapp' => '082259666646',
                'email' => 'admin@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Panitera',
                'whatsapp' => '082259666646',
                'email' => 'panitera@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Panmud',
                'whatsapp' => '082346909192',
                'email' => 'panmud@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'BHP Makassar',
                'whatsapp' => '085398613031',
                'email' => 'bhpmakassar@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 4,
                'is_active' => 1
            ],


        ];


        //buat pengulangan data
        foreach ($users as $user) {

            $this->db->table('users')->insert($user);
            # code...
        }
    }
}
