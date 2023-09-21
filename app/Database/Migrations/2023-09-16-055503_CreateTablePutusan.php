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
                'id_penetapan'          => [
                    'type'           => 'BIGINT',
                    'unsigned'       => true,
                ],
                'id_user'          => [
                    'type'           => 'INT',
                    'constraint'     => 255
                ],
                'nomor_penetapan'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100'
                ],
                'nama_file_penetapan'       => [
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

        $this->forge->addKey('id_penetapan', true);
        $this->forge->createTable('penetapan', true);
    }

    public function down()
    {
        // menghapus tabel putusan
        $this->forge->dropTable('penetapan');
    }
}
