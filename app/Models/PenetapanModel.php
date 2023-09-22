<?php

namespace App\Models;

use CodeIgniter\Model;

class PenetapanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penetapan';
    protected $primaryKey       = 'id_penetapan';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_penetapan',
        'id_user',
        'nomor_penetapan',
        'nama_file_penetapan',
        'status'

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function SumDataPerPA($id_user, $bulan)
    {
        $db = db_connect();
        $query = "SELECT * FROM `penetapan` WHERE id_user = $id_user AND month(tgl_upload) = $bulan";
        return $db->query($query)->getNumRows();
    }
    public function SumDataAllPA($bulan)
    {
        $db = db_connect();
        $query = "SELECT * FROM `penetapan` WHERE month(tgl_upload) = $bulan";
        return $db->query($query)->getNumRows();
    }

    public function bhpGetDataAll()
    {
        $db = db_connect();
        $query = "SELECT penetapan.*, users.name FROM penetapan JOIN users on penetapan.id_user=users.id_user;";
        return $db->query($query)->getResultArray();
    }
    public function bhpGetDatabyLink($id_penetapan)
    {
        $db = db_connect();
        $query = "SELECT penetapan.*, users.name, users.whatsapp FROM penetapan JOIN users on penetapan.id_user=users.id_user WHERE id_penetapan = $id_penetapan";
        return $db->query($query)->getRowArray();
    }
}
