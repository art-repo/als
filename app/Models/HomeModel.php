<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    public function select_barangay()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `barangay`, `about`, `address`, `contact_no`, `logo`, `cover_photo` FROM `barangay`";
        $query = $db->query($sql);
        return $query->getResultArray();
    }
}