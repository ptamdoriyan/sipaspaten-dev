<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTigerUpdateStatus extends Migration
{
    public function up()
    {
        //
        $db = db_connect();
        $db->query("CREATE TRIGGER `update_status` AFTER INSERT ON `berita_acara`
        FOR EACH ROW UPDATE penetapan SET penetapan.status = 2
       WHERE id_penetapan = NEW.id_penetapan");
    }

    public function down()
    {
        //
    }
}
