<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTigerUpdateStatus extends Migration
{
    public function up()
    {
        //triger create berita acara
        $db = db_connect();
        $db->query("CREATE TRIGGER `insert_berita_acara` AFTER INSERT ON `berita_acara`
        FOR EACH ROW UPDATE penetapan SET penetapan.status = 2
       WHERE id_penetapan = NEW.id_penetapan");

        //triger delete berita acara
        $db->query("CREATE TRIGGER `delete_berita_acara` AFTER DELETE ON `berita_acara`
        FOR EACH ROW UPDATE penetapan SET penetapan.status = 1
       WHERE id_penetapan = OLD.id_penetapan");
    }

    public function down()
    {
        //
    }
}
