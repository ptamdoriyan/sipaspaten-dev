<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingBeritaAcara extends Migration
{
    public function up()
    {

        $fields = [
            'nomor_ba' => ['type' => 'VARCHAR(100) NULL', 'after' => 'nama_file'],
            'nama_file_ba' => ['type' => 'VARCHAR(100) NULL', 'after' => 'nomor_ba'],
        ];
        $this->forge->addColumn('putusan', $fields);
    }

    public function down()
    {
        //
        $colomn = [
            'nomor_ba',
            'nama_file_ba'
        ];
        $this->forge->dropColumn('putusan', $colomn);
    }
}
