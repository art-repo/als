<?php

namespace App\Models;

use CodeIgniter\Model;

class OscyaModel extends Model
{
    //check if generated ID already exists

    public function check_oid($oscya_id)
    {

        $db = \Config\Database::connect();
        
        $sql = "SELECT `oscya_id`FROM `oscya_info`";
        $query = $db->query($sql);
        $isAvailable = false;
        foreach ($query->getResult() as $row) {
            if($row->oscya_id == $oscya_id){
                $isAvailable = true;
                break;
            }else{
                $isAvailable;
                break;
            }
        }

        return $isAvailable;
    
    }
    public function insertOscya($oid, $user_id, $lastname, $firstname, $middlename, $extension, $fullname, $birthdate, $age, $gender, $civil_status, $religion, $email, $contact, $facebook, $street, $barangay, $district, $city, $state, $zipcode, $pstreet, $pbarangay, $pdistrict, $pcity, $pstate, $pzipcode, $gfullname, $gemail, $gcontact, $gfacebook, $educ_attainment, $reason, $other_reason, $disability, $is_pwd, $has_pwd, $other_disability, $disease, $is_employed, $is_fps_member, $is_interested, $mapping_date)
    {
        $db = \Config\Database::connect();

        $sql = "CALL insertOscyaDetails( :oid:, :user_id:, :lastname:, :firstname:, :middlename:, :extension:, :fullname:, :birthdate:, :age:, :gender:, :civil_status:, :religion:, :email:, :contact:, :facebook:, :street:, :barangay:, :district:, :city:, :state:, :zipcode:, :pstreet:, :pbarangay:, :pdistrict:, :pcity:, :pstate:, :pzipcode:, :gfullname:, :gemail:, :gcontact:, :gfacebook:, :educ_attainment:, :reason:, :other_reason:, :disability:, :is_pwd:, :has_pwd:, :other_disability:, :disease:, :is_employed:, :is_fps_member:, :is_interested:, :mapping_date:)";

        $query = $db->query($sql, [
            'oid' => $oid,
            'user_id' => $user_id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'extension' => $extension,
            'fullname' =>$fullname,
            'birthdate' => $birthdate,
            'age' => $age,
            'gender' => $gender,
            'civil_status' => $civil_status,
            'religion' => $religion,
            'email' => $email, 
            'contact' => $contact,
            'facebook' => $facebook,
            'street' => $street,
            'barangay' => $barangay,
            'district' => $district,
            'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode,
            'pstreet' => $pstreet,
            'pbarangay' => $pbarangay,
            'pdistrict' => $pdistrict,
            'pcity' => $pcity,
            'pstate' => $pstate,
            'pzipcode' => $pzipcode,
            'gfullname' => $gfullname,
            'gemail' => $gemail,
            'gcontact' => $gcontact,
            'gfacebook' => $gfacebook,
            'educ_attainment' => 'GRADE ' . $educ_attainment,
            'reason' => $reason,
            'other_reason' => $other_reason,
            'disability' => $disability,
            'is_pwd' => $is_pwd,
            'has_pwd' => $has_pwd,
            'other_disability' => $other_disability,
            'disease' => $disease,
            'is_employed' => $is_employed,
            'is_fps_member' => $is_fps_member,
            'is_interested' => $is_interested,
            'mapping_date' => $mapping_date
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }
}