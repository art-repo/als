<?php

    namespace App\Controllers;

    use App\Models\AlscoordinatorModel;
    use App\Models\CoordinatorModel;
    use App\Models\StaffModel;
    use App\Models\OscyaModel;
    use App\Models\UserModel;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use \CodeIgniter\View\Table;
    class Alscoordinator extends BaseController
    {

        public function __construct()
        {   
            helper(['url', 'form', 'id', 'date']);
        }

        protected function generate_sid($admin)
        {
            $numLength = 2;
                $strLength = 4;
                $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $num = '0123456789';

                $staff_id = 'CID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
                $checkKey = $admin->check_cid($staff_id);

                while ($checkKey == true) {
                    $staff_id = 'CID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
                    $checkKey = $admin->check_cid($staff_id);
                }
                return $staff_id;
        }

        public function index()
        {
            if($this->request->getMethod()=='post'){
                $session = \Config\Services::session();
                $validation = $this->validate([
                    'username' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Username Required'
                        ]
                    ],
                    'password' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Password Required',
                            'invalid_password' => 'Password Does not match'
                        ]
                    ]
                ]);
                if(!$validation){
                    //redirect to login with validation messages
                   
                    echo view('alscoordinator/login',['validation' => $this->validator]);
    
                }else{
                    //perform authentication
    
                    $username =  $this->request->getPost('username');
                    $password = $this->request->getPost('password');
    
                    $als_coord = new AlscoordinatorModel();
    
                    $als_coord_data = $als_coord->alscoord_login($username, $password);
    
                    
                    if(empty($als_coord_data)){
                        
                        return redirect()->to('alscoordinator/login')->with('fail', 'Invalid username or password');
                    }else{
                        // echo $als_coord_data['is_evaluated'];
                        if($als_coord_data['isActivated'] == 0 || $als_coord_data['is_evaluated'] == 0){
                            return redirect()->to('alscoordinator/login')->with('fail', 'Your account is must be activated and evaluated');
                        }
                        if($als_coord_data['isActivated'] == 1 && $als_coord_data['is_evaluated'] == 1){
                            $sessionData = [
                                'user_id' => $als_coord_data['user_id'],
                                'username' => $als_coord_data['username'],
                            ];
                            $als_coord->update_status($als_coord_data['user_id'], 1);
                            $session->set('als_coord_id', $sessionData['user_id']);
                            return redirect()->to(base_url('alscoordinator/dashboard'));
                        } 
                    }
                }
            }else{
                echo view('alscoordinator/login');
            }
        }

        public function forgot_password()
        {
            if($this->request->getMethod() == 'post'){
                $als_coord = new AlscoordinatorModel();
                $als_coord_email = $this->request->getPost('email');
                $user = $als_coord->check_email($als_coord_email);
                if(!empty($user)){
                    $email = \Config\Services::email();

                    $email->setFrom('alsecollaboration@alsgov.com', 'System');
                    $email->setTo($als_coord_email);

                    $email->setSubject('Reset Password');
                    $message = '';
                    $message .= '<h1 style="font-weight:bold;">Reset your ALS Coordinator Password</h1>';
                    $message .= '<a href="' . base_url('alscoordinator/reset_password' . '/' . $user['user_id']) . '">Reset</a>';
                    $email->setMessage($message);

                    $email->send();
                    echo view('alscoordinator/reset_message', $user);
                }else{
                    $data = [
                        'error' => 'Invalid Email'
                    ];
                    echo view('alscoordinator/forgot_password', $data);
                }
            }else{
                echo view('alscoordinator/forgot_password');
            }
        }
        
        public function reset_password($user_id)
        {
            if($this->request->getMethod() == 'post'){
                $new_pass = $this->request->getPost('new_pass');
                $als_coord = new AlscoordinatorModel(); 
                $accData = $als_coord->account($user_id);

                if(!empty($accData)){
                    $isUpdated = $als_coord->update_password($user_id, password_hash($new_pass, PASSWORD_BCRYPT));
                    if($isUpdated == true){
                        $data = [
                            'class' => 'alert alert-success',
                            'message' => 'Password updated successfully',
                            'link' => '<a href="' . base_url('alscoordinator/login') . '" class="btn btn-blue-3 fw-bold">Sign in</a>'
                        ];
                        echo view('alscoordinator/reset_message', $data);
                    }else{
                        $data = [
                            'class' => 'alert alert-danger',
                            'message' => 'Failed to update password',
                            'link' => '<a href="' . base_url('alscoordinator/reset_password') . '" class="btn btn-blue-3 fw-bold">Sign in</a>'
                        ];
                        echo view('alscoordinator/reset_password', $data);
                    }
                }

            }else{
                $als_coord = new AlscoordinatorModel(); 
                $accData = $als_coord->account($user_id);
                echo view('alscoordinator/reset_password', $accData);
            }
        }
        
        public function dashboard()
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }

            $alscoordinatorModel = new AlscoordinatorModel();

            $als_coord_id = $session->get('als_coord_id');
            $district = $alscoordinatorModel->select_als_coord_info($als_coord_id);
            $count = $alscoordinatorModel->count_all_users($district['district']);
            $data = [
                'coordinator' => $alscoordinatorModel->select_brgy_coord($als_coord_id),
                'info' => $alscoordinatorModel->select_als_coord_info($als_coord_id),
                // 'info' => $alscoordinatorModel->select_als_coord_info($als_coord_id),
                'coord_count' => $count['coord_count_res']['coordinator_count'],
                'staff' => $count['coord_staff_res']['staff_count'],
                'teacher' => $count['coord_teacher_res']['teacher_count'],
            ];

            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/dashboard', $data);
            echo view('alscoordinator/templates/footer', $data);
            
            
        }

        public function barangay()
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            
            $data = [
                'barangays' => $admin->select_created_brgy($als_coord_id),
                'info' => $admin->select_als_coord_info($als_coord_id),
                'count_brgy' => $admin->count_brgy($als_coord_id),
                'count_reg' => $admin->count_reg($als_coord_dist)
            ];

            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/barangay', $data);
            echo view('alscoordinator/templates/footer', $data);
        }

        public function barangay_settings($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                'brgy_info' => $admin->select_barangay_info($coordinator_id),
                'coord_acc' => $admin->select_coord_account($coordinator_id),
                'teachers' => $admin->select_all_teacher($als_coord_id),
                'staffs' => $admin->select_all_staff($coordinator_id),
                'facilities' => $admin->select_all_facility($coordinator_id)
            ];

            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/barangay_setting', $data);
            echo view('alscoordinator/templates/footer', $data);
        }

        public function edit_logo($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            $data = [
                'info' => $als_coord_info,
            ];


            $file_ext = array('jpg', 'png', 'gif', 'svg');
            if($this->request->getMethod()=="post"){

                $logo = $this->request->getFile('logo');
                if($logo->isValid() && !$logo->hasMoved()){
                    if(!empty($logo->getFilename())){
                        if($logo->getSize() <= 1048576){
                            if(in_array($logo->guessExtension(), $file_ext)){
                                echo "edit logo";
                                $logoName = $logo->getRandomName();
                                $logo->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $logoName );
                                $logo_loc = $coordinator_id . '/' . $logoName;
                
                                $isInserted = $admin->edit_barangay_logo($coordinator_id, $logo_loc);
                                if ($isInserted == true) {
                                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'Logo Updated');
                                }else{
                                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to update logo');
                                }
                            
                            }else{
                                return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'File should be in jpg or png format');
                            }
                        }else{
                            return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Image should be lessthan 10 megabyte');
                        }
                    }else{
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Image Required');
                    }
                }else{
                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to change logo');
                }
            }else{
                return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'Failed to update profile picture');
            }
        }

        public function edit_cover_photo($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            $data = [
                'info' => $als_coord_info,
            ];


            $file_ext = array('jpg', 'png', 'gif', 'svg');
            if($this->request->getMethod()=="post"){

                $cover_photo = $this->request->getFile('cover_photo');
                if($cover_photo->isValid() && !$cover_photo->hasMoved()){
                    if(!empty($cover_photo->getFilename())){
                        if($cover_photo->getSize() <= 1048576){
                            if(in_array($cover_photo->guessExtension(), $file_ext)){
                                echo "edit logo";
                                $cover_photo_name = $cover_photo->getRandomName();
                                $cover_photo->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $cover_photo_name );
                                $cover_photo_loc = $coordinator_id . '/' . $cover_photo_name;
                
                                $isInserted = $admin->edit_barangay_cover_photo($coordinator_id, $cover_photo_loc);
                                if ($isInserted == true) {
                                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'Cover Photo Updated');
                                }else{
                                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to update logo');
                                }
                            
                            }else{
                                return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'File should be in jpg or png format');
                            }
                        }else{
                            return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Image should be lessthan 10 megabyte');
                        }
                    }else{
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Image Required');
                    }
                }else{
                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to change logo');
                }
            }else{
                return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'Failed to update profile picture');
            }
        }

        public function edit_barangay_info($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            $data = [
                'info' => $als_coord_info,
            ];

            if($this->request->getMethod()=="post"){

                $barangay = $this->request->getPost('barangay');
                $about = $this->request->getPost('about');
                $contact_no = $this->request->getPost('contact_no');
                $brgy_email = $this->request->getPost('brgy_email');
                $fb_page = $this->request->getPost('fb_page');
                $official_web = $this->request->getPost('official_web');
                $address = $this->request->getPost('address');
                $start_time = $this->request->getPost('start_time');
                $end_time = $this->request->getPost('end_time');

                $isUpdated = $admin->edit_barangay_info($coordinator_id, $about, $address, $contact_no, $start_time, $end_time, $brgy_email, $fb_page, $official_web);
                if ($isUpdated == true) {
                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'Barangay Information Updated Successfully');
                }else{
                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to update Barnangay Information');
                }
            }else{
                return redirect()->to('alscoordinator/barangay_settings' . "/" . $coordinator_id);
            }
        }

        public function edit_email($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            if($this->request->getMethod()=="post"){
                $coordinator_email = $this->request->getPost('coord_email');
                if(!empty($coordinator_email)){
                    $isUpdated = $admin->edit_coord_email($coordinator_id, $coordinator_email);
                    if($isUpdated == true){
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'Email Updated');
                    }else{
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to update email');
                    }
                }else{
                    return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Provide Email');
                }
            }else{
                return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Provide Email');
            }
        }

        public function edit_coord_acc($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            $data = [
                'info' => $als_coord_info,
            ];

            if($this->request->getMethod()=="post"){
                $username = $this->request->getPost('username');
                $new_pass = $this->request->getPost('new_pass');
                $conf_new_pass = $this->request->getPost('conf_new_pass');
                $coordinator_email = $this->request->getPost('coord_email');

                if($new_pass !== $conf_new_pass){
                    return redirect()->to('alscoordinator/barangay_settings' . "/" . $coordinator_id)->with('fail', 'Confirm your password');
                }else{
                    $email = \Config\Services::email();

                    $email->setFrom('alsecollaboration@alsgov.com', 'System');
                    $email->setTo($coordinator_email);
    
                    $data = [
                        'header' => ['content' => 'Brgy. Coordinator Credential' ],
                        'sub_header' =>['content' => 'Administrator Updated your Password' ],
                        'message' => ['content' => 'Any Issues regarding the system immediately contact your administrator'],
                        'contents' => ['content' => ''],
                        'links' => ['link_1' => base_url('alscoordinator/login')],
                        'credential' => ['username' => $username, 'password' => $new_pass],
                        'link_label' => ['label_1' => 'Go to Website']
                    ];
        
                    $email->setMessage($this->email_temp($data));
                    if($email->send()){
                        $isUpdated = $admin->edit_coord_credential($coordinator_id, $als_coord_id, $username, $new_pass);
                        if($isUpdated == true){
                            return redirect()->to('alscoordinator/barangay_settings' . "/" . $coordinator_id)->with('success', 'Password Updated successfully');
                        }else{
                            return redirect()->to('alscoordinator/barangay_settings' . "/" . $coordinator_id)->with('fail', 'Failed to update password');
                        }
                    }else{
                        return redirect()->to('alscoordinator/barangay_settings' . "/" . $coordinator_id)->with('fail', 'Invalid Email Address');
                    }
                    
                }
            }else{
                return redirect()->to('alscoordinator/barangay_settings' . "/" . $coordinator_id);
            }
        }

        public function generate_oid()
        {
            $oscyaModel = new OscyaModel();

            $numLength = 2;
            $strLength = 4;
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $num = '0123456789';

            $oscya_id = 'OID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
            $checkKey = $oscyaModel->check_oid($oscya_id);

            while ($checkKey == true) {
                $oscya_id = 'OID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
                $checkKey = $oscyaModel->check_oid($oscya_id);
            }
            return $oscya_id;
        }

        public function migrate_data($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            
            $staff_id = $this->request->getPost('staff_id');
            $teacher_id = $this->request->getPost('teacher_id');
            $facility_id = $this->request->getPost('facility_id');
            $mapping_date = $this->request->getPost('mapping_date');
            $barangay = $this->request->getPost('barangay');

            $coordinatorModel = new CoordinatorModel();
            $c_contact = $coordinatorModel->contact($coordinator_id);
            $file = $this->request->getFile('migration_file');
            $file_extension = $file->guessExtension();
            $file_ext_arr = ['xls', 'xlsx', 'csv'];
            if(!empty($file->getName())){
                if(in_array($file_extension, $file_ext_arr)){

                    $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
                    $spreadsheet = $reader->load($file);
                    $data = $spreadsheet->getActiveSheet()->toArray();
                    
                    //file format checking
                    //excel header begins at B5

                    $templateHeader = array(
                        "No.",
                        "Last Name, First Name Middle Name Ex.",
                        "Age",
                        "Birthdate (dd/mm/yyyy)",
                        "Sex",
                        "Civil Status",
                        "No./Unit/Bldg/Street",
                        "Barangay",
                        "Religion",
                        "Parents'/Guardian's Name",
                        "Contact No. of Parent/ Guardian",
                        "Highest Grade level attained",
                        "Reason for dropping out/ not enrolling",
                        "PWD",
                        "If yes, type of disability",
                        "Has PWD ID?",
                        "Is employed?",
                        "Is member of 4Ps",
                        "Interested to enroll in Deped Programs",
                        ""
                    );
                    
                    //strcasecmp use to compare string, it returns 0 when both strings are equals

                    $isValidTemplate = 0;
                    $message = '';
                    for ($i=0; $i < sizeof($data[4]); $i++) { 
                        if(strcasecmp(trim($data[4][$i]), $templateHeader[$i]) == 0){
                            
                            $isValidTemplate = 1;
                            break;
                        }else{
                            $isValidTemplate = 0;
                            $message = "Could not upload file " . $data[4][$i] . " And " . $templateHeader[$i] . " are not equal";
                            break;
                        }
                    }

                    if($isValidTemplate == 1){
                        $isFinished = 0;
                        foreach($data as $row){
                            if(!empty($row)){
                                if(!empty($row[7])){
                                    if(strcasecmp(strtoupper($barangay), $row[7]) == 0){
                                        $coordinatorModel->migrate_osy(
                                            $this->generate_oid(), //oid
                                            $staff_id, //staff
                                            $teacher_id, //teacher
                                            $row[1] == "" ? ' ' : $row[1], // fullname
                                            $row[2] == "" ? ' ' : $row[2] ,//age
                                            $row[3] == "" ? '' : date('Y-m-d', str_replace('/', '-', $row[3])), // Birthdate
                                            $row[4] == "" ? ' ' : $row[4], // gender
                                            $row[5] == "" ? ' ' : $row[5], // civil status
                                            $row[6] == "" ? ' ' : $row[6], // street
                                            $row[7], // barangay
                                            $c_contact['district'], // district 
                                            $row[8] == "" ? ' ' : $row[8], // religion
                                            $row[9] == "" ? ' ' : $row[9], // guardian's fullname
                                            $row[10] == "" ? ' ' : $row[10], // guardian's contact
                                            $row[11] == "" ? ' ' : $row[11], // grade level
                                            $row[12]== "" ? ' ' : $row[12] , // reason 
                                            $row[13] == 'YES' ? 1 : 0, // is pwd 
                                            $row[13] == 'YES' ? $row[14] : '', // type of disability
                                            $row[15] == 'NONE' || 'NO' ? 0 : 1, // has pwd id
                                            $row[16] == 'YES' ? 1 : 0 , // is employed
                                            $row[17] == 'YES' ? 1 : 0 , // is 4ps member
                                            $row[18] == 'YES' ? 1 : 0 , // is interested
                                            $mapping_date, // mapping date
                                            $mapping_date  // counseling date
                                        );
                                    }else{
                                        
                                    }
                                }else{
                                
                                }
                                
                            }else{
                                
                            }
                        }
                        $isDone = $coordinatorModel->assign_migrated_task($coordinator_id, $teacher_id, $staff_id, $facility_id, $mapping_date);
                        if($isDone == true){
                            return redirect()->to(base_url('alscoordinator/barangay_settings') . "/" . $coordinator_id)->with('success', 'Data uploaded successfully');
                        }
                        
                    }else{
                        return redirect()->to(base_url('alscoordinator/barangay_settings') . "/" . $coordinator_id)->with('fail', $message);
                    }
                    // print_r($templateHeader);
                }else{
                    return redirect()->to(base_url('alscoordinator/barangay_settings') . "/" . $coordinator_id)->with('fail', 'File should be in xls, xlsx and csv format');
                }
            }else{
                return redirect()->to(base_url('alscoordinator/barangay_settings') . "/" . $coordinator_id)->with('fail', 'File should not be empty');
            }
        }

        public function generate_report($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            
            
            $coordinatorModel = new CoordinatorModel();
           
            
            $purpose = $this->request->getPost('purpose');
            $date_from = $this->request->getPost('date_from');
            $date_to = $this->request->getPost('date_to');
            $coordinatorModel = new CoordinatorModel();
            $brgy_profile = $coordinatorModel->select_brgy_profile($coordinator_id);

            if($purpose == "QCYDO Reference"){
                $mpdf = new \Mpdf\Mpdf();
                
                $mpdf->SetHTMLHeader( '
                    <table class="header-data">
                        <tr>
                            <td class="logo-left">
                            <img style="width:80px;height:80px;" src = "' . base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['logo'] . '">
                            </td>
                            <td class="center">
                                <h4>QUEZON CITY</h4>
                                <h3>LITERACY MAPPING REPORT</h3>
                                <h4> ' . $purpose . '</h4>
                            </td>
                            <td class="logo-right">
                                <img style="width:70px;height:70px;" src = "' . base_url('public/uploads/assets/profiles') . '/qcydologo.png'. '">
                            </td>
                        </tr>
                    </table>
                ');
                $mpdf->SetHTMLFooter('
                    <div style="width:100%; text-align:center">
                        <img src = "' . base_url('public/uploads/assets/profiles') . '/qcydofooter.jpg'. '">
                    </div>
                ');
                $mpdf->AddPage('', // L - landscape, P - portrait 
                    '', '', '', '',
                    20, // margin_left
                    20, // margin right
                    30, // margin top
                    30, // margin bottom
                    8, // margin header
                    10); // margin footer
                
                $mpdf->WriteHTML($this->generate_pdf_report($coordinator_id, $purpose, $date_from, $date_to));
               
                $this->response->setHeader('Content-Type', 'application/pdf');
                
                // $mpdf->Output('sample.pdf', \Mpdf\Output\Destination::STRING_RETURN);
                // Output("./your_folder_location/".$pdfFilePath, "F");
                // $mpdf->Output("", "F");
                // $mpdf->Output('sample.pdf', 'I');

                $file_name = uniqid('file-');
                if(!is_dir(FCPATH . '/uploads/reports/' . $coordinator_id)){
                    mkdir(FCPATH . '/uploads/reports/' . $coordinator_id);
                    $mpdf->Output( FCPATH . '/uploads/reports/' . $coordinator_id . '/' . $file_name . '.pdf', "F" );
                    $isInserted = $coordinatorModel->insert_report($coordinator_id, $file_name, $purpose, $date_from, $date_to, $coordinator_id .'/'.$file_name . '.pdf');
                    if($isInserted == true){
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'Report Generated');
                    }else{
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'There\'s an Error in generating report');
                    }
                }else{
                    $mpdf->Output( FCPATH . '/uploads/reports/' . $coordinator_id . '/' . $file_name . '.pdf', "F" );
                    $isInserted = $coordinatorModel->insert_report($coordinator_id, $file_name, $purpose, $date_from, $date_to, $coordinator_id .'/'.$file_name . '.pdf');
                    if($isInserted == true){
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'Report Generated');
                    }else{
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'There\'s an Error in generating report');
                    }
                }
            }else{
                $osya_records = $coordinatorModel->select_excel_report($brgy_profile['barangay'], $date_from, $date_to);


                    $spreadsheet = new Spreadsheet();
                    $spsheetHeader = [
                        'font' => [
                            'color' => [
                                'rgb' => 'black'
                            ],
                            'bold' => true,
                            'size' => 11
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => '92D050'
                            ]

                        ]
                    ];
                    $spreadsheet->getDefaultStyle()
                        ->getFont()
                        ->setName('Arial')
                        ->setSize(10);
                    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
                   
                    $spreadsheet->getActiveSheet()->getStyle('A5:AH5')->applyFromArray($spsheetHeader);

                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A5', 'OSY ID');
                    $sheet->setCellValue('B5', 'Staff ID');
                    $sheet->setCellValue('C5', 'Fullname');
                    $sheet->setCellValue('D5', 'Lastname');
                    $sheet->setCellValue('E5', 'Firstname');
                    $sheet->setCellValue('F5', 'Middlename');
                    $sheet->setCellValue('G5', 'Name Extension');
                    $sheet->setCellValue('H5', 'Birthdate');
                    $sheet->setCellValue('I5', 'Age');
                    $sheet->setCellValue('J5', 'Gender');
                    $sheet->setCellValue('K5', 'Civil Status');
                    $sheet->setCellValue('L5', 'Religion');
                    $sheet->setCellValue('M5', 'Email');
                    $sheet->setCellValue('N5', 'Contact');
                    $sheet->setCellValue('O5', 'Facebook');
                    $sheet->setCellValue('P5', 'Street');
                    $sheet->setCellValue('Q5', 'Barangay');
                    $sheet->setCellValue('R5', 'Guardian Fullname');
                    $sheet->setCellValue('S5', 'Guardian Email');
                    $sheet->setCellValue('T5', 'Guardian Contact');
                    $sheet->setCellValue('U5', 'Guardian Facebook');
                    $sheet->setCellValue('V5', 'LRN');
                    $sheet->setCellValue('W5', 'Educational Attainment');
                    $sheet->setCellValue('X5', 'Reason');
                    $sheet->setCellValue('Y5', 'Other reason');
                    $sheet->setCellValue('Z5', 'Disability');
                    $sheet->setCellValue('AA5', 'PWD');
                    $sheet->setCellValue('AB5', 'Has PWD ID');
                    $sheet->setCellValue('AC5', 'Other Disability');
                    $sheet->setCellValue('AD5', 'Disease');
                    $sheet->setCellValue('AE5', 'Is Employed');
                    $sheet->setCellValue('AF5', 'Is 4ps Member');
                    $sheet->setCellValue('AG5', 'Is interested`');
                    $sheet->setCellValue('AH5', 'Mapping Date');
                    $rows = 6;
                    foreach($osya_records as $oscya){
                        $sheet->setCellValue('A' . $rows , $oscya['oscya_id']);
                        $sheet->setCellValue('B' . $rows , $oscya['user_id']);
                        $sheet->setCellValue('C' . $rows , $oscya['fullname']);
                        $sheet->setCellValue('D' . $rows , $oscya['lastname']);
                        $sheet->setCellValue('E' . $rows , $oscya['firstname']);
                        $sheet->setCellValue('F' . $rows , $oscya['middlename']);
                        $sheet->setCellValue('G' . $rows , $oscya['extension']);
                        $sheet->setCellValue('H' . $rows , $oscya['birthdate']);
                        $sheet->setCellValue('I' . $rows , $oscya['age']);
                        $sheet->setCellValue('J' . $rows , $oscya['gender']);
                        $sheet->setCellValue('K' . $rows , $oscya['civil_status']);
                        $sheet->setCellValue('L' . $rows , $oscya['religion']);
                        $sheet->setCellValue('M' . $rows , $oscya['email']);
                        $sheet->setCellValue('N' . $rows , $oscya['contact']);
                        $sheet->setCellValue('O' . $rows , $oscya['facebook']);
                        $sheet->setCellValue('P' . $rows , $oscya['street']);
                        $sheet->setCellValue('Q' . $rows , $oscya['brgy']);
                        $sheet->setCellValue('R' . $rows , $oscya['fullname']);
                        $sheet->setCellValue('S' . $rows , $oscya['g_email']);
                        $sheet->setCellValue('T' . $rows , $oscya['g_contact']);
                        $sheet->setCellValue('U' . $rows , $oscya['g_facebook']);
                        $sheet->setCellValue('V' . $rows , $oscya['lrn']);
                        $sheet->setCellValue('W' . $rows , 'Grade' . $oscya['educ_attainment']);
                        $sheet->setCellValue('X' . $rows , $oscya['reason']);
                        $sheet->setCellValue('Y' . $rows , $oscya['other_reason']);
                        $sheet->setCellValue('Z' . $rows , $oscya['disability']);
                        $sheet->setCellValue('AA' . $rows , $oscya['is_pwd'] == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AB' . $rows , $oscya['has_pwd_id'] == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AC' . $rows , $oscya['other_disability']);
                        $sheet->setCellValue('AD' . $rows , $oscya['disease']);
                        $sheet->setCellValue('AE' . $rows , $oscya['is_employed'] == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AF' . $rows , $oscya['is_fps_member']  == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AG' . $rows , $oscya['is_interested']  == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AH' . $rows , $oscya['mapping_date']);
                        $rows++;
                    } 
                    
                    $writer = new Xlsx($spreadsheet);
                    $file_name = uniqid();
                    if (!is_dir(FCPATH . "uploads/reports/" . $coordinator_id . '/')) {
                        mkdir(FCPATH . "uploads/reports/" . $coordinator_id . '/', 0777, TRUE);
                        $path = FCPATH . "uploads/reports/" . $coordinator_id . '/' . $file_name . '.xlsx';
                        $writer->save($path);
                        $isCreated = $coordinatorModel->insert_report($coordinator_id, $file_name, $purpose,$date_from, $date_to,  $coordinator_id . '/'. $file_name . '.xlsx');
                        if($isCreated == true){
                            return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id )->with('success', 'Report Created');
                        }else{
                            return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to create Report file');
                        }
                    }else if(is_dir(FCPATH . "uploads/reports/" . $coordinator_id . '/')){
                        $path = FCPATH . "uploads/reports/" . $coordinator_id . '/' . $file_name . '.xlsx';
                        $writer->save($path);
                        $isCreated = $coordinatorModel->insert_report($coordinator_id, $file_name, $purpose, $date_from, $date_to, $coordinator_id . '/'. $file_name . '.xlsx');
                        if($isCreated == true){
                            return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('success', 'File Created');
                        }else{
                            return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to create Report file');
                        }
                    }else{
                        return redirect()->to('alscoordinator/barangay_settings/' . $coordinator_id)->with('fail', 'Failed to create Report file');
                    }
            }
        }

        public function generate_pdf_report($coordinator_id, $purpose, $date_from, $date_to)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            
            $coordinatorModel = new CoordinatorModel();
            $c_info = $coordinatorModel->get_brgy($coordinator_id);
            $data = [
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'brgy_info' => $coordinatorModel->get_brgy($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'purpose' => ['for' => $purpose, 'date_from' => $date_from, 'date_to' => $date_to],
                'generate_reports'=> $coordinatorModel->generate_reports($c_info->barangay, $date_from, $date_to),
                'gender' => $coordinatorModel->generate_gender_reports($c_info->barangay, $date_from, $date_to),
                'educ_attainment' => $coordinatorModel->generate_educ_attainment_reports($c_info->barangay, $date_from, $date_to),
                'disability' => $coordinatorModel->generate_disability_reports($c_info->barangay, $date_from, $date_to),
                'reason' => $coordinatorModel->generate_reason_reports($c_info->barangay, $date_from, $date_to),
                'pwd' => $coordinatorModel->generate_pwd_reports($c_info->barangay, $date_from, $date_to),
                'civil_status' => $coordinatorModel->generate_civil_status($c_info->barangay, $date_from, $date_to),
                
            ];
            return view('alscoordinator/reports', $data);
        }

        public function reports($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            $coordinatorModel = new CoordinatorModel();
            $c_contact = $coordinatorModel->contact($coordinator_id);

            $data = [
                
                'brgy_info' => $admin->select_barangay_info($coordinator_id),
                'coord_acc' => $admin->select_coord_account($coordinator_id),
                'teachers' => $admin->select_all_teacher($als_coord_id),
                'staffs' => $admin->select_all_staff($coordinator_id),
                'facilities' => $admin->select_all_facility($coordinator_id),

                'info' => $admin->select_als_coord_info($als_coord_id),
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'reports' => $coordinatorModel->reports($c_contact['barangay']),
                'reason' => $coordinatorModel->reason($c_contact['barangay']),
                'gender' => $coordinatorModel->gender($c_contact['barangay']),
                'educ_attainment' => $coordinatorModel->educ_attainment($c_contact['barangay']),
                'pwd' => $coordinatorModel->pwd($c_contact['barangay']),
                'count_disability' => $coordinatorModel->count_disability($c_contact['barangay']),
                'reporting' => $coordinatorModel->select_reports($coordinator_id),
                'indexes' => ['title' => 'REPORTS'],
                'pages' => ['page' => 'reports']
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/reports_ui', $data);
            echo view('alscoordinator/templates/footer', $data);

        }

        public function registration()
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();
            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $data = [
                'info' => $als_coord_info,
                'register' => $admin->registered_brgy_coord($als_coord_info['district']),
                'pending' => $admin->select_pending_coord($als_coord_info['district']),
                'approved' => $admin->select_approved_coord($als_coord_info['district'])
            ];

            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/brgy_registration', $data);
            echo view('alscoordinator/templates/footer', $data);
        } 

        public function coordinator()
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();

            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $als_coord_dist = $als_coord_info['district'];
            
            $data = [
                'barangays' => $admin->select_created_brgy($als_coord_id),
                'info' => $admin->select_als_coord_info($als_coord_id)

            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/coordinator', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function coordinator_account($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();
            $coordinatorModel = new CoordinatorModel();

            $data =[
                'info' => $admin->select_als_coord_info($als_coord_id),
                'c_account' => $coordinatorModel->account($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id)
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/coordinator_account', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function view_registration($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();
            $als_coord_info = $admin->select_als_coord_info($als_coord_id);
            $data = [
                'info' => $als_coord_info,
                'coordinator' => $admin->view_registration($coordinator_id)
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/view_registration', $data);
            echo view('alscoordinator/templates/footer', $data);
            // echo '<pre>';
            // print_r($data['coordinator']);
        }

        public function email_temp($data)
        {
            return view('alscoordinator/email_temp', $data);
        }

        public function save_registration()
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');

            if($this->request->getMethod() == 'post'){
                $coordinator_id = $this->request->getPost('cid');
                $activation_code = $this->request->getPost('act_code');
                $coordinator_email = $this->request->getPost('email');
                $resubmit = $this->request->getPost('resubmit');
                $remarks = $this->request->getPost('message');

                if($resubmit == 1){
                    $email = \Config\Services::email();

                    $email->setFrom('alsecollaboration@alsgov.com', 'System');
                    $email->setTo($coordinator_email);
    
                    $data = [
                        'header' => ['content' => 'Brgy. Coordinator Credential' ],
                        'sub_header' =>['content' => 'Resubmit your barangay coordinator registration credential' ],
                        'message' => ['content' => 'Resubmit Valid ID'],
                        'contents' => ['content' => ''],
                        'links' => ['link_1' => base_url('registration/update_coordinator_id') . '/' . $coordinator_id],
                        'link_label' => ['label_1' => 'Resubmit']
                    ];
        
                    $email->setMessage($this->email_temp($data));
                    if($email->send()){
                        $als_coord_model = new AlscoordinatorModel();
                        $is_evaluated = $als_coord_model->update_brgy_coordinator_acc($als_coord_id, $coordinator_id);
                        if($is_evaluated == true){
                            return redirect()->to('alscoordinator/registration')->with('success', 'Coordinator Account Evaluated');
                        }else{
                            return redirect()->to('alscoordinator/registration')->with('fail', "Can't evaluate Account");
                        }
                    }else{
                        return redirect()->to('alscoordinator/registration')->with('fail', "Invalid email");
                    }
                }else{
                    $email = \Config\Services::email();

                    $email->setFrom('alsecollaboration@alsgov.com', 'System');
                    $email->setTo($coordinator_email);
    
                    $email->setSubject('Account Activation');
                    $data = [
                        'header' => ['content' => 'Brgy. Coordinator Activate Account' ],
                        'sub_header' =>['content' => $activation_code ],
                        'message' => ['content' => 'Activate your Barangay Coordinator Account'],
                        'contents' => ['content' => $remarks ],
                        'links' => ['link_1' => base_url('coordinator/activate') . '/' . $coordinator_id ],
                        'link_label' => ['label_1' => 'Activate']
                    ];
        
                    $email->setMessage($this->email_temp($data));
                    if($email->send()){
                        $als_coord_model = new AlscoordinatorModel();
                        $is_evaluated = $als_coord_model->update_brgy_coordinator_acc($als_coord_id, $coordinator_id);
                        $resubmitted = $als_coord_model->update_brgy_coordinator_resubmit($als_coord_id, $coordinator_id);
                        if($is_evaluated == true && $resubmitted == 0){
                            return redirect()->to('alscoordinator/registration')->with('success', 'Coordinator Account Evaluated');
                        }else{
                            return redirect()->to('alscoordinator/registration')->with('fail', "Can't evaluate Account");
                        }
                    }else{
                        return redirect()->to('alscoordinator/registration')->with('fail', "Invalid email");
                    }
                }
                
            }
            

        }

        public function view_barangay($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            
            $admin = new AlscoordinatorModel();
            $coordinatorModel = new CoordinatorModel();
            $als_coord_id = $session->get('als_coord_id');
            $c_contact = $coordinatorModel->contact($coordinator_id);
            $data=[
                'info' => $admin->select_als_coord_info($als_coord_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'reports' => $coordinatorModel->reports($c_contact['barangay']),
                'reason' => $coordinatorModel->reason($c_contact['barangay']),
                'gender' => $coordinatorModel->gender($c_contact['barangay']),
                'educ_attainment' => $coordinatorModel->educ_attainment($c_contact['barangay']),
                'pwd' => $coordinatorModel->pwd($c_contact['barangay']),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'staffs' => $admin->select_staff($coordinator_id),
                'osy' => $admin->select_all_oscya($c_contact['barangay'])

                
            ];

            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/view_barangay', $data);
            echo view('alscoordinator/templates/footer', $data);
        }

        public function record($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));

            }
            $als_coord_id = $session->get('als_coord_id');

            $admin = new AlscoordinatorModel();
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                'oscya' => $admin->select_oscya($coordinator_id),
                'count' => $admin->count_oscya($coordinator_id),
                'cid' => ['coord_id' => $coordinator_id, 'title' =>'task']
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/record', $data);
            echo view('alscoordinator/templates/footer', $data);
        }

        public function view_teacher_registration()
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));

            }
            $als_coord_id = $session->get('als_coord_id');

            $admin = new AlscoordinatorModel();
            $info = $admin->select_als_coord_info($als_coord_id);
            
            // echo '<pre>';
            // print_r($admin->select_teacher_registration($info['district']));

            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                'registration' => $admin->select_teacher_registration($info['district']),
                'pending' => $admin->select_pending_teacher_registration($info['district']),
                'approved' => $admin->select_approved_teacher_registration($info['district'])
            ];

            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/teacher_registration', $data);
            echo view('alscoordinator/templates/footer', $data);
           
        }

        public function view_teacher_registration_detail($teacher_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));

            }
            $als_coord_id = $session->get('als_coord_id');

            $admin = new AlscoordinatorModel();
           
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                'tch_reg' => $admin->view_teacher_registration($teacher_id)
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/view_teacher_reg', $data);
            echo view('alscoordinator/templates/footer', $data);
            
        }                                                                          

        public function teacher_evaluated()
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));

            }
            $als_coord_id = $session->get('als_coord_id');

            

            if($this->request->getMethod()=='post'){
                $teacher_id = $this->request->getPost('user_id');
                $act_code = $this->request->getPost('act_code');
                $teacher_email = $this->request->getPost('email');
                $resubmit = $this->request->getPost('resubmit');
                $remarks = $this->request->getPost('remarks');

                if($resubmit == 1){
                    $email = \Config\Services::email();

                    $email->setFrom('alsecollaboration@alsgov.com', $als_coord_id);
                    $email->setTo($teacher_email);
                    $email->setSubject('Activate');

                    $data = [
                        'header' => ['content' => 'ALS Teacher Account' ],
                        'sub_header' =>['content' => 'Resubmit Teacher Credential' ],
                        'message' => ['content' => 'Resubmit your Valid ID, checkout valid ID types and Upload the scanned copy'],
                        'contents' => ['content' => $remarks ],
                        'links' => ['link_1' => base_url('registration/update_teacher_id') . '/' . $teacher_id ],
                        'link_label' => ['label_1' => 'Resubmit your ID']
                    ];
        
                    $email->setMessage($this->email_temp($data));
                    if($email->send()){
                        $admin = new AlscoordinatorModel();
                        $isUpdated = $admin->resubmit_id($als_coord_id, $teacher_id);
                        if($isUpdated == true){
                            return redirect()->to('alscoordinator/teacher_registration')->with('success', 'Coordinator Account Evaluated');
                        }else{
                            return redirect()->to('alscoordinator/teacher_registration')->with('fail', 'Failed to evaluate teacher Registration');
                        }
                    }else{
                        return redirect()->to('alscoordinator/teacher_registration')->with('success', 'Invalid Email');
                    }
                }else{
                    $email = \Config\Services::email();

                    $email->setFrom('alsecollaboration@alsgov.com', $als_coord_id);
                    $email->setTo($teacher_email);
                    $email->setSubject('Activate Account');
                    
                    $data = [
                        'header' => ['content' => 'ALS Staff Account' ],
                        'sub_header' =>['content' => 'Your activation code: ' . $act_code ],
                        'message' => ['content' => 'Activate your account using the above activation code'],
                        'contents' => ['content' => $remarks ],
                        'links' => ['link_1' =>  base_url('teacher/activate') . '/' . $teacher_id ],
                        'link_label' => ['label_1' => 'Activate1']
                    ];
        
                    $email->setMessage($this->email_temp($data));
                    
                    if($email->send()){
                        $admin = new AlscoordinatorModel();
                        $isUpdated = $admin->update_teacher_resubmit_status($als_coord_id, $teacher_id);
                        if($isUpdated == true){
                            return redirect()->to('alscoordinator/teacher_registration')->with('success', 'Coordinator Account Evaluated');
                        }else{
                            return redirect()->to('alscoordinator/teacher_registration')->with('success', 'Coordinator Account Evaluated');
                        }
                    }else{
                        return redirect()->to('alscoordinator/teacher_registration')->with('success', 'Invalid Email');
                    }
                }
            }else{
                return redirect()->to(base_url('alscoordinator/login'));
            }
        }

        public function task($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));

            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();
            $data = [
                'brgy_detail' => $admin->select_brgy($coordinator_id),
                'info' => $admin->select_als_coord_info($als_coord_id),
                'oscya' => $admin->count_oscya($coordinator_id),
                'brgy' => $admin->select_brgy($coordinator_id)
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/task', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function report($coordinator_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));

            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                'oscya' => $admin->count_oscya($coordinator_id),
                
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/report', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function add_brgy_coord()
        {
            echo view('alscoordinator/templates/header');
            echo view('alscoordinator/add_brgy_coordinator');
            echo view('alscoordinator/templates/footer');
        }

        public function save_brgy_coord()
        {
            if($this->request->getMethod('post')){
                $session = \Config\Services::session();

                if(empty($session->get('als_coord_id'))){
                    return redirect()->to(base_url('alscoordinator/login'));
                }
                
                $admin_id = $session->get('als_coord_id');
                $admin = new AlscoordinatorModel();
                $coordinator_id = $this->generate_sid($admin);
                $district = $this->request->getPost('district');
                $barangay = $this->request->getPost('barangay');
                $lastname = $this->request->getPost('lastname');
                $firstname = $this->request->getPost('firstname');
                $middlename = $this->request->getPost('middlename');
                $extension = empty($this->request->getPost('extension')) || $this->request->getPost('extension') == 'Choose' ? '' : $this->request->getPost('extension');
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $isInserted = $admin->add_brgy_coord($admin_id, $coordinator_id, $district, $barangay, $lastname, $firstname, $middlename, $extension, $username, $password);

                if ($isInserted == true) {
                    return redirect()->to(base_url('alscoordinator/add_brgy_coord'));
                } else {
                    return redirect()->to(base_url('alscoordinator/add_brgy_coord'));
                }
            }
        }

        public function teacher()
        {
            echo view('alscoordinator/templates/header');
            echo view('alscoordinator/teacher');
            echo view('alscoordinator/templates/footer');
        }
        
        public function add_teacher()
        {
            echo view('alscoordinator/templates/header');
            echo view('alscoordinator/add_teacher');
            echo view('alscoordinator/templates/footer');
        }

        public function my_account()
        {
            $session = \Config\Services::session();
            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');

            $admin = new AlscoordinatorModel();
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                'als_account' => $admin->my_account($als_coord_id),
                'als_account_info' => $admin->my_info($als_coord_id),
                'als_account_contact' => $admin->my_contact($als_coord_id),
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/my_account', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function edit_picture()
        {
            $session = \Config\Services::session();
            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            if($this->request->getMethod()=="post"){
                $admin = new AlscoordinatorModel();
                $image = $this->request->getFile('image');
                if($image->isValid() && !$image->hasMoved()){
                    $imageName = $image->getRandomName();
                    $image->move(FCPATH . "uploads/assets/profiles/" .  $als_coord_id , $imageName );
                    $image_loc = $als_coord_id . '/' . $imageName;
    
                    $admin->edit_profile_pic($als_coord_id, $image_loc);
                    return redirect()->to('alscoordinator/my_account')->with('success', 'Profile picture updated');
                }else{
                    return redirect()->to('coordinator/account')->with('success', 'Failed to update profile picture');;
                }

            }

            
        }

        public function edit_password()
        {   
            $session = \Config\Services::session();
            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');
            if($this->request->getMethod()=="post"){
                
                $username = $this->request->getPost('username');
                $old_password = $this->request->getPost('old_password');
                $new_password = $this->request->getPost('new_password');

                $alscoordinatorModel = new AlscoordinatorModel();

                $isValid = $alscoordinatorModel->checkpassword($username, $old_password);
                if($isValid == true){
                    $isUpdated = $alscoordinatorModel->edit_password($als_coord_id, $username, $new_password);
                    if($isUpdated == true){
                        $data = [
                            'class' => "alert-success",
                            'message' => "Password Changed"
                        ];
                        echo json_encode($data);
                        // return redirect()->to('alscoordinator/my_account')->with('success', 'Password Changed');
                    }else{
                        $data = [
                            'class' => "alert-danger",
                            'message' => "Failed to change password"
                        ];
                        echo json_encode($data);
                        // return redirect()->to('alscoordinator/my_account')->with('fail', 'Failed to change password');
                    }
                }else{
                    $data = [
                        'class' => "alert-danger",
                        'message' => "Password doesn't match"
                    ];
                    echo json_encode($data);
                    // return redirect()->to('alscoordinator/my_account')->with('fail', 'Password doesn \'t match');
                }
            }
        }

        public function edit_contact()
        {
            $session = \Config\Services::session();
            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');

            if($this->request->getMethod()){
                $alscoordinatorModel = new AlscoordinatorModel();
                $email = $this->request->getPost('email');
                $contact_no = $this->request->getPost('contact_no');
                $facebook = $this->request->getPost('facebook');
                $street = $this->request->getPost('street');
                $barangay = $this->request->getPost('barangay');
                $district = $this->request->getPost('district');
                $city = $this->request->getPost('city');
                $zip_code = $this->request->getPost('zip_code');
                
                $isUpdated = $alscoordinatorModel->edit_contact($als_coord_id, $email, $facebook, $contact_no, $street, $barangay, $district, $zip_code, $city);

                if($isUpdated == true){
                    $data = [
                        'class' => 'alert-success',
                        'message' => 'Contact information updated successfully'
                    ];
                    echo json_encode($data);
                }else{
                    $data = [
                        'class' => 'alert-danger',
                        'message' => 'Failed to update contact information '
                    ];
                    echo json_encode($data);
                }
            }
        }

        public function edit_info()
        {
            $session = \Config\Services::session();
            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');

            if($this->request->getMethod()=="post"){
                $alscoordinatorModel = new AlscoordinatorModel();
                $lastname = $this->request->getPost('lastname');
                $firstname = $this->request->getPost('firstname');
                $middlename = $this->request->getPost('middlename');
                $suffix = $this->request->getPost('suffix');
                $birth = $this->request->getPost('birth');
                $age = $this->request->getPost('age');
                $gender = $this->request->getPost('gender');
                $civil_status = $this->request->getPost('civil_status');
                $religion = $this->request->getPost('religion');

                $isUpdated = $alscoordinatorModel->edit_info($als_coord_id, $lastname, $firstname, $middlename, $suffix, $birth, $age, $gender, $civil_status, $religion );
                if($isUpdated == true){
                    $data = [
                        'class' => 'alert-success',
                        'message' => 'Personal information updated successfully'
                    ];
                    echo json_encode($data);
                }else{
                    $data = [
                        'class' => 'alert-danger',
                        'message' => 'Failed to update personal information '
                    ];
                    echo json_encode($data);
                }
            }else{
                return redirect()->to('alscoordinator/login')->with('fail', 'You must login first');
            }
        }


        public function district_settings()
        {
            $session = \Config\Services::session();
            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');

            $alscoordinatorModel = new AlscoordinatorModel();
            $admin = new AlscoordinatorModel();
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                // 'tasks' => $admin->select_teacher_tasks($als_coord_id)
                'teachers' => $admin->select_teacher($als_coord_id)
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/district_settings', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function olcm()
        {
            $session = \Config\Services::session();
            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');

            $alscoordinatorModel = new AlscoordinatorModel();
            $admin = new AlscoordinatorModel();
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                // 'tasks' => $admin->select_teacher_tasks($als_coord_id)
                'teachers' => $admin->select_teacher($als_coord_id)
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/olcm', $data);
            echo view('alscoordinator/templates/footer');
            
        }

        public function view_tasks($teacher_id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');

            $alscoordinatorModel = new AlscoordinatorModel();
            $data = [
                'info' => $alscoordinatorModel->select_als_coord_info($als_coord_id),
                'tasks' => $alscoordinatorModel->select_teacher_tasks($als_coord_id)
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/view_tasks', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function logout()
        {
            $session = \Config\Services::session();
            $admin = new AlscoordinatorModel();
            $setOffline = $admin->update_status($session->get('als_coord_id'), 0);
            if($setOffline == true){
                $session->remove('als_coord_id');
                return redirect()->to(base_url('alscoordinator/login'));
            }
        }

        public function view_staff_records($staff_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));

            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();
            $staffModel = new StaffModel();
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                's_info' => $staffModel->staff_info($staff_id),
                's_contact' => $staffModel->staff_contact($staff_id),
                'staff_records' => $admin->view_staff_records($staff_id),
                'gender'=>$admin->count_gender($staff_id),
                'ages' => $admin->count_ages($staff_id),
                'civil_status' => $admin->count_civil_status($staff_id),
                'total' => $admin->count_staff_inserted($staff_id), 
                'educ' => $admin->count_educ_attainment($staff_id),
                'reason' =>$admin->count_reason($staff_id),
                'disability' =>$admin->count_disability($staff_id),
                'status' => $admin->is_status($staff_id),
                'pages' => ['view_staff_records' => 'view_staff_records'],
                'teachers' => $admin->select_teacher($als_coord_id),
                'user_id' => ['staff_id' => $staff_id],
                'is_tasked' => $admin->is_task($staff_id) == true ? ['assigned' => true] : ['assigned' => false]
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/view_staff_records', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function view_staff_report($staff_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));

            }
            $als_coord_id = $session->get('als_coord_id');
            $admin = new AlscoordinatorModel();
            $data = [
                'info' => $admin->select_als_coord_info($als_coord_id),
                'gender'=>$admin->count_gender($staff_id),
                'age' => $admin->count_ages($staff_id),
                'civil_status' => $admin->count_civil_status($staff_id),
                'total' => $admin->count_staff_inserted($staff_id),
                'educ' => $admin->count_educ_attainment($staff_id),
                'reason' =>$admin->count_reason($staff_id),
                'disability' =>$admin->count_disability($staff_id),
                'status' => $admin->is_status($staff_id),
                
            ];
            echo view('alscoordinator/templates/header', $data);
            echo view('alscoordinator/view_staff_report', $data);
            echo view('alscoordinator/templates/footer');
        }

        public function assign_task($staff_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('als_coord_id'))){
                return redirect()->to(base_url('alscoordinator/login'));
            }
            $als_coord_id = $session->get('als_coord_id');

            if($this->request->getMethod()=='post'){
                $admin = new AlscoordinatorModel();
                $teacher_id = $this->request->getPost('teacher_id');
                $schedule_date = $this->request->getPost('schedule_date');
                $start_time = $this->request->getPost('start_time');
                $end_time = $this->request->getPost('end_time');

                echo $teacher_id;
                $isAssigned = $admin->insert_teacher_task($als_coord_id, $teacher_id, $staff_id, $schedule_date, $start_time, $end_time);

                if($isAssigned == true){
                    return redirect()->to('alscoordinator/view_staff_records' . '/' . $staff_id)->with('success', 'Task successfully added');

                }else{
                    return redirect()->to('alscoordinator/view_staff_records' . '/' . $staff_id)->with('fail', 'Failed to add task');
                }
            }
        }
    }
 