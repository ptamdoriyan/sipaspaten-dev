<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTablePutusan extends Migration
{
    public function up()
    {
        //buat tabel
        $this->forge->addField(
            [
                'id_putusan'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true
                ],
                'id_uniq'          => [
                    'type'           => 'INT',
                    'constraint'     => 5
                ],
                'nomor_putusan'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100'
                ],
                'link_putusan'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '255'
                ],
                'status' => [
                    'type'       => 'INT',
                    'constraint' => 1
                ],
                'tgl_upload' => [
                    'type'    => 'TIMESTAMP',
                    'default' => new RawSql('CURRENT_TIMESTAMP'),
                ],
            ]
        );

        $this->forge->addKey('id_putusan', true);
        $this->forge->createTable('putusan', true);
    }

    public function down()
    {
        // menghapus tabel putusan
        $this->forge->dropTable('putusan');
    }
}
