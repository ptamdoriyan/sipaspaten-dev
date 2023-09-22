<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateTableBeritaAcara extends Migration
{
    public function up()
    {
        //
        $this->forge->addField(
            [
                'id_berita_accara'          => [
                    'type'           => 'BIGINT',
                    'unsigned'       => true,
                ],
                'id_penetapan'          => [
                    'type'           => 'BIGINT',
                ],
                'nomor_penetapan'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100'
                ],
                'nama_file_penetapan'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '255'
                ],
                'tgl_upload' => [
                    'type'    => 'TIMESTAMP',
                    'default' => new RawSql('CURRENT_TIMESTAMP'),
                ],
            ]
        );
        $this->forge->addKey('id_berita_acara', true);
        $this->forge->createTable('berita_acara', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('berita_acara');
    }
}
