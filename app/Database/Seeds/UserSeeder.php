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
        // Hakim - 2
        // Panitera - 3
        // Panmud - 4
        // BHP - 5
        // Admin PA - 6 
        // User PTA - 7

        #---------------------

        $users = [
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Pengadilan Agama Bitung',
                'whatsapp' => '082346909192',
                'email' => 'pabitung@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'role_id' => 6,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Pengadilan Agama Boroko',
                'whatsapp' => '082259666646',
                'email' => 'paboroko@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'role_id' => 6,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'name' => 'Pengadilan Tinggi Agama Manado',
                'whatsapp' => '082259666646',
                'email' => 'ptamanado@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 7,
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
                'name' => 'BHP Makassar',
                'whatsapp' => '082259666646',
                'email' => 'bhpmakassar@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 5,
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
