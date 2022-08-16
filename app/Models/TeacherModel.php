<?php

namespace App\Models;

use CodeIgniter\Model;


class TeacherModel extends Model
{

    public function check_barangay($coordinator_id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT * FROM `user` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getRowArray();
    }

    public function check_staff($staff_id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT * FROM `user` WHERE `user_id` = :staff_id:";
        $query = $db->query($sql, [
            'staff_id' => $staff_id
        ]);
        return $query->getRowArray();
    }

    public function login($username, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT `user_id`, `username`, `password`, `isActivated`, `is_evaluated`, `email` FROM `teacher`";
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

    public function update_status($teacher_id, $isActive)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher` SET `status`= :is_active: WHERE `user_id` = :teacher_id:";
        $isUpdated = $query = $db->query($sql, [
            'is_active' => $isActive,
            'teacher_id' => $teacher_id
        ]);
        return $isUpdated;
    }

    public function activation_code($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `user_id`, `username`, `password`, `user_type`, `is_evaluated`, `activation_code`, `email` FROM `teacher` WHERE `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function update_activation_status($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher` SET `isActivated`= 1 WHERE `user_id` = :teacher_id:;";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
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

        $sql = "SELECT `user_id`, `username` FROM `teacher` WHERE `email` = :email: AND is_email_activated = 1";

        $query = $db->query($sql, [
            'email' => $email
        ]);

        return $query->getRowArray();
    }

    public function reset_password($teacher_id, $new_password)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `teacher` SET `password`=:new_password: WHERE `user_id` = :teacher_id:";

        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'new_password' => $new_password
        ]);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function select_teacher_info($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `lastname`, `firstname`, `middlename`, `ext`, `birthdate`, `age`, `gender`, `image` FROM `teacher_info` WHERE  `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            "teacher_id" => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function select_teacher_contact($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `contact_no`, `email`, `facebook`, `street`, `barangay`, `district`, `city`, `zipcode` FROM `teacher_contact` WHERE `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            "teacher_id" => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function select_teacher_credential($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `id_loc`, `allow` FROM `teacher_credential` WHERE `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            "teacher_id" => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function select_teacher_account($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `creator_id`, `username`, `password`, `user_type`, `is_evaluated`, `resubmit`, `activation_code`, `isActivated`, `status`, `email`, `is_email_activated` FROM `teacher` WHERE `user_id` = :teacher_id:";
        $query = $db->query($sql, [
            "teacher_id" => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function check_current_password($username, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT `user_id`, `username`, `password`, `isActivated`, `is_evaluated`, `email` FROM `teacher`";
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

    public function update_current_password($teacher_id, $username, $password)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE `teacher` SET `username`=:username:, `password`=:password: WHERE `user_id`=:teacher_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'username' => $username,
            'password' => $password
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function edit_profile_pic($teacher_id, $image)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher_info` SET `image`= :image: WHERE `user_id`= :teacher_id:";
         $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'image' => $image
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_info($teacher_id, $lastname, $firstname, $middlename, $ext, $birth, $age, $gender)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher_info` SET `lastname`=:lastname:,`firstname`=:firstname:,`middlename`=:middlename:,`ext`=:ext:,`birthdate`=:birthdate:,`age`=:age:,`gender`=:gender: WHERE `user_id`=:teacher_id:";

        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'lastname' => $lastname,
            'firstname'=> $firstname,
            'middlename' => $middlename,
            'ext' => $ext,
            'birthdate' => $birth,
            'age' => $age,
            'gender' => $gender,
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_contact($teacher_id, $email, $contact_no, $facebook, $street, $barangay, $district, $zip_code,  $city)
    {
        $db = \Config\Database::connect();
        $sql = " UPDATE `teacher_contact` SET `email`=:email:,`facebook`=:facebook:,`contact_no`=:contact_no:,`street`=:street:,`barangay`=:barangay:,`district`=:district:,`zipcode`=:zipcode:,`city`=:city: WHERE `user_id`=:teacher_id:";

        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'email' => $email,
            'facebook'=> $facebook,
            'contact_no' => $contact_no,
            'street' => $street,
            'barangay' => $barangay,
            'district' => $district,
            'zipcode' => $zip_code,
            'city' => $city
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_account($teacher_id, $username, $password)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher` SET `username`=:username:,`password`=:password: WHERE `user_id` = :teacher_id:;";

        $query = $db->query($sql, [
            'username' => $username,
            'password' => $password,
            'teacher_id' => $teacher_id
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_valid_id($teacher_id, $id_loc)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `teacher_credential` SET `id_loc`=:id_loc: WHERE `user_id` = :teacher_id:";

        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'id_loc' => $id_loc
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }
    
    public function select_barangays($district)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT c.user_id, b.barangay, b.logo FROM contact c INNER JOIN barangay b USING(user_id) INNER JOIN `user` u USING(user_id)  WHERE c.district = :district: AND u.user_type = 'Coordinator'";
        $query = $db->query($sql, [
            "district" => $district
        ]);
        return $query->getResultArray();
    }

    public function select_barangay($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `id`, `user_id`, `barangay`, `about`, `address`, `contact_no`, `from`, `to`, `email`, `facebook_page`, `official_web`, `logo`, `cover_photo`, `img_1`, `img_2` FROM `barangay` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            "coordinator_id" => $coordinator_id
        ]);
        return $query->getRowArray();
    }

    public function count_all_osy($barangay)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(*) AS osy FROM `oscya_contact` WHERE `brgy` = :barangay:";
        $query = $db->query($sql, [
            'barangay' => $barangay
        ]);
        return $query->getRowArray();
       
    }

    public function select_all_tasks($coordinator_id, $teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT tch_task.staff_id, CONCAT(tch_info.firstname, ' ', tch_info.lastname) AS fullname, tch_task.is_done, f.name, tch_task.sched_date, tch_task.start_time, tch_task.end_time FROM `teacher_task` tch_task INNER JOIN `teacher_info` tch_info USING(user_id) INNER JOIN `facility` f ON tch_task.brgy_facility = f.facility_id  WHERE tch_task.coord_id = :coordinator_id: AND tch_task.user_id = :teacher_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'teacher_id' => $teacher_id
        ]);
        return $query->getResultArray();
    }

    public function select_ongoing_task($coordinator_id, $teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT tch_task.staff_id, CONCAT(tch_info.firstname, ' ', tch_info.lastname) AS fullname, tch_task.is_done, f.name, tch_task.sched_date, tch_task.start_time, tch_task.end_time FROM `teacher_task` tch_task INNER JOIN `teacher_info` tch_info USING(user_id) INNER JOIN `facility` f ON tch_task.brgy_facility = f.facility_id  WHERE tch_task.is_done = 0 AND tch_task.coord_id = :coordinator_id: AND tch_task.user_id = :teacher_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'teacher_id' => $teacher_id
        ]);
        return $query->getResultArray();
    }

    public function select_accomplish_task($coordinator_id, $teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT tch_task.staff_id, CONCAT(tch_info.firstname, ' ', tch_info.lastname) AS fullname, tch_task.is_done, f.name, tch_task.sched_date, tch_task.start_time, tch_task.end_time FROM `teacher_task` tch_task INNER JOIN `teacher_info` tch_info USING(user_id) INNER JOIN `facility` f ON tch_task.brgy_facility = f.facility_id  WHERE tch_task.is_done = 1 AND tch_task.coord_id = :coordinator_id: AND tch_task.user_id = :teacher_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id,
            'teacher_id' => $teacher_id
        ]);
        return $query->getResultArray();
    }

    public function count_barangay_tasks($coordinator_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(*) AS all_task FROM `teacher_task` WHERE `coord_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);
        return $query->getRowArray();
       
    }

    public function select_all_task($teacher_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT tch_task.als_coord_id AS als_coord_id, tch_task.staff_id AS staff_id, tch_task.sched_date AS sched_date, CONCAT(i.lastname,', ' ,i.firstname) AS name, c.barangay AS barangay, i.image AS image FROM `teacher_task` tch_task INNER JOIN `contact` c ON tch_task.staff_id = c.user_id INNER JOIN `info` i ON tch_task.staff_id = i.user_id WHERE tch_task.user_id = :teacher_id:";

        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);

        return $query->getResultArray();
    }

    public function select_per_barangay($teacher_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT tch_task.als_coord_id AS als_coord_id, tch_task.staff_id AS staff_id, tch_task.sched_date AS sched_date, CONCAT(i.lastname,', ' ,i.firstname) AS name, c.barangay AS barangay, i.image AS image FROM `teacher_task` tch_task INNER JOIN `contact` c ON tch_task.staff_id = c.user_id INNER JOIN `info` i ON tch_task.staff_id = i.user_id WHERE tch_task.user_id = :teacher_id:";

        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);
        return $query->getResultArray();
    }

    public function select_ten_task($teacher_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT tch_task.id AS id, tch_task.als_coord_id AS als_coord_id, tch_task.staff_id AS staff_id, tch_task.sched_date AS sched_date, tch_task.is_done AS is_done, CONCAT(i.firstname,' ' ,i.lastname) AS name, c.barangay AS barangay, i.image AS image FROM `teacher_task` tch_task INNER JOIN `contact` c ON tch_task.staff_id = c.user_id INNER JOIN `info` i ON tch_task.staff_id = i.user_id WHERE tch_task.user_id = :teacher_id: LIMIT 5";

        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);

        return $query->getResultArray();
    }

    public function count_all_tasks($teacher_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(*) AS all_task FROM `teacher_task` WHERE user_id = :teacher_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);
        return $query->getRowArray();
       
    }

    public function count_completed_tasks($teacher_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT COUNT(*) AS completed_task FROM `teacher_task` WHERE is_done = 1 AND user_id = :teacher_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);
        return $query->getRowArray();
    }

    public function select_osya_records($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT om.id, om.oscya_id, CONCAT(oi.firstname, ' ',oi.lastname) AS fullname, oc.contact, oc.facebook, oc.email, om.mapping_date FROM `oscya_mapping` om INNER JOIN `oscya_info` oi USING (oscya_id) INNER JOIN `oscya_contact` oc USING (oscya_id) INNER JOIN `oscya_counseling` ocl USING (oscya_id) WHERE om.user_id = :staff_id: AND ocl.is_counseled = 0";

        $query = $db->query($sql, [
            'staff_id' => $staff_id
        ]);

        return $query->getResultArray();
    }

    public function select_ongoing_osy($staff_id, $teacher_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT om.id, om.oscya_id, CONCAT(oi.firstname, ' ',oi.lastname) AS fullname, oc.contact, oc.facebook, oc.email, om.mapping_date FROM `oscya_mapping` om INNER JOIN `oscya_info` oi USING (oscya_id) INNER JOIN `oscya_contact` oc USING (oscya_id) INNER JOIN `oscya_counseling` ocl USING (oscya_id) WHERE om.user_id = :staff_id: AND ocl.is_counseled = 0";

        $query = $db->query($sql, [
            'staff_id' => $staff_id,
            'teacher_id' => $teacher_id
        ]);

        return $query->getResultArray();
    }

    public function select_counseled_osy($staff_id, $teacher_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT om.id, om.oscya_id, CONCAT(oi.firstname, ' ',oi.lastname) AS name, oi.fullname, oc.contact, oc.facebook, oc.email, om.mapping_date FROM `oscya_mapping` om INNER JOIN `oscya_info` oi USING (oscya_id) INNER JOIN `oscya_contact` oc USING (oscya_id) INNER JOIN `oscya_counseling` ocl USING (oscya_id) WHERE om.user_id = :staff_id: AND ocl.is_counseled = 1 AND ocl.teacher_id = :teacher_id:";

        $query = $db->query($sql, [
            'staff_id' => $staff_id,
            'teacher_id' => $teacher_id
        ]);

        return $query->getResultArray();
    }

    public function select_osy_mapping($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.oscya_id, om.user_id, oi.lastname, oi.firstname, oi.middlename, oi.extension, oi.birthdate, oi.age, oi.gender, oi.civil_status, oi.religion, oc.email, oc.contact, oc.facebook, oc.street, oc.brgy, og.fullname, og.email AS g_email, og.contact AS g_contact, og.facebook AS g_facebook, om.lrn, om.educ_attainment, om.reason, om.other_reason, om.disability, om.is_pwd, om.has_pwd_id, om.other_disability, om.disease, om.is_employed, om.is_fps_member, om.is_interested, om.mapping_date FROM oscya_info oi INNER JOIN  oscya_contact oc USING(oscya_id) INNER JOIN oscya_guardian og USING(oscya_id) INNER JOIN oscya_mapping om USING(oscya_id) WHERE om.user_id = :staff_id:;";

        $query = $db->query($sql, [
            'staff_id' => $staff_id
        ]);
        
        return $query->getResultArray();
    }

    public function select_counsel_records($teacher_id, $barangay)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT ocl.oscya_id, CONCAT(oi.firstname, ' ',oi.lastname) AS name, oi.fullname, oc.brgy, ocl.counsel_date FROM `oscya_counseling` ocl INNER JOIN `oscya_info` oi USING (oscya_id) INNER JOIN `oscya_contact` oc USING(oscya_id) WHERE ocl.teacher_id = :teacher_id: AND ocl.is_counseled=1 AND oc.brgy = :barangay:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'barangay' => $barangay
        ]);
        return $query->getResultArray();
    }

    public function oscya_info($oscya_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM oscya_info WHERE `oscya_id` = :oscya_id:";
        $query = $db->query($sql, ['oscya_id' => $oscya_id]);
        $oscya_info = $query->getRowArray();
        return $oscya_info;
    }

    public function oscya_mapping($oscya_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM oscya_mapping WHERE `oscya_id` = :oscya_id:";
        $query = $db->query($sql, ['oscya_id' => $oscya_id]);
        $oscya_mapping = $query->getRowArray();
        return $oscya_mapping;
    }

    public function oscya_guardian($oscya_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM oscya_guardian WHERE `oscya_id` = :oscya_id:";
        $query = $db->query($sql, ['oscya_id' => $oscya_id]);
        $oscya_guardian = $query->getRowArray();
        return $oscya_guardian;
    }

    public function oscya_contact($oscya_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM oscya_contact WHERE `oscya_id` = :oscya_id:";
        $query = $db->query($sql, ['oscya_id' => $oscya_id]);
        $oscya_contact = $query->getRowArray();
        return $oscya_contact;
    }

    public function oscya_counselling($oscya_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM oscya_counseling WHERE `oscya_id` = :oscya_id:";
        $query = $db->query($sql, ['oscya_id' => $oscya_id]);
        $oscya_contact = $query->getRowArray();
        return $oscya_contact;
    }

    public function update_oscya_counselling($teacher_id, $oscya_id, $lrn, $educ_type, $is_interested, $counselling_date)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `oscya_counseling` SET `lrn` = :lrn:, `teacher_id`=:teacher_id:,`formal`=:formal:,`informal`=:informal:, `is_interested` = :is_interested:,`is_counseled`= 1, `counsel_date`=:counsel_date: WHERE `oscya_id`= :oscya_id:";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'lrn' => $lrn,
            'formal' => $educ_type == 'f_educ' ? 1 : 0,
            'informal' => $educ_type == 'inf_educ' ? 1 : 0,
            'is_interested' => $is_interested,
            'counsel_date' => $counselling_date,
            'oscya_id' => $oscya_id,
        ]);
        
    }

    public function update_oscya_lrn($oscya_id, $lrn)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `oscya_mapping` SET `lrn`=:lrn: WHERE `oscya_id` = :oscya_id:";
        $query = $db->query($sql, [
            'oscya_id' => $oscya_id,
            'lrn' => $lrn
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function insert_oscya_admission($teacher_id, $oscya_id, $lrn, $pis_score, $exam_type, $learning_mode, $grade_level)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `oscya_admission`(`teacher_id`, `oscya_id`, `lrn`, `pis_score`, `exam_type`, `learning_mode`,`grade_level`) VALUES (:teacher_id:,:oscya_id:,:lrn:,:pis_score:,:exam_type:,:learning_mode:,:grade_level:)";
        $query = $db->query($sql, [
            'teacher_id' => $teacher_id,
            'oscya_id' => $oscya_id,
            'lrn' => $lrn,
            'pis_score' => $pis_score,
            'exam_type' => $exam_type,
            'learning_mode' => $learning_mode,
            'grade_level' => $grade_level
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function register_osy($lrn, $teacher_id, $info, $con)
    {   
        $db1 = \Config\Database::connect('alsLmsDb');
        $sql = "INSERT INTO `student_info`(`lrn`, `oscya_id`, `lastname`, `firstname`, `middlename`, `extension`, `birthdate`, `age`, `gender`, `civil_status`, `religion`) VALUES (:lrn:, :oscya_id:, :lastname:, :firstname:, :middlename:, :extension:, :birthdate:, :age:, :gender:, :civil_status:, :religion:)";
        $insertInfo = $db1->query($sql, [
            'lrn' => $lrn, 
            'oscya_id' => $info['oscya_id'],
            'lastname' => $info['lastname'],
            'firstname' => $info['firstname'],
            'middlename' => $info['middlename'],
            'extension' => $info['extension'],
            'birthdate' => $info['birthdate'],
            'age' => $info['age'],
            'gender' => $info['gender'],
            'civil_status' => $info['civil_status'],
            'religion' => $info['religion']
        ]);
        $sql2 = "INSERT INTO `student_contact`(`lrn`, `email`, `contact`, `facebook`, `street`, `barangay`, `district`, `city`, `state`, `zip_code`) VALUES (:lrn:,:email:,:contact:,:facebook:,:street:,:barangay:,:district:,:city:,:state:,:zip_code:)";
        $insertCon = $db1->query($sql2, [
            'lrn' => $lrn, 
            'email' => $con['email'],
            'contact' => $con['contact'],
            'facebook' => $con['facebook'],
            'street' => $con['street'],
            'barangay' => $con['brgy'],
            'district' => $con['district'],
            'city' => $con['city'],
            'state' => $con['state'],
            'zip_code' => $con['zip_code']
        ]);
        $sql3 = "INSERT INTO `student_registration`(`oscya_id`, `lrn`, `registered_by`) VALUES (:oscya_id:, :lrn: ,:registered_by:);";
        $insertRegInfo = $db1->query($sql3, [
            'oscya_id' => $info['oscya_id'],
            'lrn' => $lrn,
            'registered_by' => $teacher_id
        ]);

        
    }

    public function update_personal_info($oscya_id, $lastname, $firstname, $middlename, $extension, $birthdate, $age, $gender, $civil_status, $religion)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `oscya_info` SET `lastname` = :lastname:, `firstname` = :firstname:, `middlename` = :middlename:, `extension` = :extension:, `birthdate` = :birthdate:, `age` = :age:, `gender` = :gender:, `civil_status` = :civil_status:, `religion` = :religion: WHERE  `oscya_id` = :oscya_id:";
        $query = $db->query($sql, [
            'oscya_id' => $oscya_id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'extension' => $extension,
            'birthdate' => $birthdate,
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

    public function update_contact_detail($oscya_id, $email, $contact, $facebook, $street, $brgy, $district, $city, $state, $zip_code, $p_street, $p_barangay, $p_district, $p_city, $p_state, $p_zip_code)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `oscya_contact` SET `email` = :email:, `contact` = :contact:, `facebook` = :facebook:, `street` = :street:, `brgy` = :brgy:, `district` = :district:, `city` = :city:, `state` = :state:, `zip_code` = :zip_code:, `p_street` = :p_street:, `p_barangay` = :p_barangay:, `p_district` = :p_district:, `p_city` = :p_city:, `p_state` = :p_state:, `p_zip_code` = :p_zip_code: WHERE `oscya_id` = :oscya_id:;";

        $query = $db->query($sql, [
            'oscya_id' => $oscya_id,
            'email' => $email,
            'contact' => $contact,
            'facebook' => $facebook,
            'street' => $street,
            'brgy' => $brgy,
            'district' => $district,
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip_code,
            'p_street' => $p_street,
            'p_barangay' => $p_barangay,
            'p_district' => $p_district,
            'p_city' => $p_city,
            'p_state' => $p_state,
            'p_zip_code' => $p_zip_code
        ]);
        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function update_guardian_detail($oscya_id, $fullname, $email, $contact, $facebook)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `oscya_guardian` SET `fullname` = :fullname:, `email` = :email:,`contact` = :contact:,`facebook` = :facebook: WHERE `oscya_id` = :oscya_id:";

        $query = $db->query($sql, [
            'oscya_id' => $oscya_id,
            'fullname' => $fullname,
            'email' => $email,
            'contact' => $contact,
            'facebook' => $facebook
        ]);

        if ($query == true) {
            return true;
        }else{
            return false;
        }
    }

    public function update_mapping_detail($oscya_id, $educ_attainment, $reason, $other_reason, $is_pwd, $has_pwd_id, $disability, $other_disability, $disease,  $is_employed, $is_fps_member, $is_interested)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE `oscya_mapping` SET `educ_attainment` = :educ_attainment:,`reason` = :reason:, `other_reason` = :other_reason:, `disability` = :disability:, `is_pwd` = :is_pwd:, `has_pwd_id` = :has_pwd_id:,`other_disability` = :other_disability:, `disease` = :disease:, `is_employed` = :is_employed:, `is_fps_member` = :is_fps_member:, `is_interested` = :is_interested: WHERE `oscya_id`=:oscya_id:";

        $query = $db->query($sql, [
            'oscya_id' => $oscya_id,
            'educ_attainment' => $educ_attainment,
            'reason' => $reason,
            'other_reason' => $other_reason,
            'disability' => $disability,
            'is_pwd' => $is_pwd,
            'has_pwd_id' => $has_pwd_id,
            'other_disability' => $other_disability,
            'disease' => $disease,
            'is_employed' => $is_employed,
            'is_fps_member' => $is_fps_member,
            'is_interested' => $is_interested
        ]);

        if ($query == true) {
            return true;
        }else{
            return false;
        }
    }

    public function select_counseled_records($teacher_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.id, oa.teacher_id, oa.lrn, CONCAT(oi.firstname,' ', oi.lastname) AS fullname, oa.date_counseled FROM `oscya_admission` oa INNER JOIN `oscya_info` oi USING(oscya_id) WHERE oa.teacher_id =:teacher_id: ORDER BY oi.id ASC";

        $query = $db->query($sql, [
            'teacher_id' => $teacher_id
        ]);

        return $query->getResultArray();
    }
}
