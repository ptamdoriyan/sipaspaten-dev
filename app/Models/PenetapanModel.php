<?php

namespace App\Models;

use CodeIgniter\Model;

class PenetapanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penetapan';
    protected $primaryKey       = 'id_penetapan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_uniq_user',
        'nomor_penetapan',
        'penetapan_uniq',
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


    public function SumDataPerPA($id_uniq_user, $bulan)
    {
        $db = db_connect();
        $query = "SELECT * FROM `penetapan` WHERE id_uniq_user = $id_uniq_user AND month(tgl_upload) = $bulan";
        return $db->query($query)->getNumRows();
    }

    public function bhpGetDataAll()
    {
        $db = db_connect();
        $query = "SELECT penetapan.*, users.nama FROM penetapan JOIN users on penetapan.id_uniq_user=users.id_uniq;";
        return $db->query($query)->getResultArray();
    }
    public function bhpGetDatabyLink($penetapan_uniq)
    {
        $db = db_connect();
        $query = "SELECT penetapan.*, users.nama, users.whatsapp FROM penetapan JOIN users on penetapan.id_uniq_user=users.id_uniq WHERE penetapan_uniq = $penetapan_uniq";
        return $db->query($query)->getRowArray();
    }
}
