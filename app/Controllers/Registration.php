<?php

namespace App\Controllers;
use App\Models\RegistrationModel;

class Registration extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'id']);
    }

    protected function generate_sid($registrationModel)
    {
        $numLength = 2;
        $strLength = 4;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $s_id = 'SID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
        $checkKey = $registrationModel->check_sid($s_id);

        while ($checkKey == true) {
            $s_id = 'SID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
            $checkKey = $registrationModel->check_sid($s_id);
        }
        return $s_id;
    }

    public function email_temp($data)
    {
        return view('registration/email_temp', $data);
    }

    public function generate_brgy_staff_code($registrationModel)
    {
        $num_length = 3;
        $str_length = 3;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
        $checkCode = $registrationModel->select_brgy_staff_code($activation_code);

        while ($checkCode == true) {
            $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
            $checkCode = $registrationModel->select_brgy_staff_code($activation_code);
        }

        return $activation_code;
        
    }

    public function register_brgy_staff()
    {
        if($this->request->getMethod() == 'post'){

            
            $registration = new RegistrationModel();
            $brgy_staff_id = $this->generate_sid($registration);
            $activation_code = $this->generate_brgy_staff_code($registration);
            $lastname = $this->request->getPost('lastname');
            $firstname = $this->request->getPost('firstname');
            $district = $this->request->getPost('district');
            $barangay = $this->request->getPost('barangay');
            $brgy_staff_email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
                
            $valid_id = $this->request->getFile('valid_id');

            
            $email = \Config\Services::email();

            $email->setFrom('alsecollaboration@alsgov.com', 'Online Literacy Mapping Platform');
            $email->setTo($brgy_staff_email);
            $email->setSubject('Email Test');

            $data = [
                'header' => ['content' => 'Brgy. Staff Registration' ],
                'sub_header' =>['content' => 'ALS Coordinator of Barangay ' . $barangay . ' will evaluate your registration information. Wait for further instructions.' ],
                'message' => ['content' => 'Do not share your password'],
                'credential' => ['username' => $username, 'password' => $password],
                'links' => ['link_1' => base_url(), 'link_2' => '']
            ];

            $email->setMessage($this->email_temp($data));
            if(empty($brgy_staff_email)){
                return redirect()->to('registration/brgy_staff')->with('fail', 'Email Address Required');
            }else if($email->send()){
                if($valid_id->isValid() && !$valid_id->hasMoved()){
                    if($valid_id->getSize() > 20971520){
                        return redirect()->to('registration/brgy_staff')->with('fail', 'File should be less than 20 megabyte');
                    }else{
                        $new_id_name = $valid_id->getRandomName();
                        $brgy_id_loc = $brgy_staff_id . '/' . $new_id_name;
                        if(!is_dir(FCPATH . 'uploads/assets/profiles/' . $brgy_staff_id)){
                            mkdir(FCPATH . 'uploads/assets/profiles/' . $brgy_staff_id);
                            $isMoved = $valid_id->move( FCPATH . 'uploads/assets/profiles/' . $brgy_staff_id, $new_id_name);
                            if($isMoved == true){
                                $isInserted = $registration->insert_brgy_staff($brgy_staff_id, $activation_code, $lastname, $firstname, $district, $barangay, $brgy_staff_email, $username, password_hash($password, PASSWORD_BCRYPT), $brgy_id_loc);
                                if($isInserted == true){
                                    return redirect()->to('registration/brgy_staff')->with('success', 'Registered Successfully, check your email');
                                }else{
                                    return redirect()->to('registration/brgy_staff')->with('fail', 'Failed to register');
                                }
                            }else{
                                return redirect()->to('registration/brgy_staff')->with('fail', 'Failed to save your ID');
                            }
                        }else{
                            $isMoved = $valid_id->move( FCPATH . 'uploads/assets/profiles/' . $brgy_staff_id);
                            if($isMoved == true){
                                $isInserted = $registration->insert_brgy_staff($brgy_staff_id, $activation_code, $lastname, $firstname, $district, $barangay, $brgy_staff_email, $username, password_hash($password, PASSWORD_BCRYPT), $brgy_id_loc);
                                if($isInserted == true){
                                    return redirect()->to('registration/brgy_staff')->with('success', 'Registered Successfully, check your email');
                                }else{
                                    return redirect()->to('registration/brgy_staff')->with('fail', 'Failed to register');
                                }
                            }else{
                                return redirect()->to('registration/brgy_staff')->with('fail', 'Failed to save your ID');
                            }
                        }
                    }
                }else{
                    return redirect()->to('registration/brgy_staff')->with('fail', 'ID required');
                }
            }else{
                return redirect()->to('registration/brgy_staff')->with('fail', 'Invalid Email Address');
            }
        }else{
            echo view('registration/register_brgy_staff');
        }
    }

    protected function generate_cid($registrationModel)
    {
        $numLength = 2;
        $strLength = 4;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $c_id = 'CID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
        $checkKey = $registrationModel->check_cid($c_id);

        while ($checkKey == true) {
            $c_id = 'CID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
            $checkKey = $registrationModel->check_cid($c_id);
        }
        return $c_id;
    }

    public function generate_brgy_coord_code($registrationModel)
    {
        $num_length = 3;
        $str_length = 3;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
        $checkCode = $registrationModel->select_brgy_activation_code($activation_code);

        while ($checkCode == true) {
            $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
            $checkCode = $registrationModel->select_brgy_activation_code($activation_code);
        }

        return $activation_code;
        
    }

    public function register_brgy_coord()
    {
        if($this->request->getMethod() == 'post'){
            $registration = new RegistrationModel();
            $brgy_coordinator_id = $this->generate_cid($registration);
            $activation_code = $this->generate_brgy_coord_code($registration);
            $lastname = $this->request->getPost('lastname');
            $firstname = $this->request->getPost('firstname');
            $district = $this->request->getPost('district');
            $barangay = $this->request->getPost('barangay');
            $brgy_coord_email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
                
            $valid_id = $this->request->getFile('valid_id');
            $selectExistingBarangay = $registration->check_barangay($barangay);
            if($selectExistingBarangay == true){
                return redirect()->to('registration/brgy_coordinator')->with('fail', 'Barangay Coordinator Already Exists');
            }else{
                $email = \Config\Services::email();

                $email->setFrom('alsecollaboration@alsgov.com', 'Online Literacy Mapping Platform');
                $email->setTo($brgy_coord_email);
                $email->setSubject('Email Test');

                $data = [
                    'header' => ['content' => 'Brgy. Coordinator Registration' ],
                    'sub_header' =>['content' => 'The Administrator of District ' . $district . ' will evaluate your registration information. Wait for further instructions.' ],
                    'message' => ['content' => 'Do not share your password'],
                    'credential' => ['username' => $username, 'password' => $password],
                    'links' => ['link_1' => base_url(), 'link_2' => '']
                ];
    
                $email->setMessage($this->email_temp($data));
                if(empty($brgy_coord_email)){
                    return redirect()->to('registration/brgy_coordinator')->with('fail', 'Email Address Required');
                }else if($email->send()){
                    if($valid_id->isValid() && !$valid_id->hasMoved()){
                        if($valid_id->getSize() > 20971520){
                            return redirect()->to('registration/brgy_coordinator')->with('fail', 'File should be less than 20 megabyte');
                        }else{
                            $new_id_name = $valid_id->getRandomName();
                            $brgy_id_loc = $brgy_coordinator_id . '/' . $new_id_name;
                            if(!is_dir( FCPATH . 'uploads/assets/profiles/' . $brgy_coordinator_id )){
                                mkdir( FCPATH . 'uploads/assets/profiles/' . $brgy_coordinator_id );
                                $isMoved = $valid_id->move( FCPATH . 'uploads/assets/profiles/' . $brgy_coordinator_id, $new_id_name);
                                if($isMoved == true){
                                    $isInserted = $registration->insert_brgy_coordinator($brgy_coordinator_id, $activation_code, $lastname, $firstname, $district, $barangay, $brgy_coord_email, $username, password_hash($password, PASSWORD_BCRYPT), $brgy_id_loc);
                                    if($isInserted == true){
                                        return redirect()->to('registration/brgy_coordinator')->with('success', 'Registered Successfully, check your email');
                                    }else{
                                        return redirect()->to('registration/brgy_coordinator')->with('fail', 'Failed to register');
                                    }
                                }else{
                                    return redirect()->to('registration/brgy_coordinator')->with('fail', 'Failed to save your ID');
                                }
                            }else{
                                $isMoved = $valid_id->move( FCPATH . 'uploads/assets/profiles/' . $brgy_coordinator_id);
                                if($isMoved == true){
                                    $isInserted = $registration->insert_brgy_coordinator($brgy_coordinator_id, $activation_code, $lastname, $firstname, $district, $barangay, $brgy_staff_email, $username, password_hash($password, PASSWORD_BCRYPT), $brgy_id_loc);
                                    if($isInserted == true){
                                        return redirect()->to('registration/brgy_coordinator')->with('success', 'Registered Successfully, check your email');
                                    }else{
                                        return redirect()->to('registration/brgy_coordinator')->with('fail', 'Failed to register');
                                    }
                                }else{
                                    return redirect()->to('registration/brgy_coordinator')->with('fail', 'Failed to save your ID');
                                }
                            }
                        }
                    }else{
                        return redirect()->to('registration/brgy_coordinator')->with('fail', 'ID required');
                    }
                }else{
                    return redirect()->to('registration/brgy_coordinator')->with('fail', 'Invalid Email Address');
                }
            }
        }else{
            echo view('registration/register_brgy_coord');
        }
    }

    protected function generate_acid($registerModel)
    {
        $numLength = 2;
        $strLength = 4;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $c_id = 'ACID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
        $checkKey = $registerModel->check_acid($c_id);

        while ($checkKey == true) {
            $c_id = 'ACID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
            $checkKey = $registerModel->check_acid($c_id);
        }
        return $c_id;
    }

    public function register_als_coord()
    {
        return view('registration/register_als_coord');
    }

    public function generate_als_activation_code($registrationModel)
    {
        $num_length = 3;
        $str_length = 3;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
        $checkCode = $registrationModel->select_activation_code($activation_code);

        while ($checkCode == true) {
            $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
            $checkCode = $registrationModel->select_activation_code($activation_code);
        }

        return $activation_code;
        
    }

    public function save_als_coord()
    {
        if($this->request->getMethod() == 'post'){

            $registration = new RegistrationModel();

            $als_coordinator_id = $this->generate_acid($registration);
            $activation_code = $this->generate_als_activation_code($registration);
            $lastname = $this->request->getPost('lastname');
            $firstname = $this->request->getPost('firstname');
            $district = $this->request->getPost('district');
            $als_coord_email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
                
            $valid_id = $this->request->getFile('valid_id');

            $email = \Config\Services::email();

            $email->setFrom('alsecollaboration@alsgov.com', 'System');
            $email->setTo($als_coord_email);
            $email->setSubject('Email Test');

            $message ='';
            $message .= '<h1 style="font-weight:bold"> ALS Coordinator Registration</h1>';
            $message .= '<h2 style="font-weight:bold">Administrator will evaluate your registration information. Wait for further instructions.</h2>';
            $message .= '<span style="color:red;font-size:16px;">Do not share your password</span><br>';
            $message .= '<span style="font-size:16px;">Username: ' . $username . '</span><br>' ;
            $message .= '<span style="font-size:16px;">Password: ' . $password . '</span>' ;

            $email->setMessage($message);

            if(empty($als_coord_email)){
                return redirect()->to('registration/als_coordinator')->with('fail', 'Email Address Required');
            }else if($email->send()){
                if($valid_id->isValid() && !$valid_id->hasMoved()){
                    if($valid_id->getSize() > 20971520){
                        return redirect()->to('registration/als_coordinator')->with('fail', 'File should be less than 20 megabyte');
                    }else{
                        $brgy_id_loc = $als_coordinator_id . '/' . $valid_id->getName();
                        if(!is_dir( FCPATH . 'uploads\\assets\\profiles\\' . $als_coordinator_id )){
                            mkdir( FCPATH . 'uploads\\assets\\profiles\\' . $als_coordinator_id );
                            $isMoved = $valid_id->move( FCPATH . 'uploads\\assets\\profiles\\' . $als_coordinator_id );
                            if($isMoved == true){
                                $isInserted = $registration->insert_als_coordinator($als_coordinator_id, $activation_code, $lastname, $firstname, $district, $als_coord_email, $username, password_hash($password, PASSWORD_BCRYPT), $brgy_id_loc);
                                if($isInserted == true){
                                    return redirect()->to('registration/als_coordinator')->with('success', 'Registered Successfully, check your email');
                                }else{
                                    return redirect()->to('registration/als_coordinator')->with('fail', 'Failed to register');
                                }
                            }else{
                                return redirect()->to('registration/als_coordinator')->with('fail', 'Failed to save your ID');
                            }
                        }else{
                            $isMoved = $valid_id->move( FCPATH . 'uploads\\assets\\profiles\\' . $als_coordinator_id );
                            if($isMoved == true){
                                $isInserted = $registration->insert_als_coordinator($als_coordinator_id, $activation_code, $lastname, $firstname, $district, $als_coord_email, $username, password_hash($password, PASSWORD_BCRYPT), $brgy_id_loc);
                                if($isInserted == true){
                                    return redirect()->to('registration/als_coordinator')->with('success', 'Registered Successfully, check your email');
                                }else{
                                    return redirect()->to('registration/als_coordinator')->with('fail', 'Failed to register');
                                }
                            }else{
                                return redirect()->to('registration/als_coordinator')->with('fail', 'Failed to save your ID');
                            }
                        }
                    }
                }else{
                    return redirect()->to('registration/als_coordinator')->with('fail', 'ID required');
                }
            }else{
                return redirect()->to('registration/als_coordinator')->with('fail', 'Invalid Email Address');
            }
            
        }else{
            return redirect()->to('registration/als_coordinator');
        }
    }

    protected function generate_tid($registrationModel)
    {
        $numLength = 2;
        $strLength = 4;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $t_id = 'TID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
        $checkKey = $registrationModel->check_tid($t_id);

        while ($checkKey == true) {
            $t_id = 'TID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
            $checkKey = $registrationModel->check_tid($t_id);
        }
        return $t_id;
    }

    public function generate_als_teacher_activation_code($registrationModel)
    {
        $num_length = 3;
        $str_length = 3;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
        $checkCode = $registrationModel->select_als_teacher_code($activation_code);

        while ($checkCode == true) {
            $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
            $checkCode = $registrationModel->select_als_teacher_code($activation_code);
        }

        return $activation_code;
        
    }

    public function register_teacher()
    {
        if($this->request->getMethod()=='post'){
            $validation = $this->validate([
                'lastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'lastname Required'
                    ]
                ],
                'firstname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Firstname Required'
                    ]
                ],
                'district' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'District Required'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email Required'
                    ]
                ],
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Required'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Required'
                    ]
                ],
            ]);
            if(!$validation){
                echo view('registration/als_teacher',['validation' => $this->validator]);
            }else{
                $registration = new RegistrationModel();

                $als_teacher_id = $this->generate_tid($registration);
                $activation_code = $this->generate_als_teacher_activation_code($registration);
                $lastname = $this->request->getPost('lastname');
                $firstname = $this->request->getPost('firstname');
                $district = $this->request->getPost('district');
                $als_teacher_email = $this->request->getPost('email');
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                    
                $valid_id = $this->request->getFile('valid_id');

                $email = \Config\Services::email();

                $email->setFrom('alsecollaboration@alsgov.com', 'System');
                $email->setTo($als_teacher_email);
                $email->setSubject('Email Test');
                
                $data = [
                    'header' => ['content' => 'ALS Teacher Registration' ],
                    'sub_header' =>['content' => 'The Administrator of District ' . $district . ' will evaluate your registration information. Wait for further instructions.' ],
                    'message' => ['content' => 'Do not share your password'],
                    'credential' => ['username' => $username, 'password' => $password],
                    'links' => ['link_1' => base_url(), 'link_2' => '']
                ];
    
                $email->setMessage($this->email_temp($data));

                if(empty($als_teacher_email)){
                    return redirect()->to('registration/als_teacher')->with('fail', 'Email Address Required');
                }else if($email->send()){
                    if($valid_id->isValid() && !$valid_id->hasMoved()){
                        if($valid_id->getSize() > 20971520){
                            return redirect()->to('registration/als_teacher')->with('fail', 'File should be less than 20 megabyte');
                        }else{
                            $new_id_name = $valid_id->getRandomName();
                            $brgy_id_loc = $als_teacher_id . '/' . $new_id_name;
                            if(!is_dir( FCPATH . 'uploads/assets/profiles/' . $als_teacher_id )){
                                mkdir( FCPATH . 'uploads/assets/profiles/' . $als_teacher_id );
                                $isMoved = $valid_id->move( FCPATH . 'uploads/assets/profiles/' . $als_teacher_id, $new_id_name );
                                if($isMoved == true){
                                    $isInserted = $registration->insert_als_teacher($als_teacher_id, $activation_code, $lastname, $firstname, $district, $als_teacher_email, $username, password_hash($password, PASSWORD_BCRYPT), $brgy_id_loc);
                                    if($isInserted == true){
                                        return redirect()->to('registration/als_teacher')->with('success', 'Registered Successfully, check your email');
                                    }else{
                                        return redirect()->to('registration/als_teacher')->with('fail', 'Failed to register');
                                    }
                                }else{
                                    return redirect()->to('registration/als_teacher')->with('fail', 'Failed to save your ID');
                                }
                            }else{
                                $isMoved = $valid_id->move( FCPATH . 'uploads/assets/profiles/' . $als_teacher_id );
                                if($isMoved == true){
                                    $isInserted = $registration->insert_als_teacher($als_teacher_id, $activation_code, $lastname, $firstname, $district, $als_teacher_email, $username, password_hash($password, PASSWORD_BCRYPT), $brgy_id_loc);
                                    if($isInserted == true){
                                        return redirect()->to('registration/als_teacher')->with('success', 'Registered Successfully, check your email');
                                    }else{
                                        return redirect()->to('registration/als_teacher')->with('fail', 'Failed to register');
                                    }
                                }else{
                                    return redirect()->to('registration/als_teacher')->with('fail', 'Failed to save your ID');
                                }
                            }
                        }
                    }else{
                        return redirect()->to('registration/als_teacher')->with('fail', 'ID required');
                    }
                }else{
                    return redirect()->to('registration/als_teacher')->with('fail', 'Invalid Email Address');
                }
            }
        }else{
            echo view('registration/register_als_teacher');
        }
    }

    public function update_id($staff_id)
    {
        if($this->request->getMethod() == 'post'){
            $registrationModel = new RegistrationModel();
            $valid_id = $this->request->getFile('valid_id');
            if($valid_id->isValid() && !$valid_id->hasMoved()){
                if($valid_id->getSize() > 20971520){
                    return redirect()->to('registration/als_teacher')->with('fail', 'File should be less than 20 megabyte');
                }else{
                    $brgy_id_loc = $staff_id . '/' . $valid_id->getName();
                    $isMoved = $valid_id->move(FCPATH . "uploads/assets/profiles/" .  $staff_id);
                    if($isMoved == true){
                        $isUpdated = $registrationModel->update_id($staff_id, $brgy_id_loc);
                        if($isUpdated == true){
                            return redirect()->to('registration/update_id' . '/' . $staff_id)->with('success', 'Valid ID updated');
                        }else{
                            return redirect()->to('registration/update_id' . '/' . $staff_id)->with('fail', 'Failed to update Valid ID');
                        }
                    }else{
                        return redirect()->to('registration/update_id' . '/' . $staff_id)->with('fail', 'Failed to update Valid ID');
                    }
                }
            }else{
                return redirect()->to('registration/update_id' . '/' . $staff_id)->with('fail', 'Failed to update Valid ID');
            }
        }else{
            $data = [
                'staff' => ['id' => $staff_id]
            ];
            return view('registration/update_id', $data);
        }
        
    }

    public function update_coordinator_id($coordinator_id)
    {
        if($this->request->getMethod() == 'post'){
            $registrationModel = new RegistrationModel();
            $valid_id = $this->request->getFile('valid_id');
            if($valid_id->isValid() && !$valid_id->hasMoved()){
                if($valid_id->getSize() > 20971520){
                    return redirect()->to('registration/als_teacher')->with('fail', 'File should be less than 20 megabyte');
                }else{
                    $brgy_id_loc = $coordinator_id . '/' . $valid_id->getName();
                    $isMoved = $valid_id->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id);
                    if($isMoved == true){
                        $isUpdated = $registrationModel->update_coordinator_credential($coordinator_id, $brgy_id_loc);
                        if($isUpdated == true){
                            return redirect()->to('registration/update_coordinator_id' . '/' . $coordinator_id)->with('success', 'Valid ID updated');
                        }else{
                            return redirect()->to('registration/update_coordinator_id' . '/' . $coordinator_id)->with('fail', 'Failed to update Valid ID');
                        }
                    }else{
                        return redirect()->to('registration/update_coordinator_id' . '/' . $coordinator_id)->with('fail', 'Failed to update Valid ID');
                    }
                }
            }else{
                return redirect()->to('registration/update_coordinator_id' . '/' . $coordinator_id)->with('fail', 'Failed to update Valid ID');
            }
        }else{
            $data = [
                'coordinator' => ['id' => $coordinator_id]
            ];
            return view('registration/update_coordinator_id', $data);
        }
    }

    public function update_teacher_id($teacher_id)
    {
        if($this->request->getMethod() == 'post'){
            $registrationModel = new RegistrationModel();
            $valid_id = $this->request->getFile('valid_id');
            if($valid_id->isValid() && !$valid_id->hasMoved()){
                if($valid_id->getSize() > 20971520){
                    return redirect()->to('registration/als_teacher')->with('fail', 'File should be less than 20 megabyte');
                }else{
                    $brgy_id_loc = $teacher_id . '/' . $valid_id->getName();
                    $isMoved = $valid_id->move(FCPATH . "uploads/assets/profiles/" .  $teacher_id);
                    if($isMoved == true){
                        $isUpdated = $registrationModel->update_teacher_credential($teacher_id, $brgy_id_loc);
                        if($isUpdated == true){
                            return redirect()->to('registration/update_teacher_id' . '/' . $teacher_id)->with('success', 'Valid ID updated');
                        }else{
                            return redirect()->to('registration/update_teacher_id' . '/' . $teacher_id)->with('fail', 'Failed to update Valid ID');
                        }
                    }else{
                        return redirect()->to('registration/update_teacher_id' . '/' . $teacher_id)->with('fail', 'Failed to update Valid ID');
                    }
                }
            }else{
                return redirect()->to('registration/update_coordinator_id' . '/' . $teacher_id)->with('fail', 'Failed to update Valid ID');
            }
        }else{
            $data = [
                'teacher' => ['id' => $teacher_id]
            ];
            return view('registration/update_teacher_id', $data);
        }
    }
}

