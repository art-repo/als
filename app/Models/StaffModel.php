<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    public function check_activation_code($staff_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `activation_code` FROM `user` WHERE `user_id` = :user_id:";

        $query = $db->query($sql, [
            'user_id' => $staff_id
        ]);
        if(!empty($query->getRowArray())){
            return $query->getRowArray();
        }else{
            return array();
        }

    }

    public function update_activation_status($staff_id, $coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `user` SET `isActivated` = 1, `creator_id`=:coordinator_id: WHERE `user_id` = :user_id:";

        $query = $db->query($sql, [
            'user_id' => $staff_id,
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

        $sql = "SELECT `user_id`, `username` FROM `user` WHERE `email` = :email: AND is_email_activated = 1 AND `user_type` = 'Staff'";

        $query = $db->query($sql, [
            'email' => $email
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

    public function account_detail($user_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT * FROM `user` WHERE `user_id` = :user_id:";

        $query = $db->query($sql, [
            'user_id' => $user_id
        ]);

        return $query->getRowArray();
    }
    //dashboard storytelling
    public function count_record($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(oi.oscya_id) AS totalRecord FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE om.user_id = :staff_id:;";

        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRow();
    }

    public function count_male($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(oi.gender) AS Gender FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE oi.gender = 'male' AND om.user_id = :staff_id:;";

        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRow();
    }

    public function count_female($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(oi.gender) AS Gender FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE oi.gender = 'female' AND om.user_id = :staff_id:;";

        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRow();
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

    public function count_educ_attainment($staff_id)
    {
        $db = \Config\Database::connect();
        $count_kinder = "SELECT COUNT(`educ_attainment`) as kinder FROM `oscya_mapping` WHERE `educ_attainment` = 'kinder' AND user_id = :staff_id:";
        $count_g1 = "SELECT COUNT(`educ_attainment`) as g1 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 1' AND user_id = :staff_id:";
        $count_g2 = "SELECT COUNT(`educ_attainment`) as g2 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 2' AND user_id = :staff_id:";
        $count_g3 = "SELECT COUNT(`educ_attainment`) as g3 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 3' AND user_id = :staff_id:";
        $count_g4 = "SELECT COUNT(`educ_attainment`) as g4 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 4' AND user_id = :staff_id:";
        $count_g5 = "SELECT COUNT(`educ_attainment`) as g5 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 5' AND user_id = :staff_id:";
        $count_g6 = "SELECT COUNT(`educ_attainment`) as g6 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 6' AND user_id = :staff_id:";
        $count_g7 = "SELECT COUNT(`educ_attainment`) as g7 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 7' AND user_id = :staff_id:";
        $count_g8 = "SELECT COUNT(`educ_attainment`) as g8 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 8' AND user_id = :staff_id:";
        $count_g9 = "SELECT COUNT(`educ_attainment`) as g9 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 9' AND user_id = :staff_id:";
        $count_g10 = "SELECT COUNT(`educ_attainment`) as g10 FROM `oscya_mapping` WHERE `educ_attainment` = 'GRADE 10' AND user_id = :staff_id:";
        
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

    public function show_record($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.id AS id, oi.oscya_id AS oscya_id, om.user_id AS user_id, CONCAT(oi.lastname,', ', oi.firstname, ', ', oi.middlename, ' ', oi.extension) AS fullname FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id WHERE om.user_id = :staff_id: LIMIT 10;";

        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getResultArray();
    }

    public function view_oscya($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.id, oi.oscya_id, om.user_id, CONCAT(oi.lastname,', ', oi.firstname, ' ', oi.middlename , ' ', oi.extension) AS name, oi.fullname, oi.birthdate, oi.age, oi.gender, occ.is_counseled, oi.civil_status FROM `oscya_info` oi INNER JOIN `oscya_mapping` om ON oi.oscya_id = om.oscya_id INNER JOIN `oscya_counseling` occ ON oi.oscya_id = occ.oscya_id WHERE om.user_id = :staff_id:";
        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getResultArray();
    }

    public function view_all_oscya($barangay)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.id, oi.oscya_id, om.user_id, CONCAT(oi.lastname,', ', oi.firstname, ' ', oi.middlename , ' ', oi.extension) AS name, oi.fullname , oi.birthdate, oi.age, oi.gender, occ.is_counseled, oi.civil_status FROM `oscya_info` oi INNER JOIN `oscya_mapping` om ON oi.oscya_id = om.oscya_id INNER JOIN `oscya_contact` oc ON oc.oscya_id = om.oscya_id INNER JOIN `oscya_counseling` occ ON oi.oscya_id = occ.oscya_id WHERE oc.brgy = :barangay:";
        $query = $db->query($sql, ['barangay' => $barangay]);

        return $query->getResultArray();
    }

    public function count_all_record($barangay)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(oi.oscya_id) AS totalRecord FROM oscya_info AS oi INNER JOIN oscya_mapping AS om ON oi.oscya_id = om.oscya_id INNER JOIN oscya_contact AS oc ON oi.oscya_id = oc.oscya_id WHERE oc.brgy = :barangay:;";

        $query = $db->query($sql, ['barangay' => $barangay]);

        return $query->getRow();
    }

    public function search_oscya($staff_id, $oscya_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT oi.id, oi.oscya_id, om.user_id, CONCAT(oi.lastname,', ', oi.firstname, ' ', oi.middlename , ' ', oi.extension) AS fullname, oi.birthdate, oi.age, oi.gender, oi.civil_status FROM `oscya_info` oi INNER JOIN `oscya_mapping` om ON oi.oscya_id = om.oscya_id WHERE om.user_id=:staff_id: AND oi.oscya_id LIKE :oscya_id:";
        $query = $db->query($sql, [
            'staff_id' => $staff_id,
            'oscya_id' => $oscya_id . '%'
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

    public function update_personal_info($oscya_id, $lastname, $firstname, $middlename, $extension, $fullname, $birthdate, $age, $gender, $civil_status, $religion)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `oscya_info` SET `lastname` = :lastname:, `firstname` = :firstname:, `middlename` = :middlename:, `extension` = :extension:, `fullname` = :fullname:, `birthdate` = :birthdate:, `age` = :age:, `gender` = :gender:, `civil_status` = :civil_status:, `religion` = :religion: WHERE  `oscya_id` = :oscya_id:";
        $query = $db->query($sql, [
            'oscya_id' => $oscya_id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'extension' => $extension,
            'fullname' => $fullname,
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

    public function staff_account($staff_id)
    {
        $db =\Config\Database::connect();

        $sql = "SELECT `id`, `creator_id`, `user_id`, `username`, `password`, `user_type`, `status` FROM `user` WHERE `user_id` = :staff_id:";

        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRowArray();
    }

    public function staff_info($staff_id)
    {
        $db =\Config\Database::connect();

        $sql = "SELECT `id`, `user_id`, `lastname`, `firstname`, `middlename`, `suffix`, `birth`, `age`, `gender`, `civil_status`, `religion`, `image` FROM `info` WHERE `user_id` = :staff_id:";

        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRowArray();

    }

    public function staff_contact($staff_id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT `id`, `user_id`, `email`, `facebook`, `contact_no`, `street`, `barangay`, `district`, `zip_code`, `city` FROM `contact` WHERE `user_id` = :staff_id:;";

        $query = $db->query($sql, ['staff_id' => $staff_id]);

        return $query->getRowArray();

    }

    public function select_brgy_profile($coordinator_id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `user_id`, `barangay`, `about`, `address`, `contact_no`, `from`, `to`,  `email`, `facebook_page`, `official_web`, `logo`, `cover_photo`, `img_1`, `img_2` FROM `barangay` WHERE `user_id` = :coordinator_id:";
        $query = $db->query($sql, [
            'coordinator_id' => $coordinator_id
        ]);

        return $query->getRowArray();
    }

    public function edit_account($staff_id, $username, $password)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `user` SET `username`=:username:,`password`=:password: WHERE `user_id` = :staff_id:;";

        $query = $db->query($sql, [
            'username' => $username,
            'password' => $password,
            'staff_id' => $staff_id
        ]);

        if($query == true){
            return true;
        }else{
            return false;
        }
    }

    public function edit_contact($staff_id, $email, $contact_no, $facebook, $street, $barangay, $district, $zip_code,  $city)
    {
        $db = \Config\Database::connect();
        $sql = " UPDATE `contact` SET `email`=:email:,`facebook`=:facebook:,`contact_no`=:contact_no:,`street`=:street:,`barangay`=:barangay:,`district`=:district:,`zip_code`=:zip_code:,`city`=:city: WHERE `user_id`=:staff_id:";

        $query = $db->query($sql, [
            'staff_id' => $staff_id,
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

    public function edit_info($staff_id, $lastname, $firstname, $middlename, $suffix, $birth, $age, $gender, $civil_status, $religion)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `info` SET `lastname`=:lastname:,`firstname`=:firstname:,`middlename`=:middlename:,`suffix`=:suffix:,`birth`=:birth:,`age`=:age:,`gender`=:gender:,`civil_status`=:civil_status:,`religion`=:religion: WHERE `user_id`=:staff_id:";

        $query = $db->query($sql, [
            'staff_id' => $staff_id,
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

    public function edit_profile_pic($staff_id, $image)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `info` SET `image`= :image: WHERE `user_id`= :staff_id:";
         $query = $db->query($sql, [
            'staff_id' => $staff_id,
            'image' => $image
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }

}
