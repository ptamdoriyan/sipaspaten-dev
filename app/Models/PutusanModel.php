<?php

namespace App\Models;

use CodeIgniter\Model;

class PutusanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'putusan';
    protected $primaryKey       = 'id_putusan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_uniq',
        'nomor_putusan',
        'link_putusan',
        'nama_file',
        'nama_file_ba',
        'nomor_ba',
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


    public function SumDataPerPA($id_uniq, $bulan)
    {
        $db = db_connect();
        $query = "SELECT * FROM `putusan` WHERE id_uniq = $id_uniq AND month(tgl_upload) = $bulan";
        return $db->query($query)->getNumRows();
    }

    public function bhpGetDataAll()
    {
        $db = db_connect();
        $query = "SELECT putusan.*, users.nama FROM putusan JOIN users on putusan.id_uniq=users.id_uniq;";
        return $db->query($query)->getResultArray();
    }
    public function bhpGetDatabyLink($link_putusan)
    {
        $db = db_connect();
        $query = "SELECT putusan.*, users.nama, users.whatsapp FROM putusan JOIN users on putusan.id_uniq=users.id_uniq WHERE link_putusan = $link_putusan";
        return $db->query($query)->getRowArray();
    }
}
