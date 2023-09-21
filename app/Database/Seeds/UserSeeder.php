<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        //membuat data seed
        $users = [
            [
                'id_user' => rand(1, 99999999999),
                'nama' => 'pengadilan Agama Bitung',
                'whatsapp' => '082346909192',
                'email' => 'pabitung@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'role_id' => 4,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'nama' => 'pengadilan Agama Boroko',
                'whatsapp' => '082259666646',
                'email' => 'paboroko@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'role_id' => 4,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'nama' => 'Pengadilan Tinggi Agama Manado',
                'whatsapp' => '082259666646',
                'email' => 'ptamanado@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'nama' => 'admin',
                'whatsapp' => '082259666646',
                'email' => 'admin@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1
            ],
            [
                'id_user' => rand(1, 99999999999),
                'nama' => 'BHP Makassar',
                'whatsapp' => '082259666646',
                'email' => 'bhpmakassar@gmail.com',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'role_id' => 3,
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
