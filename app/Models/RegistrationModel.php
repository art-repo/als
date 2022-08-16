<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\PseudoTypes\True_;

class RegistrationModel extends Model
{

    function check_barangay($barangay)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT * FROM `barangay`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->barangay == $barangay && !empty($row->user_id)){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    function select_activation_code($activation_code)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `activation_code` FROM `als_coordinator`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->activation_code == $activation_code){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    function check_acid($user_id)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `user_id` FROM `als_coordinator`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->user_id == $user_id){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    function select_brgy_activation_code($activation_code)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `activation_code` FROM `user` WHERE `user_type` = 'Coordinator'";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->activation_code == $activation_code){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    function select_brgy_staff_code($activation_code)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `activation_code` FROM `user` WHERE `user_type` = 'Staff'";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->activation_code == $activation_code){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    function select_als_teacher_code($activation_code)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `activation_code` FROM `teacher`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->activation_code == $activation_code){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    function check_cid($user_id)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `user_id` FROM `user` WHERE `user_type` = 'Coordinator'";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->user_id == $user_id){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    function check_sid($user_id)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `user_id` FROM `user` WHERE `user_type` = 'Staff'";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->user_id == $user_id){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    function check_tid($user_id)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `user_id` FROM `teacher`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->user_id == $user_id){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    public function insert_als_coordinator($als_coordinator_id, $activation_code, $lastname, $firstname, $district, $email, $username, $password, $tch_id_loc)
    {
        $db = \Config\Database::connect();
        $sql = 'CALL insert_als_coord(:als_coordinator_id:, :activation_code:, :district:, :lastname:, :firstname:, :email:, :username:, :password:, :tch_id_loc:)';
        $query = $db->query($sql, [
            'als_coordinator_id' => $als_coordinator_id, 
            'activation_code' => $activation_code, 
            'district' => $district, 
            'lastname' => $lastname, 
            'firstname' => $firstname, 
            'email' => $email, 
            'username' => $username, 
            'password' => $password,
            'tch_id_loc' => $tch_id_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function insert_als_teacher($als_teacher_id, $activation_code, $lastname, $firstname, $district, $email, $username, $password, $tch_id_loc)
    {
        $db = \Config\Database::connect();
        $sql = 'CALL insert_als_teacher(:als_teacher_id:, :activation_code:, :district:, :lastname:, :firstname:, :email:, :username:, :password:, :tch_id_loc:)';
        $query = $db->query($sql, [
            'als_teacher_id' => $als_teacher_id, 
            'activation_code' => $activation_code, 
            'district' => $district, 
            'lastname' => $lastname, 
            'firstname' => $firstname, 
            'email' => $email, 
            'username' => $username, 
            'password' => $password,
            'tch_id_loc' => $tch_id_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function insert_brgy_coordinator($brgy_coordinator_id, $activation_code, $lastname, $firstname, $district, $barangay, $email, $username, $password, $brgy_id_loc)
    {
        $db = \Config\Database::connect();
        $sql = 'CALL insert_coord(:brgy_coordinator_id:,:activation_code:, :district:, :barangay:, :lastname:, :firstname:, :email:, :username:, :password:, :brgy_id_loc:)';
        $query = $db->query($sql, [
            'brgy_coordinator_id' => $brgy_coordinator_id, 
            'activation_code' => $activation_code, 
            'lastname' => $lastname, 
            'firstname' => $firstname, 
            'district' => $district, 
            'barangay' => $barangay,
            'email' => $email, 
            'username' => $username, 
            'password' => $password,
            'brgy_id_loc' => $brgy_id_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function insert_brgy_staff($brgy_staff_id, $activation_code, $lastname, $firstname, $district, $barangay, $email, $username, $password, $brgy_id_loc)
    {
        $db = \Config\Database::connect();
        $sql = 'CALL insert_staff(:brgy_staff_id:,:activation_code:, :district:, :barangay:, :lastname:, :firstname:, :email:, :username:, :password:, :brgy_id_loc:)';
        $query = $db->query($sql, [
            'brgy_staff_id' => $brgy_staff_id, 
            'activation_code' => $activation_code, 
            'lastname' => $lastname, 
            'firstname' => $firstname, 
            'district' => $district, 
            'barangay' => $barangay,
            'email' => $email, 
            'username' => $username, 
            'password' => $password,
            'brgy_id_loc' => $brgy_id_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function select_brgy_id($brgy)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `user_id` FROM `barangay` WHERE `barangay` = :brgy:";
        $query = $db->query($sql, [
            'brgy' => $brgy
        ]);

        return $query->getRowArray();
    }

    public function update_id($staff_id, $brgy_id_loc)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `credential` SET `brgy_id_loc`=:brgy_loc_id: WHERE `user_id`=:staff_id:";
        $query = $db->query($sql, [
            'staff_id' => $staff_id,
            'brgy_loc_id' => $brgy_id_loc
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function update_coordinator_credential($coordinator_id, $brgy_id_loc)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `credential` SET `brgy_id_loc`=:brgy_loc_id: WHERE `user_id`=:coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'brgy_loc_id' => $brgy_id_loc
        ]);

        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function update_teacher_credential($teacher_id, $brgy_id_loc)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher_credential` SET `id_loc`=:brgy_loc_id: WHERE `user_id`=:coordinator_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'brgy_loc_id' => $brgy_id_loc
        ]);

        if($query == true){
            return true;
        }else{
            return false;
        }
    }
    public function insert_notif($notif_content, $notif_type, $brgy)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `notification`( `notif_content`, `notif_type`, `brgy`) VALUES (:notif_content:, :notif_type:, :brgy:)";
        $query = $db->query($sql, [
            'notif_content' => $notif_content,
            'notif_type' => $notif_type,
            'brgy' => $brgy
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

}