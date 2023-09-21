<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class TableUserStart extends Migration
{
    public function up()
    {
        //

        $this->forge->addField(
            [
                'id_user'          => [
                    'type'           => 'BIGINT',
                    'unsigned'       => true,
                ],
                'nama'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '128'
                ],
                'whatsapp'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '15'
                ],
                'email'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '128'
                ],
                'password'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '255'
                ],
                'role_id'       => [
                    'type'           => 'INT',
                    'constraint'     => '11'
                ],
                'is_active'       => [
                    'type'           => 'INT',
                    'constraint'     => '1'
                ],
                'date_creted' => [
                    'type'    => 'TIMESTAMP',
                    'default' => new RawSql('CURRENT_TIMESTAMP'),
                ],

            ]
        );

        //membuat primary key
        $this->forge->addKey('id_user', TRUE);
        //membuat tabel
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        //menghapus tabel
        $this->forge->dropTable('users');
    }
}
