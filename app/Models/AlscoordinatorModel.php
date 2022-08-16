<?php

namespace App\Models;

use CodeIgniter\Model;

class AlscoordinatorModel extends Model
{

    public function check_cid($coordinator_id)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `user_id` FROM `user`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->user_id == $coordinator_id){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }
    
    public function alscoord_login($username, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT `user_id`, `username`, `password`, `isActivated`, `is_evaluated`, `email` FROM `als_coordinator`";
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

    public function select_email($email)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT `user_id`, `username` FROM `als_coordinator` WHERE `email` = :email: AND is_email_activated = 1";

        $query = $db->query($sql, [
            'email' => $email
        ]);

        return $query->getRowArray();
    }

    public function account($user_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT * FROM `als_coordinator` WHERE `user_id` = :user_id:";

        $query = $db->query($sql, [
            'user_id' => $user_id
        ]);

        return $query->getRowArray();
    }
    
    public function update_password($user_id, $password)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `als_coordinator` SET `password` =:password: WHERE `user_id` = :user_id:";

        $query = $db->query($sql, [
            'user_id' => $user_id,
            'password' => $password
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }
    
    public function update_status($admin_id, $isActive)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `admin` SET `status`= :is_active: WHERE `user_id` = :admin_id:";
        $isUpdated = $query = $db->query($sql, [
            'is_active' => $isActive,
            'admin_id' => $admin_id
        ]);
        return $isUpdated;
    }

    public function select_als_coord_info($als_coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT account.user_id, account.creator_id, account.email, account.username , info.lastname, info.firstname, contact.district, info.image as profile_img FROM `als_coordinator` account INNER JOIN `als_coordinator_info` info USING(user_id) INNER JOIN `als_coordinator_contact` contact USING(user_id) WHERE `user_id` = :als_coord_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id
        ]);

        return $query->getRowArray();
    }

    public function select_barangay_info($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `barangay`, `about`, `address`, `contact_no`, `from`, `to`, `email`, `facebook_page`, `official_web`, `logo`, `cover_photo`, `img_1`, `img_2` FROM `barangay` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        
        return $query->getRowArray();
    }

    public function edit_barangay_logo($coordinator_id, $logo_loc)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `barangay` SET `logo`= :logo_loc: WHERE `user_id` =:coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'logo_loc' => $logo_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function edit_barangay_cover_photo($coordinator_id, $cover_photo_loc)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `barangay` SET `cover_photo` = :cover_photo_loc: WHERE `user_id` =:coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'cover_photo_loc' => $cover_photo_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function edit_barangay_info($coordinator_id, $about, $address, $contact_no, $start_time, $end_time, $email, $facebook_page, $official_web)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `barangay` SET `about`=:about:,`address`=:address:,`contact_no`=:contact_no:,`from`=:start_time:,`to`= :end_time:,`email`=:email:,`facebook_page`=:facebook_page:,`official_web`=:official_web: WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'about' => $about,
            'address' => $address,
            'contact_no' => $contact_no,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'email' => $email,
            'facebook_page' => $facebook_page,
            'official_web' => $official_web
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function edit_coord_credential($coordinator_id, $als_coord_id, $username, $password)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `user` SET `username`=:username:, `password`=:password: WHERE  `user_id`=:coordinator_id: AND `creator_id`= :als_coord_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'als_coord_id' => $als_coord_id,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function edit_coord_email($coordinator_id, $email)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `user` SET `email`=:email: WHERE `user_id`=:coordinator_id:";
        $sql2 = "UPDATE `contact` SET `email`=:email: WHERE `user_id`=:coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'email' => $email
        ]);
        $query2 = $db->query($sql2, [
            'coordinator_id' => $coordinator_id,
            'email' => $email
        ]);
        if($query == true && $query2 == true){
            return true;
        }else{
            return false;
        }
    }

    public function select_coord_account($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `creator_id`, `username`, `user_type`, `is_evaluated`,`activation_code`, `email` FROM `user` WHERE `user_id` =:coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getRowArray();
    }

    public function select_all_staff($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT  u.user_id, u.creator_id, u.username, u.user_type, u.email, CONCAT(i.firstname, ' ' , i.middlename, ' ' , i.lastname ) AS fullname FROM `user` AS u INNER JOIN info AS i USING(user_id) WHERE u.creator_id = :coordinator_id: AND u.user_type = 'Staff'";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function select_all_teacher($als_coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = " SELECT t.user_id, t.creator_id, t.email, CONCAT(ti.firstname, ' ', ti.middlename, ' ', ti.lastname) AS fullname FROM `teacher` AS t INNER JOIN `teacher_info` AS ti USING(user_id) WHERE t.creator_id = :als_coordinator_id:";
        $query = $db->query($sql, [
            'als_coordinator_id' => $als_coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function select_all_facility($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `facility_id`, `address`, `name`, `description`, `type`, `image` FROM `facility` WHERE `coordinator_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function registered_brgy_coord($district)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, u.email, i.lastname, i.firstname, c.district, cre.brgy_id_loc FROM user u INNER JOIN  contact c USING(user_id) INNER JOIN info i USING(user_id) INNER JOIN credential cre USING(user_id) WHERE district = :district: AND u.is_evaluated=0 AND u.user_type = 'Coordinator';";
        $query = $db->query($sql, [
            'district' => $district
        ]);

        return $query->getResultArray();
    }

    public function select_pending_coord($district)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, u.email, i.lastname, i.firstname, c.district, cre.brgy_id_loc FROM user u INNER JOIN  contact c USING(user_id) INNER JOIN info i USING(user_id) INNER JOIN credential cre USING(user_id) WHERE district = :district: AND u.is_evaluated=1 AND u.resubmit = 1 AND u.user_type = 'Coordinator';";
        $query = $db->query($sql, [
            'district' => $district
        ]);

        return $query->getResultArray();
    }

    public function select_approved_coord($district)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, u.email, i.lastname, i.firstname, c.district, cre.brgy_id_loc FROM user u INNER JOIN  contact c USING(user_id) INNER JOIN info i USING(user_id) INNER JOIN credential cre USING(user_id) WHERE district = :district: AND u.is_evaluated=1 AND u.resubmit = 0 AND u.user_type = 'Coordinator';";
        $query = $db->query($sql, [
            'district' => $district
        ]);

        return $query->getResultArray();
    }

    public function update_brgy_coordinator_acc($als_coord_id, $coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `user` SET `creator_id`= :als_coord_id:, `is_evaluated`= 1, `resubmit` = 1 WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id,
            'coordinator_id' => $coordinator_id
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function update_brgy_coordinator_resubmit($als_coord_id, $coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `user` SET `creator_id`= :als_coord_id:, `is_evaluated`= 1, `resubmit` = 0 WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id,
            'coordinator_id' => $coordinator_id
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function view_registration($user_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, u.activation_code, u.email, i.lastname, i.firstname, c.district, c.barangay, cre.brgy_id_loc FROM user u INNER JOIN  contact c USING(user_id) INNER JOIN info i USING(user_id) INNER JOIN credential cre USING(user_id) WHERE user_id = :user_id:";
        $query = $db->query($sql, [
            'user_id' => $user_id
        ]);

        return $query->getRowArray();
    }

    public function select_created_brgy($als_coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id AS user_id, b.barangay AS barangay, c.district AS district, CONCAT(i.lastname, ' ', i.firstname, ' ', i.middlename, ' ', i.suffix) AS fullname, i.image AS profile_img, b.cover_photo AS cover_photo FROM barangay b INNER JOIN user u USING(user_id) INNER JOIN contact c USING(user_id) INNER JOIN info i USING(user_id) WHERE u.is_evaluated = 1 AND u.isActivated = 1 AND u.creator_id = :als_coord_id:;";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id
        ]);
        return $query->getResultArray();
    }
    
    public function count_brgy($als_coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT COUNT(*) as brgy FROM `user` u INNER JOIN `barangay` b USING(user_id) INNER JOIN `info` i USING(user_id) WHERE u.creator_id =:als_coord_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id
        ]);
        return $query->getRowArray();
    }

    public function count_reg($als_coord_dist)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT COUNT(*) as reg_entry FROM `user` u INNER JOIN `contact` c USING(user_id)  WHERE u.user_type = 'Coordinator' AND c.district = :als_coord_district: AND u.creator_id = '' OR NULL;";
        $query = $db->query($sql, [
            'als_coord_district' => $als_coord_dist
        ]);
        return $query->getRowArray();
    }

    public function select_brgy_coord($admin_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `username`, `user_type`, `status` FROM `user` WHERE `creator_id` = :admin_id:";
        $query = $db->query($sql, [
            'admin_id' => $admin_id
        ]);

        return $query->getResultArray();
    }

    public function add_brgy_coord($admin_id, $user_id, $district, $barangay, $lastname, $firstname, $middlename, $extension, $username, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "CALL insert_coord(:admin_id:, :coordinator_id:, :district:, :barangay:, :lastname:, :firstname:, :middlename:, :extension:, :username:, :password:)";
        $query = $db->query($sql, [
            'admin_id' => $admin_id,
            'coordinator_id' => $user_id,
            'district' => $district,
            'barangay' => $barangay,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'extension' => $extension,
            'username' => $username,
            'password' => $password,
        ]);
    }

    public function select_staff($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT user_id, CONCAT(firstname, ' ', middlename , ' ', lastname) AS fullname, image, status, creator_id FROM user INNER JOIN info USING (user_id)WHERE creator_id = :coordinator_id:";
        $query = $db->query($sql, [ 
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function select_staff_info($staff_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `lastname`, `firstname`, `middlename`, `suffix`, `birth`, `age`, `gender`, `civil_status`, `religion`, `image` FROM `info` WHERE `user_id`=:staff_id:";
        $query = $db->query($sql, [ 
            'staff_id' => $staff_id
        ]);
        return $query->getRowArray();
    }

    public function select_staff_contact($staff_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `contact` WHERE `user_id` =:staff_id:";
        $query = $db->query($sql, [ 
            'staff_id' => $staff_id
        ]);
        return $query->getRowArray();
    }

    public function select_oscya($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT oi.id, oi.oscya_id, CONCAT(oi.lastname, ', ' , oi.firstname, ' ',oi.middlename, ' ', oi.extension) AS fullname, oi.birthdate, oi.age, oi.gender, oc.brgy FROM oscya_info oi INNER JOIN oscya_contact oc USING(`oscya_id`) INNER JOIN barangay b WHERE b.user_id = :coordinator_id: AND oc.brgy = b.barangay;";
        $query = $db->query($sql, [ 
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function select_all_oscya($barangay)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT oc.oscya_id, oc.brgy, CONCAT(oi.firstname, ' ', oi.lastname) AS name, om.mapping_date, oc.contact FROM `oscya_contact` oc INNER JOIN `oscya_info` oi USING(oscya_id) INNER JOIN `oscya_mapping` om USING(oscya_id) WHERE oc.brgy = :barangay:;";
        $query = $db->query($sql, [
            'barangay' => $barangay
        ]);
        return $query->getResultArray();
    }

    public function count_oscya($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT COUNT(oi.oscya_id) AS `total` FROM oscya_info oi INNER JOIN oscya_contact oc USING(`oscya_id`) INNER JOIN barangay b WHERE b.user_id = :coordinator_id: AND oc.brgy = b.barangay";
        $query = $db->query($sql, [ 
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getRowArray();
    }

    public function select_brgy($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql ="SELECT `id`,  `barangay`, `address`, `contact_no`, `email`, `logo` FROM `barangay` WHERE `user_id` =:coordinator_id:";
        $query = $db->query($sql, [ 
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getRowArray();
    }
    
    public function select_teacher_registration($district)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT tch.user_id, tch.username, tch.activation_code, tch_contact.district FROM `teacher` tch INNER JOIN `teacher_contact` tch_contact USING(user_id) WHERE tch.is_evaluated = 0 AND tch.isActivated = 0 AND tch.isActivated = 0 AND tch_contact.district = :district:";
        $query = $db->query($sql, [ 
            'district' => $district
        ]);
        return $query->getResultArray();
    }

    public function select_pending_teacher_registration($district)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT tch.user_id, tch.username, tch.activation_code, tch_contact.district FROM `teacher` tch INNER JOIN `teacher_contact` tch_contact USING(user_id) WHERE tch.is_evaluated = 1 AND tch.resubmit = 1 AND tch.isActivated = 0 AND tch_contact.district = :district:";
        $query = $db->query($sql, [ 
            'district' => $district
        ]);
        return $query->getResultArray();
    }

    public function select_approved_teacher_registration($district)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT tch.user_id, tch.username, tch.activation_code, tch_contact.district FROM `teacher` tch INNER JOIN `teacher_contact` tch_contact USING(user_id) WHERE tch.is_evaluated = 1 AND tch.resubmit = 0 AND tch.isActivated = 0 AND tch_contact.district = :district:;";
        $query = $db->query($sql, [ 
            'district' => $district
        ]);
        return $query->getResultArray();
    }
    
    public function view_teacher_registration($tch_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT tch.user_id, tch.username, tch.activation_code, tch_contact.district, tch.email, CONCAT(tch_info.firstname, ' ' , tch_info.lastname ) AS `fullname`, tch_cre.id_loc FROM `teacher` tch INNER JOIN `teacher_contact` tch_contact USING(user_id) INNER JOIN `teacher_info` tch_info USING(user_id) INNER JOIN `teacher_credential` tch_cre WHERE tch.user_id = :tch_id:";
        $query = $db->query($sql, [ 
            'tch_id' => $tch_id
        ]);
        return $query->getRowArray();
    }

    public function resubmit_id($als_coord_id, $teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher` SET `creator_id`=:als_coord_id:, `is_evaluated`= 1,  `resubmit` = 1 WHERE `user_id`=:teacher_id:";
        $query = $db->query($sql, [ 
            'als_coord_id' => $als_coord_id,
            'teacher_id' => $teacher_id
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function update_teacher_resubmit_status($als_coord_id, $teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher` SET `creator_id`=:als_coord_id:, `is_evaluated`= 1,  `resubmit` = 0 WHERE `user_id`=:teacher_id:";
        $query = $db->query($sql, [ 
            'als_coord_id' => $als_coord_id,
            'teacher_id' => $teacher_id
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function view_staff_records($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.id, oi.oscya_id, om.user_id, CONCAT(oi.firstname, ' ', oi.lastname) AS fullname, oc.contact, oc.email, om.mapping_date FROM `oscya_info` oi INNER JOIN `oscya_contact` oc USING(oscya_id) INNER JOIN `oscya_mapping` om USING(oscya_id) WHERE om.user_id = :staff_id:;";
        $query = $db->query($sql, [ 
            'staff_id' => $staff_id
        ]);
        
        return $query->getResultArray();
    }

    /**
     * Counting Staff Records By category
     * 
     * */

    public function count_staff_inserted($staff_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT COUNT(oi.oscya_id) AS total FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE om.user_id = :staff_id:;";
        $query = $db->query($sql, ['staff_id' => $staff_id]);
        return $query->getRowArray();
    } 

    public function count_civil_status($staff_id)
    {
        $db = \Config\Database::connect();

        $count_single = "SELECT COUNT(oi.civil_status) AS single FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) WHERE oi.civil_status = 'Single' AND  om.user_id = :staff_id:";
        $count_married = "SELECT COUNT(oi.civil_status) AS married FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) WHERE oi.civil_status = 'Married' AND  om.user_id = :staff_id:";
        $count_separated = "SELECT COUNT(oi.civil_status) AS separated FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) WHERE oi.civil_status = 'Separated' AND  om.user_id = :staff_id:";
        $count_devorced = "SELECT COUNT(oi.civil_status) AS devorced FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) WHERE oi.civil_status = 'Devorced' AND  om.user_id = :staff_id:";
        $count_widowed = "SELECT COUNT(oi.civil_status) AS widowed FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) WHERE oi.civil_status = 'Widowed' AND  om.user_id = :staff_id:";

        $single = $db->query($count_single, ['staff_id' => $staff_id]);
        $married = $db->query($count_married, ['staff_id' => $staff_id]);
        $separated = $db->query($count_separated, ['staff_id' => $staff_id]);
        $divorced = $db->query($count_devorced, ['staff_id' => $staff_id]);
        $widowed = $db->query($count_widowed, ['staff_id' => $staff_id]);

        $s = $single->getRowArray();
        $m = $married->getRowArray();
        $sp = $separated->getRowArray();
        $d = $divorced->getRowArray();
        $w = $widowed->getRowArray();

        return array(
            'single' => $s['single'],
            'married' => $m['married'],
            'separated' => $sp['separated'],
            'devorced' => $d['devorced'],
            'widowed' =>$w['widowed']
        );
    }

    public function count_gender($staff_id)
    {
        $db = \Config\Database::connect();

        $male = "SELECT COUNT(oi.gender) AS male FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) WHERE oi.gender = 'Male' AND  om.user_id = :staff_id:";
        $female = "SELECT COUNT(oi.gender) AS female FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) WHERE oi.gender = 'Female' AND  om.user_id = :staff_id:";

        $is_male = $db->query($male, ['staff_id' => $staff_id]);
        $is_female = $db->query($female, ['staff_id' => $staff_id]);
        
        $m = $is_male->getRowArray();
        $f = $is_female->getRowArray();

        return array(
            'male' => $m['male'],
            'female' => $f['female']
        );

    }

    public function count_ages($staff_id)
    {
        $db = \Config\Database::connect();

        $adolescent = "SELECT COUNT(oi.age) AS Age FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE oi.age BETWEEN 12 AND 20 AND om.user_id = :staff_id:;";
        $adolescenceCount = $db->query($adolescent, ['staff_id' => $staff_id]);

        $earlyAdulthood = "SELECT COUNT(oi.age) AS Age FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE oi.age BETWEEN 21 AND 35 AND om.user_id = :staff_id:;";
        $earlyAdulthoodCount = $db->query($earlyAdulthood, ['staff_id' => $staff_id]);

        $middleAdulthood = "SELECT COUNT(oi.age) AS Age FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE oi.age BETWEEN 36 AND 50 AND om.user_id = :staff_id:;";
        $middleAdulthoodCount = $db->query($middleAdulthood, ['staff_id' => $staff_id]);

        $matureAdulthood = "SELECT COUNT(oi.age) AS Age FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE oi.age BETWEEN 51 AND 80 AND om.user_id = :staff_id:;";
        $matureAdulthoodCount = $db->query($matureAdulthood, ['staff_id' => $staff_id]);

        $adolescence = $adolescenceCount->getRowArray();
        $earlyAdults = $earlyAdulthoodCount->getRowArray();
        $middleAdults = $middleAdulthoodCount->getRowArray();
        $matureAdults = $matureAdulthoodCount->getRowArray();

        return [
            'adolescence' => $adolescence['Age'],
            'earlyAdults' => $earlyAdults['Age'],
            'middleAdults' => $middleAdults['Age'],
            'matureAdults' => $matureAdults['Age']
        ];

    }

    public function count_educ_attainment($staff_id)
    {
        $db = \Config\Database::connect();
        $count_kinder = "SELECT COUNT(`educ_attainment`) as kinder FROM `oscya_mapping` WHERE `educ_attainment` = 'kinder' AND user_id = :staff_id:";
        $count_g1 = "SELECT COUNT(`educ_attainment`) as g1 FROM `oscya_mapping` WHERE `educ_attainment` = 1 AND user_id = :staff_id:";
        $count_g2 = "SELECT COUNT(`educ_attainment`) as g2 FROM `oscya_mapping` WHERE `educ_attainment` = 2 AND user_id = :staff_id:";
        $count_g3 = "SELECT COUNT(`educ_attainment`) as g3 FROM `oscya_mapping` WHERE `educ_attainment` = 3 AND user_id = :staff_id:";
        $count_g4 = "SELECT COUNT(`educ_attainment`) as g4 FROM `oscya_mapping` WHERE `educ_attainment` = 4 AND user_id = :staff_id:";
        $count_g5 = "SELECT COUNT(`educ_attainment`) as g5 FROM `oscya_mapping` WHERE `educ_attainment` = 5 AND user_id = :staff_id:";
        $count_g6 = "SELECT COUNT(`educ_attainment`) as g6 FROM `oscya_mapping` WHERE `educ_attainment` = 6 AND user_id = :staff_id:";
        $count_g7 = "SELECT COUNT(`educ_attainment`) as g7 FROM `oscya_mapping` WHERE `educ_attainment` = 7 AND user_id = :staff_id:";
        $count_g8 = "SELECT COUNT(`educ_attainment`) as g8 FROM `oscya_mapping` WHERE `educ_attainment` = 8 AND user_id = :staff_id:";
        $count_g9 = "SELECT COUNT(`educ_attainment`) as g9 FROM `oscya_mapping` WHERE `educ_attainment` = 9 AND user_id = :staff_id:";
        $count_g10 = "SELECT COUNT(`educ_attainment`) as g10 FROM `oscya_mapping` WHERE `educ_attainment` = 10 AND user_id = :staff_id:";
        
        $kinder = $db->query($count_kinder, [ 'staff_id' => $staff_id ]);
        $grade1 = $db->query($count_g1, [ 'staff_id' => $staff_id ]);
        $grade2 = $db->query($count_g2, [ 'staff_id' => $staff_id ]);
        $grade3 = $db->query($count_g3, [ 'staff_id' => $staff_id ]);
        $grade4 = $db->query($count_g4, [ 'staff_id' => $staff_id ]);
        $grade5 = $db->query($count_g5, [ 'staff_id' => $staff_id ]);
        $grade6 = $db->query($count_g6, [ 'staff_id' => $staff_id ]);
        $grade7 = $db->query($count_g7, [ 'staff_id' => $staff_id ]);
        $grade8 = $db->query($count_g8, [ 'staff_id' => $staff_id ]);
        $grade9 = $db->query($count_g9, [ 'staff_id' => $staff_id ]);
        $grade10 = $db->query($count_g10, [ 'staff_id' => $staff_id ]);

        $k = $kinder->getRowArray();
        $_1 = $grade1->getRowArray();
        $_2 = $grade2->getRowArray();
        $_3 = $grade3->getRowArray();
        $_4 = $grade4->getRowArray();
        $_5 = $grade5->getRowArray();
        $_6 = $grade6->getRowArray();
        $_7 = $grade7->getRowArray();
        $_8 = $grade8->getRowArray();
        $_9 = $grade9->getRowArray();
        $_10 = $grade10->getRowArray();

        return array(
            'kinder' => $k['kinder'],
            'g1' => $_1['g1'],
            'g2' => $_2['g2'],
            'g3' => $_3['g3'],
            'g4' => $_4['g4'],
            'g5' => $_5['g5'],
            'g6' => $_6['g6'],
            'g7' => $_7['g7'],
            'g8' => $_8['g8'],
            'g9' => $_9['g9'],
            'g10' => $_10['g10'],
        );

    }

    public function count_reason($staff_id)
    {

        $db = \Config\Database::connect(); 

        $lackOfPersonalInterest = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Lack of Personal Interest' AND `user_id` = :staff_id:";
        $familyRelatedConcerns = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Family Related Concerns' AND `user_id` = :staff_id:";
        $employment = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Employment' AND `user_id` = :staff_id:";
        $earlyPregnancy = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Early Pregnancy' AND `user_id` = :staff_id:";
        $disability = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Disability' AND `user_id` = :staff_id:";
        $disease = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Disease' AND `user_id` = :staff_id:";
        $distanceOfTheSchool = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Distance of the School' AND `user_id` = :staff_id:";
        $cannotCopeWithSchoolWorks = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Cannot Cope with School Works' AND `user_id` = :staff_id:";
        $financialProblems = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Financial Problems' AND `user_id` = :staff_id:";
        $others = "SELECT COUNT(reason) as reason FROM `oscya_mapping` WHERE reason = 'Others' AND `user_id` = :staff_id:";

        $q1 = $db->query($lackOfPersonalInterest, [ 'staff_id' => $staff_id ]);
        $q2 = $db->query($familyRelatedConcerns, [ 'staff_id' => $staff_id ]);
        $q3 = $db->query($employment, [ 'staff_id' => $staff_id ]);
        $q4 = $db->query($earlyPregnancy, [ 'staff_id' => $staff_id ]);
        $q5 = $db->query($disability, [ 'staff_id' => $staff_id ]);
        $q6 = $db->query($disease, [ 'staff_id' => $staff_id ]);
        $q7 = $db->query($distanceOfTheSchool, [ 'staff_id' => $staff_id ]);
        $q8 = $db->query($cannotCopeWithSchoolWorks, [ 'staff_id' => $staff_id ]);
        $q9 = $db->query($financialProblems, [ 'staff_id' => $staff_id ]);
        $q10 = $db->query($others, [ 'staff_id' => $staff_id ]);

        $r1 = $q1->getRowArray();
        $r2 = $q2->getRowArray();
        $r3 = $q3->getRowArray();
        $r4 = $q4->getRowArray();
        $r5 = $q5->getRowArray();
        $r6 = $q6->getRowArray();
        $r7 = $q7->getRowArray();
        $r8 = $q8->getRowArray();
        $r9 = $q9->getRowArray();
        $r10 = $q10->getRowArray();

        return array(
            'r1' => $r1['reason'],
            'r2' => $r2['reason'],
            'r3' => $r3['reason'],
            'r4' => $r4['reason'],
            'r5' => $r5['reason'],
            'r6' => $r6['reason'],
            'r7' => $r7['reason'],
            'r8' => $r8['reason'],
            'r9' => $r9['reason'],
            'r10' => $r10['reason'],
        );
        

    }

    public function count_disability($staff_id)
    {

        $db = \Config\Database::connect(); 

        $intellectualDisability = "SELECT COUNT(disability) AS da FROM `oscya_mapping` WHERE disability = 'Intellectual Disability' AND `user_id`=:staff_id:"; 
        $learningDisablity = "SELECT COUNT(disability) AS da FROM `oscya_mapping` WHERE disability = 'Learning Disability'  AND `user_id`=:staff_id:"; 
        $autism = "SELECT COUNT(disability) AS da FROM `oscya_mapping` WHERE disability = 'Autism' AND `user_id`=:staff_id:"; 
        $blind = "SELECT COUNT(disability) AS da FROM `oscya_mapping` WHERE disability = 'Blind' AND `user_id`=:staff_id:";
        $deaf = "SELECT COUNT(disability) AS da FROM `oscya_mapping` WHERE disability = 'Deaf' AND `user_id`=:staff_id:";
        $hardOfHearin = "SELECT COUNT(disability) AS da FROM `oscya_mapping` WHERE disability = 'Hard of Hearin' AND `user_id`=:staff_id:";
        $orthopedicallyImpaired = "SELECT COUNT(disability) AS da FROM `oscya_mapping` WHERE disability = 'Orthopedically Impaired' AND `user_id`=:staff_id:";
        $others = "SELECT COUNT(disability) AS da FROM `oscya_mapping` WHERE disability = 'Others' AND `user_id`=:staff_id:";

        $d1 =  $db->query($intellectualDisability, [ 'staff_id' => $staff_id ]);
        $d2 =  $db->query($learningDisablity, [ 'staff_id' => $staff_id ]);
        $d3 =  $db->query($autism, [ 'staff_id' => $staff_id ]);
        $d4 =  $db->query($blind, [ 'staff_id' => $staff_id ]);
        $d5 =  $db->query($deaf, [ 'staff_id' => $staff_id ]);
        $d6 =  $db->query($hardOfHearin, [ 'staff_id' => $staff_id ]);
        $d7 =  $db->query($orthopedicallyImpaired, [ 'staff_id' => $staff_id ]);
        $d8 =  $db->query($others, [ 'staff_id' => $staff_id ]);

        $da1 = $d1->getRowArray();
        $da2 = $d2->getRowArray();
        $da3 = $d3->getRowArray();
        $da4 = $d4->getRowArray();
        $da5 = $d5->getRowArray();
        $da6 = $d6->getRowArray();
        $da7 = $d7->getRowArray();
        $da8 = $d8->getRowArray();

        return array(
            'd1' => $da1['da'],
            'd2' => $da2['da'],
            'd3' => $da3['da'],
            'd4' => $da4['da'],
            'd5' => $da5['da'],
            'd6' => $da6['da'],
            'd7' => $da7['da'],
            'd8' => $da8['da']
        );
    }

    public function is_status($staff_id)
    {
        $db = \Config\Database::connect();
        $is_pwd = "SELECT COUNT(`is_pwd`) AS pwd FROM `oscya_mapping` WHERE is_pwd = 1 AND `user_id` =:staff_id:";
        $has_pwd_id = "SELECT COUNT(`has_pwd_id`) AS pwd_id FROM `oscya_mapping` WHERE `has_pwd_id` = 1 AND `user_id` =:staff_id:";
        $is_employed = "SELECT COUNT(is_employed) AS employed FROM `oscya_mapping` WHERE `is_employed` = 1 AND `user_id` = :staff_id:;";
        $is_fps_member = "SELECT COUNT(is_fps_member) AS fpsMember FROM `oscya_mapping` WHERE `is_fps_member` = 1 AND `user_id` = :staff_id:;";
        $is_interested = "SELECT COUNT(is_interested) AS interested FROM `oscya_mapping` WHERE `is_interested` = 1 AND `user_id` = :staff_id:;";
        
        $pwd =  $db->query($is_pwd, [ 'staff_id' => $staff_id ]);
        $pwdid = $db->query($has_pwd_id, [ 'staff_id' => $staff_id ]);
        $employment =  $db->query($is_employed, [ 'staff_id' => $staff_id ]);
        $fps_membership =  $db->query($is_fps_member, [ 'staff_id' => $staff_id ]);
        $deped_programs_interest =  $db->query($is_interested, [ 'staff_id' => $staff_id ]);

        $personWDisability = $pwd->getRowArray();
        $PWDID = $pwdid->getRowArray();
        $employee = $employment->getRowArray();
        $fps = $fps_membership->getRowArray();
        $interested = $deped_programs_interest->getRowArray();

        return array(
            'is_pwd' => $personWDisability['pwd'],
            'has_pwd_id' => $PWDID['pwd_id'],
            'is_employed' => $employee['employed'],
            'is_fps_member' => $fps['fpsMember'],
            'is_interested' => $interested['interested']
        );

    }

    public function select_teacher($als_coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `user_id`, `username`, `email`, `is_email_activated`, CONCAT(tch_info.firstname, ' ' ,tch_info.middlename, ' ', tch_info.lastname) AS fullname, image FROM `teacher` tch INNER JOIN teacher_info tch_info USING(`user_id`) WHERE creator_id = :als_coord_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id
        ]);
        return $query->getResultArray();
    }

    public function insert_teacher_task($als_coord_id, $teacher_id, $staff_id, $sched_date, $start_time, $end_time)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `teacher_task`(`als_coord_id`, `user_id`, `staff_id`, `sched_date`, `start_time`, `end_time`) VALUES (:als_coord_id:, :teacher_id:, :staff_id:,:sched_date:,:start_time:, :end_time:)";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id,
            'teacher_id' => $teacher_id,
            'staff_id' => $staff_id,
            'sched_date' => $sched_date, 
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function is_task($staff_id)
    {
        $db = \Config\Database::connect();
        $assigned = false;
        $sql = "SELECT `staff_id` FROM `teacher_task`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->staff_id == $staff_id){
                $assigned = true;
                break;
            }else{
                $assigned = false;
            }
        }
        return $assigned;
    }

    public function my_account($als_coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `creator_id`, `email`, `is_email_activated`, `username`, `password`, `is_evaluated`, `activation_code`, `isActivated`, `status` FROM `als_coordinator` WHERE `user_id` = :als_coord_id:";

        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id
        ]);
        return $query->getRowArray();
    }

    public function my_info($als_coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `lastname`, `firstname`, `middlename`, `suffix`, `birth`, `age`, `gender`, `civil_status`, `religion`, `image` FROM `als_coordinator_info` WHERE `user_id` = :als_coord_id:";

        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id
        ]);
        return $query->getRowArray();
    }

    public function my_contact($als_coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `email`, `facebook`, `contact_no`, `street`, `barangay`, `district`, `zip_code`, `city` FROM `als_coordinator_contact` WHERE `user_id` = :als_coord_id:";

        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id
        ]);
        return $query->getRowArray();
    }

    public function edit_profile_pic($als_coord_id, $image_loc)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `als_coordinator_info` SET `image` = :image_loc: WHERE `user_id` = :als_coord_id:";

        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id,
            'image_loc' => $image_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function checkpassword($username, $old_password)
    {
       
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT * FROM `als_coordinator`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->username == $username && password_verify($old_password, $row->password)){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    public function edit_password($als_coord_id, $username, $new_password)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `als_coordinator` SET `username` = :username:, `password`=:password: WHERE `user_id`=:als_coord_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id,
            'username' => $username,
            'password' => password_hash($new_password, PASSWORD_BCRYPT)
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function edit_contact($als_coord_id, $email, $facebook, $contact_no, $street, $barangay, $district, $zip_code, $city)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `als_coordinator_contact` SET `email` = :email:, `facebook` = :facebook:, `contact_no` = :contact_no:, `street` = :street:, `barangay` = :barangay:, `district` = :district:, `zip_code` = :zip_code:,`city` = :city: WHERE `user_id`=:als_coord_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id,
            'email' => $email,
            'facebook' => $facebook,
            'contact_no' => $contact_no,
            'street' => $street,
            'barangay' => $barangay,
            'district' =>$district,
            'zip_code' => $zip_code,
            'city' => $city
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function edit_info($als_coord_id, $lastname, $firstname, $middlename, $suffix, $birth, $age, $gender, $civil_status, $religion )
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `als_coordinator_info` SET `lastname`=:lastname:,`firstname`=:firstname:,`middlename`=:middlename:,`suffix`=:suffix:,`birth`=:birth:,`age`=:age:,`gender`=:gender:,`civil_status`=:civil_status:,`religion`=:religion: WHERE `user_id`=:als_coord_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id, 
            'lastname' => $lastname, 
            'firstname' => $firstname, 
            'middlename' => $middlename, 
            'suffix' => $suffix, 
            'birth' => $birth, 
            'age' => $age, 
            'gender' => $gender, 
            'civil_status' => $civil_status, 
            'religion' => $religion 
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function count_all_users($district)
    {
        $db = \Config\Database::connect();

        $count_coord = "SELECT COUNT(*) AS `coordinator_count` FROM `user` INNER JOIN `contact` c USING(user_id) WHERE user_type = 'Coordinator' AND is_evaluated = 1 AND isActivated = 1 AND c.district = :district:;";
        $count_coord_res = $db->query($count_coord, [
            'district' => $district
        ]);
        
        $count_staff = "SELECT COUNT(*) AS `staff_count` FROM `user` INNER JOIN `contact` c USING(user_id) WHERE user_type = 'Staff' AND is_evaluated = 1 AND isActivated = 1 AND c.district = :district:;";
        $count_staff_res = $db->query($count_staff, [
            'district' => $district
        ]);

        $count_teacher = "SELECT COUNT(*) AS `teacher_count` FROM `teacher` INNER JOIN `teacher_contact` c USING(user_id) WHERE is_evaluated = 1 AND isActivated = 1 AND c.district = :district:;";
        $count_teacher_res = $db->query($count_teacher, [
            'district' => $district
        ]);

        $data = [
            'coord_count_res' => $count_coord_res->getRowArray(),
            'coord_staff_res' => $count_staff_res->getRowArray(),
            'coord_teacher_res' => $count_teacher_res->getRowArray()
        ];
        return $data;
    }

    public function select_teacher_tasks($als_coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT tch_task.id, CONCAT(info.firstname, ' ', info.lastname) AS fullname, info.image AS profile, tch_task.user_id, tch_task.staff_id, tch_task.brgy_facility, tch_task.sched_date, tch_task.start_time, tch_task.end_time, tch_task.is_done, c.barangay FROM `teacher_task` tch_task INNER JOIN `info` info ON tch_task.staff_id = info.user_id INNER JOIN `contact` c ON tch_task.staff_id = c.user_id WHERE tch_task.als_coord_id = :als_coord_id:";
        $query = $db->query($sql, [
            'als_coord_id' => $als_coord_id
        ]);
        return $query->getResultArray();
    }
    /**
     * End of staff counting records
     */

    
}