<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateAuditTrail extends Migration
{
    public function up()
    {
        //inisiasi tabel
        $this->forge->addField(
            [
                'id_log'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true
                ],
                'id_uniq_user'          => [
                    'type'           => 'INT',
                    'constraint'     => 5
                ],
                'action'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '255'
                ],
                'date' => [
                    'type'    => 'TIMESTAMP',
                    'default' => new RawSql('CURRENT_TIMESTAMP'),
                ],
            ]
        );

        $this->forge->addKey('id_log', true);
        $this->forge->createTable('logs', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('logs');
    }
}
