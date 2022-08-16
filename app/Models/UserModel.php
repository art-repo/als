<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    
    
    public function staff($username, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT `user_id`, `username`, `password`, `isActivated`, `is_evaluated`, `email` FROM `user` WHERE `user_type` = 'Staff'";
        $query = $db->query($sql);
        $data = array();
        foreach ($query->getResultArray() as $row) {
            if($username == $row['username'] && password_verify($password, $row['password'])){
                $data = $row;
                break;
            }
        }
        return $data;

    }
    
    public function coordinator($username, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT `user_id`, `username`, `password`, `isActivated`, `is_evaluated`, `email` FROM `user` WHERE `user_type` = 'Coordinator'";
        $query = $db->query($sql);
        $data = array();
        foreach ($query->getResultArray() as $row) {
            if($username == $row['username'] && password_verify($password, $row['password'])){
                $data = $row;
                break;
            }
        }
        return $data;

    }

    public function update_status($user_id, $isActive)
    {

        $db = \Config\Database::connect();

        $sql = "UPDATE user SET status = :status: WHERE user_id = :user_id:";
        $query = $db->query($sql, [
            'status' => $isActive,
            'user_id' => $user_id
        ]);

        if($query)
        {
            return true;
        }else{
            return false;
        }
    }
}