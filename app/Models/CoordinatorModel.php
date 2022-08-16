<?php

namespace App\Models;

use CodeIgniter\Model;


class CoordinatorModel extends Model
{

    public function check_facility($f_id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT * FROM `facility` WHERE `facility_id` = :f_id:";
        $query = $db->query($sql, [
            'f_id' => $f_id
        ]);
        return $query->getRowArray();
    }

    public function check_teacher($teacher_id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT * FROM `teacher_info` WHERE `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function check_current_password($username, $password)
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
        if(!empty($data)){
            return true;
        }else{
            return false;
        }

    }

    public function update_current_password($coordinator_id, $username, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE `user` SET `username`=:username:, `password`=:password: WHERE `user_id`=:coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'username' => $username,
            'password' => $password
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function check_activation_code($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `activation_code` FROM `user` WHERE `user_id` = :user_id:";

        $query = $db->query($sql, [
            'user_id' => $coordinator_id
        ]);
        if(!empty($query->getRowArray())){
            return $query->getRowArray();
        }else{
            return array();
        }

    }

    public function update_activation_status($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `user` SET `isActivated` = 1 WHERE `user_id` = :user_id:";

        $query = $db->query($sql, [
            'user_id' => $coordinator_id
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function select_notification($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `notif_content`, `notif_type`, `date_created` FROM `notification` WHERE `brgy` = :coordinator_id: ORDER BY `date_created`";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function select_staff($coordinator_id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT u.user_id, i.image as image, CONCAT(i.firstname, ' ', i.lastname) as name, u.id as id, u.user_id as user_id, u.creator_id as creator_id, u.username as username, u.status as status, c.brgy_id_loc FROM `user` u INNER JOIN info i USING(`user_id`) INNER JOIN `credential` c USING(`user_id`)  WHERE u.user_type = 'Staff' AND creator_id = :creator_id:;";
        $query = $db->query($sql, ['creator_id' => $coordinator_id]);

        return $query->getResultArray();
    }

    public function search_account($coordinator_id, $staff_id)
    {
        $db =\Config\Database::connect();

        $sql = "SELECT `id`, `user_id`, `username`, `status` FROM `user` WHERE `user_id` LIKE :staff_id: AND creator_id = :creator_id:";

        $query = $db->query($sql, ['staff_id' => $staff_id . '%', 'creator_id' => $coordinator_id]);

        return $query->getResultArray();
    }

    public function view_staff_acc($staff_id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT `id`, `user_id`, `creator_id`, `username`, `password`, `user_type`, `status` FROM `user` WHERE user_id = :staff_id:";
        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRowArray();
    }

    public function select_staff_registration_info($barangay)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, CONCAT(i.firstname, ' ', i.lastname) AS fullname, c.barangay, c.contact_no, cre.brgy_id_loc FROM `user` u INNER JOIN `contact` c USING(user_id) INNER JOIN `info` i USING(user_id) INNER JOIN `credential` cre USING(user_id) WHERE c.barangay = :barangay: AND u.is_evaluated = 0 AND u.isActivated = 0 AND u.user_type = 'Staff'; ";
        $query = $db->query($sql, [
            'barangay' => $barangay
        ]);

        return $query->getResultArray();
    }

    public function select_pending_registration_info($barangay)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, CONCAT(i.firstname, ' ', i.lastname) AS fullname, c.barangay, c.contact_no, cre.brgy_id_loc FROM `user` u INNER JOIN `contact` c USING(user_id) INNER JOIN `info` i USING(user_id) INNER JOIN `credential` cre USING(user_id) WHERE c.barangay = :barangay: AND u.is_evaluated = 1 AND u.resubmit = 1 AND u.user_type = 'Staff'; ";
        $query = $db->query($sql, [
            'barangay' => $barangay
        ]);
        return $query->getResultArray();
    }

    public function select_approved_registration_info($barangay)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, CONCAT(i.firstname, ' ', i.lastname) AS fullname, c.barangay, c.contact_no, cre.brgy_id_loc FROM `user` u INNER JOIN `contact` c USING(user_id) INNER JOIN `info` i USING(user_id) INNER JOIN `credential` cre USING(user_id) WHERE c.barangay = :barangay: AND u.is_evaluated = 1 AND u.resubmit = 0 AND u.user_type = 'Staff'";
        $query = $db->query($sql, [
            'barangay' => $barangay
        ]);
        return $query->getResultArray();
    }

    public function view_staff_registration_info($staff_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, u.activation_code, CONCAT(i.firstname, ' ', i.lastname) AS fullname, c.barangay, c.email, c.contact_no, cre.brgy_id_loc FROM `user` u INNER JOIN `contact` c USING(user_id) INNER JOIN `info` i USING(user_id) INNER JOIN `credential` cre USING(user_id) WHERE u.user_id = :staff_id: AND u.user_type = 'Staff'; ";
        $query = $db->query($sql, [
            'staff_id' => $staff_id
        ]);

        return $query->getRowArray();
    }

    public function view_pending_registration_info($staff_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.user_id, u.username, u.activation_code, CONCAT(i.firstname, ' ', i.lastname) AS fullname, c.barangay, c.email, c.contact_no, cre.brgy_id_loc FROM `user` u INNER JOIN `contact` c USING(user_id) INNER JOIN `info` i USING(user_id) INNER JOIN `credential` cre USING(user_id) WHERE u.user_id = :staff_id: AND u.is_evaluated = 1 AND u.resubmit = 1 AND u.isActivated = 0 AND u.user_type = 'Staff'; ";
        $query = $db->query($sql, [
            'staff_id' => $staff_id
        ]);

        return $query->getRowArray();
    }

    public function update_is_evaluated($user_id, $coordinator_id)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `user` SET `creator_id` =:coordinator_id:, `is_evaluated`=1  WHERE `user_id` = :user_id:";
        $query = $db->query($sql, [
            'user_id' => $user_id,
            'coordinator_id' => $coordinator_id
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function resubmit_id($user_id, $coordinator_id)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `user` SET `creator_id` = :coordinator_id:,`resubmit` = 1, `is_evaluated` = 1 WHERE `user_id` = :user_id:";
        $query = $db->query($sql, [
            'user_id' => $user_id,
            'coordinator_id' => $coordinator_id
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function update_resubmit_id($user_id, $coordinator_id)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `user` SET `creator_id` = :coordinator_id:,`resubmit` = 0, `is_evaluated` = 1 WHERE `user_id` = :user_id:";
        $query = $db->query($sql, [
            'user_id' => $user_id,
            'coordinator_id' => $coordinator_id
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function check_email($email)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT `user_id`, `username` FROM `user` WHERE `email` = :email: AND is_email_activated = 1";

        $query = $db->query($sql, [
            'email' => $email
        ]);

        return $query->getRowArray();
    }

    public function account_detail($user_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT * FROM `user` WHERE `user_id` = :user_id:";

        $query = $db->query($sql, [
            'user_id' => $user_id
        ]);

        return $query->getRowArray();
    }

    public function update_password($user_id, $password)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `user` SET `password` =:password: WHERE `user_id` = :user_id:";

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

    public function check_is_task($staff_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `coord_id`, `user_id`, `staff_id`, `brgy_facility`, `sched_date`, `start_time`, `end_time`, `is_done` FROM `teacher_task` WHERE `staff_id` = :staff_id:";
        $query = $db->query($sql, [
            'staff_id' => $staff_id
        ]);
        if(!empty($query->getResultArray())){
            return true;
        }else{
            return false;
        }
    }

    public function view_staff_info($staff_id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT `user_id`, `lastname`, `firstname`, `middlename`, `suffix`, `birth`, `age`, `gender`, `civil_status`, `religion`, `image` FROM `info` WHERE `user_id` = :staff_id:";
        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRowArray();
    }

    public function view_staff_contact($staff_id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT `user_id`, `email`, `facebook`, `contact_no`, `street`, `barangay`, `district`, `zip_code`, `city` FROM `contact`  WHERE `user_id` = :staff_id:";
        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRowArray();
    }

    public function edit_staff($staff_id, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE `user` SET `password`=:password: WHERE `user_id`= :user_id:";
        $query = $db->query($sql, [
            'password' => $password, 
            'user_id' => $staff_id
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function check_sid($staff_id)
    {

        $db = \Config\Database::connect();
        
        $sql = "SELECT `user_id` FROM `user`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->user_id == $staff_id){
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
        
        $sql = "SELECT `user_id` FROM `user`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->user_id == $activation_code){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    public function insertStaff($user_id, $coordinator_id, $username, $password, $email, $activation_code, $file_loc, $barangay)
    {
        $db = \Config\Database::connect();

        $sql = "CALL insertStaff(:user_id:, :creator_id:, :username:, :password:, :email:, :activation_code:, 'Staff', :file_loc:, :barangay:)";

        $query = $db->query($sql, [
            'user_id' => $user_id,
            'creator_id' => $coordinator_id,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'activation_code' => $activation_code,
            'file_loc' => $file_loc,
            'barangay' => $barangay
        ]);
        if(!$query){
            return false;
        }else{
            return true;
        }
    }

    public function insertAnnouncement($coordinator_id, $content, $audience, $image_loc)
    {
        $db = \Config\Database::connect();

        $sql = "INSERT INTO `announcement`(`creator_id`, `content`, `audience`, `image` ) VALUES (:coordinator_id:, :content:, :audience:, :image_loc:)";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'content' => $content,
            'audience' => $audience,
            'image_loc' => $image_loc
        ]);
        if(!$query){
            return false;
        }else{
            return true;
        }
    }

    public function selectAnnouncements($coordinator_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT `id`, `creator_id`, `date_created`, `audience`, `image`, `content` FROM `announcement` WHERE `creator_id` = :coordinator_id: ORDER BY date_created DESC";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function select_announcement($coordinator_id, $announcement_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT * FROM `announcement` WHERE `creator_id` = :coordinator_id: AND `id` = :announcement_id:";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'announcement_id' => $announcement_id
        ]);
        if(!empty($query->getResultArray())){
            return true;
        }else{
            return false;
        }
    }

    public function edit_announcement_content($coordinator_id, $announcement_id, $content, $audience)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `announcement` SET `content` = :content:, `audience` = :audience: WHERE `creator_id` = :coordinator_id: AND `id` = :announcement_id:";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'announcement_id' => $announcement_id,
            'content' => $content,
            'audience' => $audience
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_announcement_image($coordinator_id, $announcement_id, $image)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `announcement` SET `image` = :image: WHERE `creator_id` = :coordinator_id: AND `id` = :announcement_id:";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'announcement_id' => $announcement_id,
            'image' => $image
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function count_active_user($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = 'SELECT COUNT(`status`) AS `active` FROM `user` WHERE `status` = 1 AND `creator_id` = :coordinator_id:';
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getRowArray();
    }

    public function count_inactive_user($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = 'SELECT COUNT(`status`) AS `inactive` FROM `user` WHERE `status` = 0 AND `creator_id` = :coordinator_id:';
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getRowArray();
    }

    public function count_user($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = 'SELECT COUNT(`user_id`) as `users` FROM `user` WHERE `creator_id` = :coordinator_id:';
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getRowArray();
    }

    public function select_user($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.id , u.user_id, CONCAT(i.lastname, ', ', i.firstname, ' ', i.middlename, ' ', i.suffix ) AS fullname, i.image AS profile FROM `user`AS u INNER JOIN `info` AS i ON u.user_id = i.user_id WHERE u.creator_id = :coordinator_id: LIMIT 5;";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getResultArray();
    }

    public function get_brgy($coordinator_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT `barangay`, district FROM `contact` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getRow();
    }

    public function select_teacher($district)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT t_info.image, t_info.user_id, CONCAT(t_info.firstname, ' ',t_info.lastname) AS fullname, t_con.district FROM `teacher_info` t_info INNER JOIN `teacher_contact` t_con USING(user_id) WHERE t_con.district = :district:";
        $query = $db->query($sql, [
            'district' => $district
        ]);
        return $query->getResultArray();
    }

    public function select_teacher_info($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `lastname`, `firstname`, `middlename`, `ext`, `birthdate`, `age`, `gender`, `image` FROM `teacher_info` WHERE `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function select_teacher_contact($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `contact_no`, `email`, `facebook`, `street`, `barangay`, `district`, `city`, `zipcode` FROM `teacher_contact` WHERE `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function select_teacher_credential($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `id_loc` FROM `teacher_credential` WHERE `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function count_oscya($brgy )
    {

        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(`oscya_id`) AS population FROM `oscya_contact` WHERE `brgy` = :brgy:";
        $query = $db->query($sql, [
            'brgy' => $brgy
        ]);

        return $query->getRow();
    }

    public function account($coordinator_id)
    {

        $db = \Config\Database::connect();

        $sql = "SELECT `user_id`, `creator_id`, `username`, `password`, `user_type`, `status` FROM `user` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getRowArray();
        
    }

    public function info($coordinator_id)
    {

        $db = \Config\Database::connect();

        $sql = "SELECT `user_id`,`lastname`, `firstname`, `middlename`, `suffix`, `birth`, `age`, `gender`, `civil_status`, `religion`, `image` FROM `info` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getRowArray();
        
    }

    public function contact($coordinator_id)
    {

        $db = \Config\Database::connect();

        $sql = "SELECT `user_id`, `email`, `facebook`, `contact_no`, `street`, `barangay`, `district`, `zip_code`, `city` FROM `contact` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getRowArray();
        
    }

    public function edit_account($coordinator_id, $username, $password)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `user` SET `username`=:username:,`password`=:password: WHERE `user_id` = :coordinator_id:;";

        $query = $db->query($sql, [
            'username' => $username,
            'password' => $password,
            'coordinator_id' => $coordinator_id
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_contact($coordinator_id, $email, $contact_no, $facebook, $street, $barangay, $district, $zip_code,  $city)
    {
        $db = \Config\Database::connect();
        $sql = " UPDATE `contact` SET `email`=:email:,`facebook`=:facebook:,`contact_no`=:contact_no:,`street`=:street:,`barangay`=:barangay:,`district`=:district:,`zip_code`=:zip_code:,`city`=:city: WHERE `user_id`=:coordinator_id:";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'email' => $email,
            'facebook'=> $facebook,
            'contact_no' => $contact_no,
            'street' => $street,
            'barangay' => $barangay,
            'district' => $district,
            'zip_code' => $zip_code,
            'city' => $city
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }
    
    public function edit_info($coordinator_id, $lastname, $firstname, $middlename, $suffix, $birth, $age, $gender, $civil_status, $religion)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `info` SET `lastname`=:lastname:,`firstname`=:firstname:,`middlename`=:middlename:,`suffix`=:suffix:,`birth`=:birth:,`age`=:age:,`gender`=:gender:,`civil_status`=:civil_status:,`religion`=:religion: WHERE `user_id`=:coordinator_id:";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'lastname' => $lastname,
            'firstname'=> $firstname,
            'middlename' => $middlename,
            'suffix' => $suffix,
            'birth' => $birth,
            'age' => $age,
            'gender' => $gender,
            'civil_status' => $civil_status,
            'religion' => $religion
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_profile_pic($coordinator_id, $image)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `info` SET `image`= :image: WHERE `user_id`= :coordinator_id:";
         $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'image' => $image
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function select_brgy_profile($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `barangay`, `about`, `address`, `contact_no`, `from`, `to`,  `email`, `facebook_page`, `official_web`, `logo`, `cover_photo`, `img_1`, `img_2` FROM `barangay` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        
        return $query->getRowArray();

    }

    public function update_brgy_profile($coordinator_id, $barangay, $about, $address, $contact_no, $from, $to, $email, $facebook_page, $official_web)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `barangay` SET `barangay`=:barangay:,`about`=:about:,`address`=:address:,`contact_no`=:contact_no:,`from`=:from:,`to`=:to:,`email`=:email:,`facebook_page`=:facebook_page:,`official_web`=:official_web: WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'barangay' => $barangay, 
            'about' => $about, 
            'address' => $address, 
            'contact_no' => $contact_no, 
            'from' => $from,
            'to' => $to,
            'email' => $email, 
            'facebook_page' => $facebook_page, 
            'official_web' => $official_web
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function update_logo($coordinator_id, $logo_loc)
    {

        $db = \Config\Database::connect();
        $sql = "UPDATE `barangay` SET `logo`=:logo: WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'logo' => $logo_loc
        ]); 
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function update_cover_photo($coordinator_id, $cover_photo_loc)
    {

        $db = \Config\Database::connect();
        $sql = "UPDATE `barangay` SET `cover_photo`=:cover_photo: WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'cover_photo' => $cover_photo_loc
        ]); 
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function reports($barangay)
    {
        $db = \Config\Database::connect();

        $countOscya = "SELECT COUNT(*) AS oscya FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay:";
        $countOscyaQuery = $db->query($countOscya, [
            'barangay' => $barangay
        ]);
        
        $is_employed = "SELECT COUNT(*) AS employed FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.is_employed = 1;";
        $isEmployed = $db->query($is_employed, [
            'barangay' => $barangay
        ]);

        $is_fps_member = "SELECT COUNT(*) AS fpsMember FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.is_fps_member = 1;";
        $isFpsMember = $db->query($is_fps_member, [
            'barangay' => $barangay
        ]);

        $is_interested = "SELECT COUNT(*) AS interested FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.is_interested = 1;";
        $isInterested = $db->query($is_interested, [
            'barangay' => $barangay
        ]);

        $oscya = $countOscyaQuery->getRowArray();
        $employed = $isEmployed->getRowArray();
        $fpsMember = $isFpsMember->getRowArray();
        $interested = $isInterested->getRowArray();

        return [
            'oscya' => $oscya['oscya'],
            'employed' => $employed['employed'],
            'fpsMember' => $fpsMember['fpsMember'],
            'interested' => $interested['interested']
        ];

    }
    
    public function gender($barangay)
    {
        $db = \Config\Database::connect();

        $countFemale = "SELECT COUNT(*) AS female_count FROM oscya_info AS oi INNER JOIN oscya_contact AS oc ON oi.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND oi.gender = 'female';";
        $countFemaleQuery = $db->query($countFemale, [
            'barangay' => $barangay
        ]);

        $countMale = "SELECT COUNT(*) AS male_count FROM oscya_info AS oi INNER JOIN oscya_contact AS oc ON oi.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND oi.gender = 'male';";
        $countMaleQuery = $db->query($countMale, [
            'barangay' => $barangay
        ]);

        $male = $countMaleQuery->getRowArray();
        $female = $countFemaleQuery->getRowArray();

        return  [
            'male' => $male['male_count'],
            'female' => $female['female_count']
        ];
    }

    public function educ_attainment($barangay)
    {
        $db = \Config\Database::connect();

        $kinder = "SELECT COUNT(*) AS kinder FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'Kinder'";
        $e0Query = $db->query($kinder, [
            'barangay' => $barangay
        ]);

        $grade1 = "SELECT COUNT(*) AS g1 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 1'";
        $e1Query = $db->query($grade1, [
            'barangay' => $barangay
        ]);

        $grade2 = "SELECT COUNT(*) AS g2 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 2'";
        $e2Query = $db->query($grade2, [
            'barangay' => $barangay 
        ]);

        $grade3 = "SELECT COUNT(*) AS g3 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 3'";
        $e3Query = $db->query($grade3, [
            'barangay' => $barangay
        ]);

        $grade4 = "SELECT COUNT(*) AS g4 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 4'";
        $e4Query = $db->query($grade4, [
            'barangay' => $barangay
        ]);

        $grade5 = "SELECT COUNT(*) AS g5 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 5'";
        $e5Query = $db->query($grade5, [
            'barangay' => $barangay
        ]);

        $grade6 = "SELECT COUNT(*) AS g6 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 6'";
        $e6Query = $db->query($grade6, [
            'barangay' => $barangay
        ]);

        $grade7 = "SELECT COUNT(*) AS g7 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 7'";
        $e7Query = $db->query($grade7, [
            'barangay' => $barangay
        ]);

        $grade8 = "SELECT COUNT(*) AS g8 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 8'";
        $e8Query = $db->query($grade8, [
            'barangay' => $barangay
        ]);

        $grade9 = "SELECT COUNT(*) AS g9 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 9'";
        $e9Query = $db->query($grade9, [
            'barangay' => $barangay
        ]);

        $grade10 = "SELECT COUNT(*) AS g10 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 10'";
        $e10Query = $db->query($grade10, [
            'barangay' => $barangay
        ]);

        $kinderlevel = $e0Query->getRowArray();
        $g1 = $e1Query->getRowArray();
        $g2 = $e2Query->getRowArray();
        $g3 = $e3Query->getRowArray();
        $g4 = $e4Query->getRowArray();
        $g5 = $e5Query->getRowArray();
        $g6 = $e6Query->getRowArray();
        $g7 = $e7Query->getRowArray();
        $g8 = $e8Query->getRowArray();
        $g9 = $e9Query->getRowArray();
        $g10 = $e10Query->getRowArray();

        return [
            'kinder' => $kinderlevel['kinder'],
            'g1' => $g1['g1'],
            'g2' => $g2['g2'],
            'g3' => $g3['g3'],
            'g4' => $g4['g4'],
            'g5' => $g5['g5'],
            'g6' => $g6['g6'],
            'g7' => $g7['g7'],
            'g8' => $g8['g8'],
            'g9' => $g9['g9'],
            'g10' => $g10['g10']
        ];
    }
    
    public function count_disability($barangay)
    {

        $db = \Config\Database::connect(); 

        $intellectualDisability = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Intellectual Disability' AND oc.brgy = :barangay:"; 
        $learningDisablity = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Learning Disability' AND oc.brgy = :barangay:"; 
        $autism = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Autism' AND oc.brgy = :barangay:"; 
        $blind = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Blind' AND oc.brgy = :barangay:";
        $deaf = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Deaf' AND oc.brgy = :barangay:";
        $hardOfHearin = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Hard of Hearin' AND oc.brgy = :barangay:";
        $orthopedicallyImpaired = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Orthopedically Impaired' AND oc.brgy = :barangay:";
        $others = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Others' AND oc.brgy = :barangay:";

        $d1 =  $db->query($intellectualDisability, [ 'barangay' => $barangay ]);
        $d2 =  $db->query($learningDisablity, [ 'barangay' => $barangay ]);
        $d3 =  $db->query($autism, [ 'barangay' => $barangay ]);
        $d4 =  $db->query($blind, [ 'barangay' => $barangay ]);
        $d5 =  $db->query($deaf, [ 'barangay' => $barangay ]);
        $d6 =  $db->query($hardOfHearin, [ 'barangay' => $barangay ]);
        $d7 =  $db->query($orthopedicallyImpaired, [ 'barangay' => $barangay ]);
        $d8 =  $db->query($others, [ 'barangay' => $barangay ]);

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

    public function reason($barangay)
    {

        $db = \Config\Database::connect();
        
        $lackOfPersonalInterest = "SELECT COUNT(*) AS r1 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Lack of Personal Interest'";
        $r1Query = $db->query($lackOfPersonalInterest, [
            'barangay' => $barangay
        ]);
        
        
        $familyRelatedConcerns = "SELECT COUNT(*) AS r2 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Family Related Concerns'";
        $r2Query = $db->query($familyRelatedConcerns, [
            'barangay' => $barangay
        ]);
        

        $employment = "SELECT COUNT(*) AS r3 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Employment'";
        $r3Query = $db->query($employment, [
            'barangay' => $barangay
        ]);
        

        $earlyPregnancy = "SELECT COUNT(*) AS r4 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Early Pregnancy'";
        $r4Query = $db->query($earlyPregnancy, [
            'barangay' => $barangay
        ]);
        

        $disability = "SELECT COUNT(*) AS r5 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Disability'";
        $r5Query = $db->query($disability, [
            'barangay' => $barangay
        ]);
        

        $disease = "SELECT COUNT(*) AS r6 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Disease'";
        $r6Query = $db->query($disease, [
            'barangay' => $barangay
        ]);
        

        $distanceOfTheSchool = "SELECT COUNT(*) AS r7 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Distance of the School'";
        $r7Query = $db->query($distanceOfTheSchool, [
            'barangay' => $barangay
        ]);
        

        $cannotCopeWithSchoolWorks = "SELECT COUNT(*) AS r8 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Cannot Cope with School Works'";
        $r8Query = $db->query($cannotCopeWithSchoolWorks, [
            'barangay' => $barangay
        ]);
        

        $financialProblems = "SELECT COUNT(*) AS r9 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Cannot Cope with School Works'";
        $r9Query = $db->query($financialProblems, [
            'barangay' => $barangay
        ]);

        $others = "SELECT COUNT(*) AS r10 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.reason = 'Others'";
        $r10Query = $db->query($others, [
            'barangay' => $barangay
        ]);

        $r1 = $r1Query->getRowArray();
        $r2 = $r2Query->getRowArray();
        $r3 = $r3Query->getRowArray();
        $r4 = $r4Query->getRowArray();
        $r5 = $r5Query->getRowArray();
        $r6 = $r6Query->getRowArray();
        $r7 = $r7Query->getRowArray();
        $r8 = $r8Query->getRowArray();
        $r9 = $r9Query->getRowArray();
        $r10 = $r10Query->getRowArray();
        
        return [
            'r1' => $r1['r1'],
            'r2' => $r2['r2'],
            'r3' => $r3['r3'],
            'r4' => $r4['r4'],
            'r5' => $r5['r5'],
            'r6' => $r6['r6'],
            'r7' => $r7['r7'],
            'r8' => $r8['r8'],
            'r9' => $r9['r9'],
            'r10' => $r10['r10']
        ];

    }
    
    public function pwd($barangay)
    {
        $db =\Config\Database::connect();

        $countPwd = "SELECT COUNT(*) AS pwd FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.is_pwd = 1;";
        $pwdCount = $db->query($countPwd, [
            'barangay' => $barangay
        ]);

        $hasPwdId = "SELECT COUNT(*) AS has_pwd_id FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay: AND om.has_pwd_id = 1;";
        $hasPwdIdCount = $db->query($hasPwdId, [
            'barangay' => $barangay
        ]);

        $is_pwd = $pwdCount->getRowArray();
        $has_pwd_id = $hasPwdIdCount->getRowArray();

        return [
            'pwd_count' => $is_pwd['pwd'],
            'has_pwd_id' => $has_pwd_id['has_pwd_id']
        ];

    }

    public function civil_status($barangay)
    {
        $db = \Config\Database::connect();

        $count_single = "SELECT COUNT(oi.civil_status) AS single FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE oi.civil_status = 'Single' AND  oc.brgy = :barangay:";
        $count_married = "SELECT COUNT(oi.civil_status) AS married FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE oi.civil_status = 'Married' AND  oc.brgy = :barangay:";
        $count_separated = "SELECT COUNT(oi.civil_status) AS separated FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE oi.civil_status = 'Separated' AND  oc.brgy = :barangay:";
        $count_devorced = "SELECT COUNT(oi.civil_status) AS devorced FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE oi.civil_status = 'Devorced' AND  oc.brgy = :barangay:";
        $count_widowed = "SELECT COUNT(oi.civil_status) AS widowed FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE oi.civil_status = 'Widowed' AND  oc.brgy = :barangay:";

        $single = $db->query($count_single, ['barangay' => $barangay]);
        $married = $db->query($count_married, ['barangay' => $barangay]);
        $separated = $db->query($count_separated, ['barangay' => $barangay]);
        $divorced = $db->query($count_devorced, ['barangay' => $barangay]);
        $widowed = $db->query($count_widowed, ['barangay' => $barangay]);

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

    //for generating QCYDO and ALS Counseling Reports

    public function generate_reports($barangay, $date_from, $date_to)
    {
        $db = \Config\Database::connect();

        $countOscya = "SELECT COUNT(*) AS oscya FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:;";
        $countOscyaQuery = $db->query($countOscya, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        
        $is_employed = "SELECT COUNT(*) AS employed FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.is_employed = 1;";
        $isEmployed = $db->query($is_employed, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $is_fps_member = "SELECT COUNT(*) AS fpsMember FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.is_fps_member = 1;";
        $isFpsMember = $db->query($is_fps_member, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $is_interested = "SELECT COUNT(*) AS interested FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.is_interested = 1;";
        $isInterested = $db->query($is_interested, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $oscya = $countOscyaQuery->getRowArray();
        $employed = $isEmployed->getRowArray();
        $fpsMember = $isFpsMember->getRowArray();
        $interested = $isInterested->getRowArray();

        return [
            'oscya' => $oscya['oscya'],
            'employed' => $employed['employed'],
            'fpsMember' => $fpsMember['fpsMember'],
            'interested' => $interested['interested']
        ];

    }
    
    public function generate_gender_reports($barangay, $date_from, $date_to)
    {
        $db = \Config\Database::connect();

        $countFemale = "SELECT COUNT(*) AS female_count FROM oscya_info AS oi INNER JOIN oscya_contact AS oc ON oi.oscya_id = oc.oscya_id INNER JOIN `oscya_mapping` AS om ON om.oscya_id = oc.oscya_id  WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:  AND oi.gender = 'female'";
        $countFemaleQuery = $db->query($countFemale, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $countMale = "SELECT COUNT(*) AS male_count FROM oscya_info AS oi INNER JOIN oscya_contact AS oc ON oi.oscya_id = oc.oscya_id INNER JOIN `oscya_mapping` AS om ON om.oscya_id = oc.oscya_id  WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:  AND oi.gender = 'male'";
        $countMaleQuery = $db->query($countMale, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $male = $countMaleQuery->getRowArray();
        $female = $countFemaleQuery->getRowArray();

        return  [
            'male' => $male['male_count'],
            'female' => $female['female_count']
        ];
    }

    public function generate_educ_attainment_reports($barangay, $date_from, $date_to)
    {
        $db = \Config\Database::connect();

        $kinder = "SELECT COUNT(*) AS kinder FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'Kinder'";
        $e0Query = $db->query($kinder, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade1 = "SELECT COUNT(*) AS g1 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 1'";
        $e1Query = $db->query($grade1, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade2 = "SELECT COUNT(*) AS g2 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 2'";
        $e2Query = $db->query($grade2, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade3 = "SELECT COUNT(*) AS g3 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 3'";
        $e3Query = $db->query($grade3, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade4 = "SELECT COUNT(*) AS g4 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 4'";
        $e4Query = $db->query($grade4, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade5 = "SELECT COUNT(*) AS g5 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 5'";
        $e5Query = $db->query($grade5, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade6 = "SELECT COUNT(*) AS g6 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 6'";
        $e6Query = $db->query($grade6, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade7 = "SELECT COUNT(*) AS g7 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:AND om.educ_attainment = 'GRADE 7'";
        $e7Query = $db->query($grade7, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade8 = "SELECT COUNT(*) AS g8 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 8'";
        $e8Query = $db->query($grade8, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade9 = "SELECT COUNT(*) AS g9 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 9'";
        $e9Query = $db->query($grade9, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $grade10 = "SELECT COUNT(*) AS g10 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.educ_attainment = 'GRADE 10'";
        $e10Query = $db->query($grade10, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $kinderlevel = $e0Query->getRowArray();
        $g1 = $e1Query->getRowArray();
        $g2 = $e2Query->getRowArray();
        $g3 = $e3Query->getRowArray();
        $g4 = $e4Query->getRowArray();
        $g5 = $e5Query->getRowArray();
        $g6 = $e6Query->getRowArray();
        $g7 = $e7Query->getRowArray();
        $g8 = $e8Query->getRowArray();
        $g9 = $e9Query->getRowArray();
        $g10 = $e10Query->getRowArray();

        return [
            'kinder' => $kinderlevel['kinder'],
            'g1' => $g1['g1'],
            'g2' => $g2['g2'],
            'g3' => $g3['g3'],
            'g4' => $g4['g4'],
            'g5' => $g5['g5'],
            'g6' => $g6['g6'],
            'g7' => $g7['g7'],
            'g8' => $g8['g8'],
            'g9' => $g9['g9'],
            'g10' => $g10['g10']
        ];
    }
    
    public function generate_disability_reports($barangay, $date_from, $date_to)
    {

        $db = \Config\Database::connect(); 

        $intellectualDisability = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Intellectual Disability' AND om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:"; 
        $learningDisablity = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Learning Disability' AND om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:"; 
        $autism = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Autism' AND om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:"; 
        $blind = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Blind' AND om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:";
        $deaf = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Deaf' AND om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:";
        $hardOfHearin = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Hard of Hearin' AND om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:";
        $orthopedicallyImpaired = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Orthopedically Impaired' AND om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:";
        $others = "SELECT COUNT(disability) AS da FROM `oscya_mapping` om INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE om.disability = 'Others' AND om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:";

        $d1 =  $db->query($intellectualDisability, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $d2 =  $db->query($learningDisablity, [ 
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $d3 =  $db->query($autism, [ 
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
         ]);
        $d4 =  $db->query($blind, [ 
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
         ]);
        $d5 =  $db->query($deaf, [ 
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to 
        ]);
        $d6 =  $db->query($hardOfHearin, [ 
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $d7 =  $db->query($orthopedicallyImpaired, [ 
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $d8 =  $db->query($others, [ 
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

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

    public function generate_reason_reports($barangay, $date_from, $date_to)
    {

        $db = \Config\Database::connect();
        
        $lackOfPersonalInterest = "SELECT COUNT(*) AS r1 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Lack of Personal Interest'";
        $r1Query = $db->query($lackOfPersonalInterest, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        
        
        $familyRelatedConcerns = "SELECT COUNT(*) AS r2 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Family Related Concerns'";
        $r2Query = $db->query($familyRelatedConcerns, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        

        $employment = "SELECT COUNT(*) AS r3 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Employment'";
        $r3Query = $db->query($employment, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        

        $earlyPregnancy = "SELECT COUNT(*) AS r4 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Early Pregnancy'";
        $r4Query = $db->query($earlyPregnancy, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        

        $disability = "SELECT COUNT(*) AS r5 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Disability'";
        $r5Query = $db->query($disability, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        

        $disease = "SELECT COUNT(*) AS r6 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Disease'";
        $r6Query = $db->query($disease, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        

        $distanceOfTheSchool = "SELECT COUNT(*) AS r7 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Distance of the School'";
        $r7Query = $db->query($distanceOfTheSchool, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        

        $cannotCopeWithSchoolWorks = "SELECT COUNT(*) AS r8 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Cannot Cope with School Works'";
        $r8Query = $db->query($cannotCopeWithSchoolWorks, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        

        $financialProblems = "SELECT COUNT(*) AS r9 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Financial Problems'";
        $r9Query = $db->query($financialProblems, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $others = "SELECT COUNT(*) AS r10 FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.reason = 'Others'";
        $r10Query = $db->query($others, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $r1 = $r1Query->getRowArray();
        $r2 = $r2Query->getRowArray();
        $r3 = $r3Query->getRowArray();
        $r4 = $r4Query->getRowArray();
        $r5 = $r5Query->getRowArray();
        $r6 = $r6Query->getRowArray();
        $r7 = $r7Query->getRowArray();
        $r8 = $r8Query->getRowArray();
        $r9 = $r9Query->getRowArray();
        $r10 = $r10Query->getRowArray();
        
        return [
            'r1' => $r1['r1'],
            'r2' => $r2['r2'],
            'r3' => $r3['r3'],
            'r4' => $r4['r4'],
            'r5' => $r5['r5'],
            'r6' => $r6['r6'],
            'r7' => $r7['r7'],
            'r8' => $r8['r8'],
            'r9' => $r9['r9'],
            'r10' => $r10['r10']
        ];

    }
    
    public function generate_pwd_reports($barangay, $date_from, $date_to)
    {

        $db =\Config\Database::connect();

        $countPwd = "SELECT COUNT(*) AS pwd FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.is_pwd = 1;";
        $pwdCount = $db->query($countPwd, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $hasPwdId = "SELECT COUNT(*) AS has_pwd_id FROM oscya_mapping AS om INNER JOIN oscya_contact AS oc ON om.oscya_id = oc.oscya_id WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay: AND om.has_pwd_id = 1;";
        $hasPwdIdCount = $db->query($hasPwdId, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

        $is_pwd = $pwdCount->getRowArray();
        $has_pwd_id = $hasPwdIdCount->getRowArray();

        return [
            'pwd_count' => $is_pwd['pwd'],
            'has_pwd_id' => $has_pwd_id['has_pwd_id']
        ];

    }

    public function generate_civil_status($barangay, $date_from, $date_to)
    {
        $db = \Config\Database::connect();

        $count_single = "SELECT COUNT(oi.civil_status) AS single FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oi.civil_status = 'Single' AND  oc.brgy = :barangay:";
        $count_married = "SELECT COUNT(oi.civil_status) AS married FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oi.civil_status = 'Married' AND  oc.brgy = :barangay:";
        $count_separated = "SELECT COUNT(oi.civil_status) AS separated FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oi.civil_status = 'Separated' AND  oc.brgy = :barangay:";
        $count_devorced = "SELECT COUNT(oi.civil_status) AS devorced FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oi.civil_status = 'Devorced' AND  oc.brgy = :barangay:";
        $count_widowed = "SELECT COUNT(oi.civil_status) AS widowed FROM `oscya_info` AS oi INNER JOIN `oscya_mapping` AS om USING(oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id)  WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oi.civil_status = 'Widowed' AND  oc.brgy = :barangay:";

        $single = $db->query($count_single, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $married = $db->query($count_married, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $separated = $db->query($count_separated, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $divorced = $db->query($count_devorced, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $widowed = $db->query($count_widowed, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);

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

    public function insert_report( $coordinator_id, $filename, $purpose, $date_from, $date_to, $file_loc)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `report_setting`( `user_id`, `filename`, `purpose`, `date_from`, `date_to`, `file_loc`) VALUES (:coordinator_id:, :filename:, :purpose:, :date_from:, :date_to:, :file_loc:)";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'filename' => $filename, 
            'purpose' => $purpose, 
            'date_from' => $date_from,
            'date_to' => $date_to,
            'file_loc' => $file_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function select_reports($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `filename`, `purpose`, `date_from`, `date_to`, `file_loc`, `date_created` FROM `report_setting` WHERE `user_id` = :user_id: ORDER BY `date_created` DESC";
        $query = $db->query($sql, [
            'user_id' => $coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function select_excel_report($barangay, $date_from, $date_to)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.oscya_id, om.user_id, oi.fullname, oi.lastname, oi.firstname, oi.middlename, oi.extension, oi.birthdate, oi.age, oi.gender, oi.civil_status, oi.religion, oc.email, oc.contact, oc.facebook, oc.street, oc.brgy, og.fullname, og.email AS g_email, og.contact AS g_contact, og.facebook AS g_facebook, om.lrn, om.educ_attainment, om.reason, om.other_reason, om.disability, om.is_pwd, om.has_pwd_id, om.other_disability, om.disease, om.is_employed, om.is_fps_member, om.is_interested, om.mapping_date FROM oscya_info oi INNER JOIN  oscya_contact oc USING(oscya_id) INNER JOIN oscya_guardian og USING(oscya_id) INNER JOIN oscya_mapping om USING(oscya_id) WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:;";

        $query = $db->query($sql, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        
        return $query->getResultArray();
    }

    //end of generating reports

    public function check_fid($f_id)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `facility_id` FROM `facility`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->facility_id == $f_id){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    public function check_act_id($act_id)
    {
        $db = \Config\Database::connect();
        $isAvailable = false;
        $sql = "SELECT `activity_id` FROM `activity`";
        $query = $db->query($sql);
        foreach ($query->getResult() as $row) {
            if($row->activity_id == $act_id){
                $isAvailable = true;
                break;
            }else{
                $isAvailable = false;
            }
        }
        return $isAvailable;
    }

    public function insert_teacher_task($coordinator_id, $staff_id, $teacher_id, $facility_id, $schedule_date, $start_time, $end_time)
    {
        $db = \Config\Database::connect();

        $sql = "INSERT INTO `teacher_task`(`coord_id`, `user_id`, `staff_id`, `brgy_facility`, `sched_date`, `start_time`, `end_time`) VALUES (:coord_id:,:teacher_id:,:staff_id:,:facility_id:,:sched_date:,:start_time:,:end_time:)";
        $query = $db->query($sql, [
            'coord_id' =>  $coordinator_id,
            'teacher_id' => $teacher_id,
            'staff_id' => $staff_id, 
            'facility_id' => $facility_id,
            'sched_date' => $schedule_date,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function add_facility($facility_id, $coordinator_id, $facility_location, $facility_name, $description, $type, $facility_image_location)
    {
        $db = \Config\Database::connect();

        $sql = "INSERT INTO `facility`(`facility_id`, `coordinator_id`, `address`, `name`, `description`, `type`, `image`) VALUES (:facility_id:, :coordinator_id:, :facility_location:, :facility_name:, :description:, :type:,:facility_image_location:)";

        $query = $db->query($sql, [
            'facility_id' => $facility_id,
            'coordinator_id' => $coordinator_id,
            'facility_location' => $facility_location, 
            'facility_name' => $facility_name, 
            'description' => $description, 
            'type' => $type, 
            'facility_image_location' => $facility_image_location
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_facility($coordinator_id, $facility_id, $facility_location, $facility_name, $description, $type, $facility_image_location)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `facility` SET `address`=:f_address:, `name`=:f_name:, `description`=:f_description:, `type`=:f_type:,`image`=:facility_image_location: WHERE `coordinator_id`=:coordinator_id: AND `facility_id`=:facility_id:";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'facility_id' => $facility_id,
            'f_address' => $facility_location, 
            'f_name' => $facility_name, 
            'f_description' => $description, 
            'f_type' => $type, 
            'facility_image_location' => $facility_image_location
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function select_facilities($coordinator_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT `id`, `facility_id`, `address`, `name`, `description`, `type`, `image` FROM `facility` WHERE `coordinator_id` = :coordinator_id:";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getResultArray();
    }

    public function select_facility_info($facility_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT `address`, `name`, `description`, `type`, `image` FROM `facility` WHERE  `facility_id` = :facility_id:";

        $query = $db->query($sql, [
            'facility_id' => $facility_id
        ]);
        return $query->getRowArray();
    }

    public function insert_activity($facility_id, $activity_id, $user_id, $activity_date, $start_time, $end_time, $title, $description, $link)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `activity`(`facility_id`, `activity_id`, `user_id`, `activity_date`, `start_time`, `end_time`, `title`, `description`, `link`) VALUES (:facility_id:, :activity_id:, :user_id:,:activity_date:,:start_time:,:end_time:,:title:,:description:,:link:)";
        $query = $db->query($sql, [
            "facility_id" => $facility_id,
            "activity_id" => $activity_id,
            "user_id" => $user_id, 
            "activity_date" => $activity_date,
            "start_time" => $start_time,
            "end_time" => $end_time,
            "title" => $title,
            "description" => $description,
            "link" => $link
        ]);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }

    public function insert_counseling_sched($facility_id, $activity_id, $user_id, $activity_date, $start_time, $end_time, $title, $description)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `activity`(`facility_id`, `activity_id`, `user_id`, `activity_date`, `start_time`, `end_time`, `title`, `description`) VALUES (:facility_id:, :activity_id:, :user_id:,:activity_date:,:start_time:,:end_time:,:title:,:description:)";
        $query = $db->query($sql, [
            "facility_id" => $facility_id,
            "activity_id" => $activity_id,
            "user_id" => $user_id, 
            "activity_date" => $activity_date,
            "start_time" => $start_time,
            "end_time" => $end_time,
            "title" => $title,
            "description" => $description
        ]);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }

    public function select_activity($f_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `user_id`, `activity_id`, `facility_id`, `activity_date`, `start_time`, `end_time`, `title`, `description`, `link`, `date_created` FROM `activity` WHERE `facility_id` = :facility_id:";
        $query = $db->query($sql, [
            'facility_id' => $f_id
        ]);

        return $query->getResultArray();
    }

    public function check_activity($act_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `activity` WHERE `activity_id` = :activity_id:";
        $query = $db->query($sql, [
            'activity_id' => $act_id
        ]);
        if(empty($query->getResultArray())){
            return false;
        }else{
            return true;
        }
    }

    public function update_activity($act_id, $title, $date, $start, $end, $description, $link)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `activity` SET `activity_date`=:_date:,`start_time`=:_start:,`end_time`=:_end:,`title`=:title:,`description`=:_description:,`link`=:link: WHERE `activity_id`=:activity_id:";
        $query = $db->query($sql, [
            'activity_id' => $act_id,
            'title' => $title, 
            '_date' => $date, 
            '_start' => $start, 
            '_end' => $end, 
            '_description' => $description, 
            'link' => $link
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function delete_activity($activity_id)
    {
        $db = \Config\Database::connect();
        $sql = "DELETE FROM `activity` WHERE `activity_id`=:activity_id:";
        $query = $db->query($sql, [
            'activity_id' => $activity_id,
    
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function backup_osy_mapping($barangay, $date_from, $date_to)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.oscya_id, om.user_id, oi.lastname, oi.firstname, oi.middlename, oi.extension, oi.birthdate, oi.age, oi.gender, oi.civil_status, oi.religion, oc.email, oc.contact, oc.facebook, oc.street, oc.brgy, og.fullname, og.email AS g_email, og.contact AS g_contact, og.facebook AS g_facebook, om.lrn, om.educ_attainment, om.reason, om.other_reason, om.disability, om.is_pwd, om.has_pwd_id, om.other_disability, om.disease, om.is_employed, om.is_fps_member, om.is_interested, om.mapping_date FROM oscya_info oi INNER JOIN  oscya_contact oc USING(oscya_id) INNER JOIN oscya_guardian og USING(oscya_id) INNER JOIN oscya_mapping om USING(oscya_id) WHERE om.mapping_date BETWEEN DATE_FORMAT(:date_from:, '%Y-%m-%d') AND DATE_FORMAT(:date_to:, '%Y-%m-%d') AND oc.brgy = :barangay:;";

        $query = $db->query($sql, [
            'barangay' => $barangay,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        
        return $query->getResultArray();
    }

    public function insert_backup_info($user_id, $filename, $date_from, $date_to, $choose, $backup_loc)
    {
        $db = \Config\Database::connect();

        $sql = "INSERT INTO `backup_setting`(`user_id`, `filename`, `date_from`, `date_to`, `choose`, `backup_loc`) VALUES (:user_id:, :filename:, :date_from:, :date_to:, :choose:, :backup_loc:)";

        $query = $db->query($sql, [
            'user_id' => $user_id,
            'filename' => $filename,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'choose' => $choose,
            'backup_loc' => $backup_loc
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function select_backups($coordinator_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT `user_id`, `filename`, `date_from`, `date_to`, `choose`, `backup_loc`, `date_created` FROM `backup_setting` WHERE `user_id` = :coordinator_id:	";

        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getResultArray();
    }

    public function migrate_osy($oscya_id, $staff_id, $teacher_id, $fullname,  $age, $birthdate, $gender, $civil_status, $street, $barangay, $district, $religion, $gfullname, $gcontact, $educ_attainment, $reason, $is_pwd, $disability, $has_pwd_id, $is_employed, $is_fps_member, $is_interested, $mapping_date, $counseling_date)
    {
        $db = \Config\Database::connect();
        $sql = "CALL `migrate_oscya`( :oscya_id:, :staff_id:, :teacher_id:, :fullname:,  :age:, :birthdate:, :gender:, :civil_status:, :street:, :barangay:, :district:, :religion:, :gfullname:, :gcontact:, :educ_attainment:, :reason:, :is_pwd:, :disability:, :has_pwd_id:, :is_employed:, :is_fps_member:, :is_interested:, :mapping_date:, :counseling_date:)";
        $query = $db->query($sql, [
            "oscya_id" => $oscya_id,
            "staff_id" => $staff_id,
            "teacher_id" => $teacher_id,
            "fullname" => $fullname,
            "age" => $age,
            "birthdate" => $birthdate,
            "gender" => $gender,
            "civil_status" => $civil_status,
            "street" => $street,
            "barangay" => $barangay,
            "district" => $district,
            "religion" => $religion,
            "gfullname" => $gfullname, 
            "gcontact" => $gcontact,
            "educ_attainment" => $educ_attainment,
            "reason" => $reason,
            "is_pwd" => $is_pwd,
            "disability" => $disability,
            "has_pwd_id" => $has_pwd_id,
            "is_employed" => $is_employed,
            "is_fps_member" => $is_fps_member,
            "is_interested" => $is_interested,
            "mapping_date" => $mapping_date,
            "counseling_date" => $counseling_date
        ]);

        
        
    }

    public function assign_migrated_task($coord_id,$teacher_id,$staff_id, $facility_id, $sched_date)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `teacher_task`(`coord_id`, `user_id`, `staff_id`, `brgy_facility`, `sched_date`, `is_done`) VALUES (:coord_id:,:teacher_id:,:staff_id:, :facility_id:, :sched_date:, 1)";
        $query = $db->query($sql, [
            "coord_id" => $coord_id,
            "teacher_id" => $teacher_id,
            "staff_id" => $staff_id,
            'facility_id' => $facility_id,
            "sched_date" => $sched_date
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function count_tasks($coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT COUNT(*) AS all_tasks FROM `teacher_task` WHERE coord_id = :coord_id:";
        $query = $db->query($sql, [
            'coord_id' => $coord_id
        ]);
        return $query->getRowArray();
    }
    
    public function select_assigned_task($coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT t_task.user_id AS teacher_id,  f.name, f.address,f.image AS facility_image, t_task.sched_date AS sched, t_task.start_time AS start, t_task.end_time, i.image AS staff_image, ti.image AS teacher_image FROM `teacher_task` t_task INNER JOIN `info` i ON t_task.staff_id = i.user_id INNER JOIN teacher_info ti ON t_task.user_id = ti.user_id INNER JOIN `facility` f ON t_task.brgy_facility = f.facility_id WHERE t_task.coord_id = :coord_id: LIMIT 5";
        $query = $db->query($sql, [
            'coord_id' => $coord_id
        ]);
        return $query->getResultArray();
    }

    public function select_activities($coord_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT  `user_id`, `staff_id`, `brgy_facility`, `sched_date`, `start_time`, `end_time`, `is_done` FROM `teacher_task` WHERE `coord_id` = :coord_id:";
        $query = $db->query($sql, [
            'coord_id' => $coord_id
        ]);
        return $query->getResultArray();
    }
}
