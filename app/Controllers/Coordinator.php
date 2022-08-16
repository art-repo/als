<?php

    namespace App\Controllers;

    use App\Models\CoordinatorModel;
    use App\Models\StaffModel;
    use App\Models\OscyaModel;
    use App\Models\UserModel;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use \CodeIgniter\View\Table;

    class Coordinator extends BaseController
    {

        public function __construct()
        {
            helper(['url', 'form', 'id', 'cookie', 'session']);
        }

        protected function generate_fid($coordinatorModel)
        {
            $numLength = 2;
                $strLength = 4;
                $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $num = '0123456789';

                $f_id = 'FID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
                $checkKey = $coordinatorModel->check_fid($f_id);

                while ($checkKey == true) {
                    $f_id = 'FID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
                    $checkKey = $coordinatorModel->check_fid($f_id);
                }
                return $f_id;
        }

        protected function generate_act_id($coordinatorModel)
        {
            $numLength = 2;
                $strLength = 4;
                $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $num = '0123456789';

                $act_id = 'ACTID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
                $checkKey = $coordinatorModel->check_act_id($act_id);

                while ($checkKey == true) {
                    $act_id = 'ACTID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
                    $checkKey = $coordinatorModel->check_act_id($act_id);
                }
                return $act_id;
        }

        public function index()
        {
            echo view ( 'templates/head');
            if($this->request->getMethod()=="post"){
                $session = \Config\Services::session();

                $username =  $this->request->getPost('username');
                $password = $this->request->getPost('password');
                if(empty($username) || empty($password)){
                    return redirect()->to('coordinator/login')->with('fail', 'Username and Password should not be empty');
                }
                $userModel = new UserModel();
                $coordinatorData = $userModel->coordinator($username, $password);
    
                if(empty($coordinatorData)){
                    return redirect()->to('coordinator/login')->with('fail', 'Invalid Username or password');
                }else{
                    // echo $als_coord_data['is_evaluated'];
                    if($coordinatorData['isActivated'] == 0 || $coordinatorData['is_evaluated'] == 0){
                        return redirect()->to('coordinator/login')->with('fail', 'Your Account isnt Activated');
                    }
                    if($coordinatorData['isActivated'] == 1 && $coordinatorData['is_evaluated'] == 1){
                        $sessionData = [
                            'user_id' => $coordinatorData['user_id'],
                            'username' => $coordinatorData['username'],
                        ];
                        $userModel->update_status($coordinatorData['user_id'], 1);
                        $session->set('coordinator_id', $sessionData['user_id']);
                        $session->set('passkey', $password);
    
                        return redirect()->to(base_url('coordinator/home'));
                    } 
                }
            }else{
                echo view('coordinator/login');
            }
        }

        public function activate($coordinator_id)
        {
            $data = [
                'coordinator_id' => $coordinator_id
            ];
            echo view('coordinator/activate_account', $data);
        }

        public function activation()
        {
            if($this->request->getMethod() == 'post'){
                $coordinator_id = $this->request->getPost('coordinator_id');
                $activation_code = $this->request->getPost('activation_code');
                $coordinatorModel = new CoordinatorModel();
                $code = $coordinatorModel->check_activation_code($coordinator_id);
               
                if($code['activation_code'] == $activation_code)
                {
                    $updateActivationStatus = $coordinatorModel->update_activation_status($coordinator_id);
                    if($updateActivationStatus == true){
                        return redirect()->to('coordinator/activate' . '/' . $coordinator_id)->with('success', 'Account Activated');
                    }else{
                        return redirect()->to('coordinator/activate' . '/' . $coordinator_id)->with('fail', 'Invalid Activation Code');
                    }
                }
            }
        }
        
        public function forgot_password()
        {
            $page = 'forgot_password';
            if (! is_file(APPPATH . 'Views/coordinator/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
            }
            if($this->request->getMethod()=='post'){
                
                $coordinatorModel = new CoordinatorModel();
                $coordinator_email = $this->request->getPost('email');
                $user = $coordinatorModel->check_email($coordinator_email);
                if(!empty($user)){
                    $email = \Config\Services::email();

                    $email->setFrom('alsecollaboration@alsgov.com', 'System');
                    $email->setTo($coordinator_email);

                    $email->setSubject('Reset Password');
                    $message = '';
                    $message .= '<h1 style="font-weight:bold;">Reset your ALS Coordinator Password</h1>';
                    $message .= '<a href="' . base_url('coordinator/reset_password' . '/' . $user['user_id']) . '">Reset</a>';
                    $email->setMessage($message);

                    if($email->send()){
                        // echo view('alscoordinator/reset_message', $user);
                        return redirect()->to('coordinator/forgot_password')->with('success', 'Check your email to reset your password');
                    }else{
                        return redirect()->to('coordinator/forgot_password')->with('fail', 'Invalid Email');
                    }
                    
                }else{
                    return redirect()->to('coordinator/forgot_password')->with('fail', 'Invalid Email');
                }
            }else{
                echo view('coordinator/forgot_password');
            }
        }

        public function reset_password($user_id)
        {
            if($this->request->getMethod() == 'post'){
                $new_pass = $this->request->getPost('new_pass');
                $coordinatorModel = new CoordinatorModel(); 
                $accData = $coordinatorModel->account_detail($user_id);

                if(!empty($accData)){
                    $isUpdated = $coordinatorModel->update_password($user_id, password_hash($new_pass, PASSWORD_BCRYPT));
                    if($isUpdated == true){
                        $data = [
                            'class' => 'alert alert-success',
                            'message' => 'Password updated successfully',
                            'link' => '<a href="' . base_url('coordinator/login') . '" class="btn btn-blue-3 fw-bold">Sign in</a>'
                        ];
                        echo view('coordinator/reset_message', $data);
                    }else{
                        $data = [
                            'class' => 'alert alert-danger',
                            'message' => 'Failed to update password',
                            'link' => '<a href="' . base_url('coordinator/reset_password') . '" class="btn btn-blue-3 fw-bold">Sign in</a>'
                        ];
                        echo view('coordinator/reset_password', $data);
                    }
                }

            }else{
                $coordinatorModel = new CoordinatorModel(); 
                $accData = $coordinatorModel->account_detail($user_id);
                echo view('coordinator/reset_password', $accData);
            }
        }

        public function auth()
        {
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
                echo view('coordinator/login',['validation' => $this->validator]);

            }else{
                //perform authentication

                $username =  $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $userModel = new UserModel();
                $coordinatorData = $userModel->coordinator($username, $password);

                if(empty($coordinatorData)){
                    $data = [
                        'error' => 'Invalid username or password'
                    ];
                    echo view('coordinator/login', $data);
                }else{
                    // echo $als_coord_data['is_evaluated'];
                    if($coordinatorData['isActivated'] == 0 || $coordinatorData['is_evaluated'] == 0){
                        $data = [
                            'error' => 'Your account is must be activated and evaluated'
                        ];
                        echo view('coordinator/login', $data);
                    }
                    if($coordinatorData['isActivated'] == 1 && $coordinatorData['is_evaluated'] == 1){
                        $sessionData = [
                            'user_id' => $coordinatorData['user_id'],
                            'username' => $coordinatorData['username'],
                        ];
                        $userModel->update_status($coordinatorData['user_id'], 1);
                        $session->set('coordinator_id', $sessionData['user_id']);
                        $session->set('passkey', $password);

                        //set cookie

                        if($this->request->getPost('cookie') == 1){
                            set_cookie('usn', $username, 3000);
                            set_cookie('pass', $password, 3000);
                        }
                        
                        return redirect()->to(base_url('coordinator/home'));
                    } 
                }


            }
        }

        public function update_password()
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to('coordinator/login')->with('fail', 'You must sign in first');
            }
            $coordinator_id = $session->get('coordinator_id');
            if($this->request->getMethod() == 'post'){
                $username = $this->request->getPost('username');
                $old_password = $this->request->getPost('old_password');
                $new_password = $this->request->getpost('new_password');

                $coordinatorModel = new CoordinatorModel();

                $isExist = $coordinatorModel->check_current_password($username, $old_password);
                if($isExist == true){
                    $isUpdated = $coordinatorModel->update_current_password($coordinator_id, $username, password_hash($new_password, PASSWORD_BCRYPT));
                    if($isUpdated == true){
                        $data = [
                            'class' => 'alert-success',
                            'message' => 'Password Updated Successfully'
                        ];
                        echo json_encode($data);
                    }else{
                        $data = [
                            'class' => 'alert-danger',
                            'message' => 'Failed to update password'
                        ];
                        echo json_encode($data);
                    }
                }else{
                    $data = [
                        'class' => 'alert-danger',
                        'message' => 'Current Password Doesn\'t match'
                    ];
                    echo json_encode($data);
                }
            }else{
                return redirect()->to('coordinator/login')->with('fail', 'You must sign in');
            }
        }

        public function dashboard()
        {
            $page = 'dashboard';
            if (! is_file(APPPATH . 'Views/coordinator/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
            }
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');
            $coordinatorModel = new CoordinatorModel();

            $c_loc = $coordinatorModel->get_brgy($coordinator_id);


            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'active_user' => $coordinatorModel->count_active_user($coordinator_id),
                'inactive_user' => $coordinatorModel->count_inactive_user($coordinator_id),
                'count_user' => $coordinatorModel->count_user($coordinator_id),
                'users' => $coordinatorModel->select_user($coordinator_id),
                'all_oscya' => $coordinatorModel->count_oscya($c_loc->barangay),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'indexes' => ['title' => 'DASHBOARD'],
                'count_tasks' => $coordinatorModel->count_tasks($coordinator_id),
                'assigned_tasks' => $coordinatorModel->select_assigned_task($coordinator_id),
                'activities' => $coordinatorModel->select_activities($coordinator_id)
            ];

            echo view('coordinator/templates/header', $data);
            echo view('coordinator/dashboard', $data);
            echo view('coordinator/templates/footer', $data);
        }

        public function notification()
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');
            $coordinatorModel = new CoordinatorModel();
            echo json_encode($coordinatorModel->select_notification($coordinator_id));
        }

        public function staff()
        {
            $page = 'staff';
            if (! is_file(APPPATH . 'Views/coordinator/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
            }
            //get all Staff associated in the coordinator

            $session = \Config\Services::session();
            if(!empty($session->get('coordinator_id'))){
                $coordinator_id = $session->get('coordinator_id');
                $coordinatorModel = new CoordinatorModel();

                $data = [
                    'title' => 'Staff List',
                    'staffs' => $coordinatorModel->select_staff($coordinator_id),
                    'c_info' => $coordinatorModel->info($coordinator_id),
                    'c_contact' => $coordinatorModel->contact($coordinator_id),
                    'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                    'indexes' => ['title' => 'STAFF']
                ];

                echo view('coordinator/templates/header', $data);
                echo view('coordinator/staff', $data);
                echo view('coordinator/templates/footer');
            }else{
                return redirect()->to(base_url('coordinator/login'));
            }

        }

        public function search_staff($staff_id)
        {
            $session = \Config\Services::session();

            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');
            $coordinatorModel = new CoordinatorModel();
            $user = $coordinatorModel->search_account($coordinator_id, $staff_id);

            echo json_encode($user);

        }

        public function validate_staff()
        {
            
                $session = \Config\Services::session();

                if(empty($session->get('coordinator_id'))){
                    return redirect()->to(base_url('coordinator/login'));
                }
                $coordinator_id = $session->get('coordinator_id');
                $coordinatorModel = new CoordinatorModel();
                

                $coordData = $coordinatorModel->select_brgy_profile($coordinator_id);

                $data = [
                    'register' => $coordinatorModel->select_staff_registration_info($coordData['barangay']),
                    'pending' => $coordinatorModel->select_pending_registration_info($coordData['barangay']),
                    'approved' => $coordinatorModel->select_approved_registration_info($coordData['barangay']),
                    'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                    'c_info' => $coordinatorModel->info($coordinator_id),
                    'c_contact' => $coordinatorModel->contact($coordinator_id),
                    'staffs' => $coordinatorModel->select_staff($coordinator_id),
                    'indexes' => ['title' => 'REGISTRATION']
                ];

                echo view('coordinator/templates/header', $data);
                echo view('coordinator/validate_staff', $data);
                echo view('coordinator/templates/footer', $data);
            
        }
        
        public function view_registration($staff_id)
        {
            $page = 'view_staff_reg';
            if (! is_file(APPPATH . 'Views/coordinator/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
            }
            $session = \Config\Services::session();

            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            
            $coordinator_id = $session->get('coordinator_id');
            $coordinatorModel = new CoordinatorModel();
            $isExist = $coordinatorModel->view_staff_acc($staff_id);
            if(empty($isExist)){
                throw new \CodeIgniter\Exceptions\PageNotFoundException($staff_id . ' user does not exist');
            }
            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'staff' => $coordinatorModel->view_staff_registration_info($staff_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'indexes' => ['title' => 'REGISTRATION']
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/view_staff_reg', $data);
            echo view('coordinator/templates/footer');
        }

        public function email_temp($data)
        {
            return view('coordinator/email_temp', $data);
        }

        public function save_evaluation()
        {

            $session = \Config\Services::session();

            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            
            $coordinator_id = $session->get('coordinator_id');

            if($this->request->getMethod()=='post'){
                //print_r($this->request->getPost());

                $staff_email = $this->request->getPost('email');
                $staff_id = $this->request->getPost('staff_id');
                $act_code = $this->request->getPost('act_code');
                $resubmit = $this->request->getPost('resubmit');
                $remarks = $this->request->getPost('remarks');

                if($resubmit == 1){
                    $email = \Config\Services::email();
                    $email->setFrom('alsecollaboration@alsgov.com', $coordinator_id);
                    $email->setTo($staff_email);
                    $email->setSubject('Email Test');
                    
                    $data = [
                        'header' => ['content' => 'Brgy. Staff Account' ],
                        'sub_header' =>['content' => 'Resubmit your barangay staff registration credential' ],
                        'message' => ['content' => 'Resubmit Valid ID'],
                        'contents' => ['content' => $remarks],
                        'links' => ['link_1' => base_url('registration/update_id') . '/' . $staff_id],
                        'link_label' => ['label_1' => 'Validate your ID']
                    ];
        
                    $email->setMessage($this->email_temp($data));
                    if($email->send()){
                        $coordinatorModel = new CoordinatorModel();
                        $isUpdated = $coordinatorModel->resubmit_id($staff_id, $coordinator_id);
                        if($isUpdated){
                            return redirect()->to('coordinator/validate_staff')->with('info', 'Pending for Re-evaluation ');
                        }else{
                            return redirect()->to('coordinator/validate_staff')->with('fail', 'Can\'t evaluate registration info');
                        }
                    }else{
                        return redirect()->to('coordinator/validate_staff')->with('fail', 'Invalid Email Address');
                    }
                }else{
                    $email = \Config\Services::email();
                    $email->setFrom('alsecollaboration@alsgov.com', $coordinator_id);
                    $email->setTo($staff_email);
                    $email->setSubject('Email Test');
                    
                    $data = [
                        'header' => ['content' => 'Brgy. Staff Account' ],
                        'sub_header' =>['content' =>  $act_code ],
                        'message' => ['content' => "Your activation code: " ],
                        'contents' => ['content' => $remarks],
                        'links' => ['link_1' => base_url('staff/activate') .'/'.$coordinator_id . '/' . $staff_id ],
                        'link_label' => ['label_1' => 'Activate your account']
                    ];
        
                    $email->setMessage($this->email_temp($data));
                    if($email->send()){
                        $coordinatorModel = new CoordinatorModel();
                        $isUpdated = $coordinatorModel->update_is_evaluated($staff_id, $coordinator_id);
                        $is_resubmit = $coordinatorModel->update_resubmit_id($staff_id, $coordinator_id);
                        if($isUpdated == true && $is_resubmit == true) {
                            return redirect()->to('coordinator/validate_staff')->with('success', 'Staff Account Validated');
                        }else{
                            return redirect()->to('coordinator/validate_staff')->with('fail', 'Can\'t evaluate registration info');
                        }
                    }else{
                        return redirect()->to('coordinator/validate_staff')->with('fail', 'Invalid Email Address');
                    }
                }
            }
        }
        
        public function view_staff($staff_id)
        {
            $page = 'view_staff';
            if (! is_file(APPPATH . 'Views/coordinator/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
            }
            $coordinatorModel = new CoordinatorModel();
            $isExist = $coordinatorModel->view_staff_acc($staff_id);
            if(empty($isExist)){
                throw new \CodeIgniter\Exceptions\PageNotFoundException($staff_id . ' user does not exist');
            }
            $session = \Config\Services::session();
            if(!empty($session->get('coordinator_id'))){
                
                $staffModel = new StaffModel();

                $coordinator_id = $session->get('coordinator_id');
                $c_loc = $coordinatorModel->get_brgy($coordinator_id);
                $c_contact = $coordinatorModel->contact($coordinator_id);
                $data = [
                    'staffs' => $coordinatorModel->select_staff($coordinator_id),
                    'total_record' =>$staffModel->count_record($staff_id),
                    'all_oscya' => $coordinatorModel->count_oscya($c_loc->barangay),
                    'account' => $coordinatorModel->view_staff_acc($staff_id),
                    'info' => $coordinatorModel->view_staff_info($staff_id),
                    'contact' => $coordinatorModel->view_staff_contact($staff_id),
                    'c_info' => $coordinatorModel->info($coordinator_id),
                    'c_contact' => $c_contact,
                    'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                    'male_count' => $staffModel->count_male($staff_id),
                    'female_count' => $staffModel->count_female($staff_id),
                    'ages' => $staffModel->count_ages($staff_id),
                    'staff_info' => $staffModel->staff_info($staff_id),
                    'pages' => ['page'=>'view_staff'],
                    'facilities' => $coordinatorModel->select_facilities($coordinator_id),
                    'teachers' => $coordinatorModel->select_teacher($c_contact['district']),
                    'staff' => ['id' => $staff_id],
                    'isTask' => ['res' => $coordinatorModel->check_is_task($staff_id)],
                    'indexes' => ['title' => 'STAFF']
                ];

                    echo view('coordinator/templates/header', $data);
                    echo view('coordinator/view_staff', $data);
                    echo view('coordinator/templates/footer');

            }else{
                return redirect()->to(base_url('coordinator/login'));
            }
        }

        public function assign_task()
        {
            $session = \Config\Services::session();

            if(empty($session->get('coordinator_id'))){
                return redirect()->to('coordinator/login');
            }

            $coordinator_id = $session->get('coordinator_id');

            if($this->request->getMethod()=='post'){
                $coordinatorModel = new coordinatorModel();
                $staff_id = $this->request->getPost('staff_id');
                $teacher_id = $this->request->getPost('teacher_id');
                $facility_id = $this->request->getPost('facility_id');
                $schedule_date = $this->request->getPost('schedule_date');
                $start_time = $this->request->getPost('start_time');
                $end_time = $this->request->getPost('end_time');
                $activity_id = $this->generate_act_id($coordinatorModel);
                $title = $this->request->getPost('title');
                $description = $this->request->getPost('description');
                
                $isAssigned = $coordinatorModel->insert_teacher_task($coordinator_id, $staff_id, $teacher_id, $facility_id, $schedule_date, $start_time, $end_time);
                $isScheduled = $coordinatorModel->insert_counseling_sched($facility_id, $activity_id, $teacher_id, $schedule_date, $start_time, $end_time, $title, $description);
                if($isAssigned == true &&  $isScheduled == true){
                    return redirect()->to('coordinator/view_staff' . '/' . $staff_id)->with('success', 'Task successfully added');
                }else{
                    return redirect()->to('alscoordinator/view_staff' . '/' . $staff_id)->with('fail', 'Failed to add task');
                }
            }
        }

        public function save_changes()
        {
            $session = \Config\Services::session();
            if(!empty($session->get('coordinator_id'))){

                $staff_id = $this->request->getPost('user_id');
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('new_password');

                $coordinatorModel = new CoordinatorModel();
                $isEdited =  $coordinatorModel->edit_staff($staff_id, $username, password_hash($password, PASSWORD_BCRYPT));

                if($isEdited == true){
                    // $message = 'Edited successfully';
                    // return redirect()->to(base_url('coordinator/view_staff' .'/'. $staff_id . '/' . $message));
                    $message = [
                        'class' => 'alert-success',
                        'message' => 'Changes saved'
                    ];
                    echo json_encode($message);
                }else{
                    $message = [
                        'class' => 'alert-danger',
                        'message' => 'Failed to save changes'
                    ];
                    echo json_encode($message);
                }
            }else{
                return redirect()->to(base_url('coordinator/login'));
            }
        }

        public function create_staff()
        {
            $session = \Config\Services::session();
            $coordinatorModel = new CoordinatorModel();

            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');
            $c_info = $coordinatorModel->info($coordinator_id);
            $c_contact = $coordinatorModel->contact($coordinator_id);
            $brgy_profile = $coordinatorModel->select_brgy_profile($coordinator_id);
            $data = [
                'c_info' => $c_info,
                'c_contact' => $c_contact,
                'brgy_profile' => $brgy_profile,
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'indexes' => ['title' => 'STAFF']
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/add_staff', $data);
            echo view('coordinator/templates/footer', $data);
        }

        public function message($activation_code)
        {
            $data = [
                'activation_code' => $activation_code,
            ];
            echo view('coordinator/email_message', $data);
        }

        public function save_staff()
        {
            $session = \Config\Services::session();

            if(!empty($session->get('coordinator_id'))){

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
                        ],
                        'email' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Email Required',
                        ]
                    ]
                ]);
                if(!$validation){
                    $coordinatorModel = new CoordinatorModel();
                    $coordinator_id = $session->get('coordinator_id');
                    $c_info = $coordinatorModel->info($coordinator_id);
                    $c_contact = $coordinatorModel->contact($coordinator_id);
                    $brgy_profile = $coordinatorModel->select_brgy_profile($coordinator_id);
                    $data = [
                        'c_info' => $c_info,
                        'c_contact' => $c_contact,
                        'brgy_profile' => $brgy_profile
                    ];
            
                    //redirect to login with validation messages
                    echo view('coordinator/templates/header', $data);
                    echo view('coordinator/add_staff',['validation' => $this->validator]);
                    echo view('coordinator/templates/footer');

                }else{

                    $coordinatorModel = new CoordinatorModel();


                    $coordinator_id = $session->get('coordinator_id');
                    $data = $coordinatorModel->contact($coordinator_id);
                    $staff_id =  generate_sid($coordinatorModel);
                    $username = $this->request->getPost('username');
                    $password = $this->request->getPost('password');
                    $staff_email = $this->request->getPost('email');
                    $activation_code = generate_activation_code($coordinatorModel);

                    $barangay = $data['barangay'];

                    $image = $this->request->getFile('image') == [] ? $imagePath = $image = '' : $this->request->getFile('image');
                    if($image->isValid() && !$image->hasMoved()){
                        $imagePath = $staff_id . '.' . $image->getClientExtension();
                        $image->move(FCPATH . "uploads\assets\profiles\\" .  $staff_id , $imagePath );
                    }



                    $isInserted = $coordinatorModel->insertStaff( $staff_id, $coordinator_id, $username, $password, $staff_email, $activation_code, $staff_id .'/'. $imagePath, $barangay);
                    if($isInserted){

                        
                        $email = \Config\Services::email();

                        $email->setFrom('alsecollaboration@alsgov.com', $coordinator_id);
                        $email->setTo($staff_email);
                        

                        $email->setSubject('Email Test');
                        $email->setMessage(
                            `<h1>ALS Staff Account</h1>
                            <h3>Your activation code: ` . $activation_code . `</h3>`
                        );

                        if($email->send())
                        {
                            $c_info = $coordinatorModel->info($coordinator_id);
                            $c_contact = $coordinatorModel->contact($coordinator_id);
                            $brgy_profile = $coordinatorModel->select_brgy_profile($coordinator_id);
                            $data = [
                                'c_info' => $c_info,
                                'c_contact' => $c_contact,
                                'brgy_profile' => $brgy_profile,
                                'message' => 'Account Successfully Created'
                            ];
                            echo view('coordinator/templates/header', $data);
                            echo view('coordinator/add_staff', $data);
                            echo view('coordinator/templates/footer', $data);
                        }else{
                            $c_info = $coordinatorModel->info($coordinator_id);
                            $c_contact = $coordinatorModel->contact($coordinator_id);
                            $brgy_profile = $coordinatorModel->select_brgy_profile($coordinator_id);
                            $data = [
                                'c_info' => $c_info,
                                'c_contact' => $c_contact,
                                'brgy_profile' => $brgy_profile,
                                'error' => 'Can\'t create staff account'
                            ];
                            echo view('coordinator/templates/header', $data);
                            echo view('coordinator/add_staff', $data);
                            echo view('coordinator/templates/footer', $data);
                        }
                        
                        
                    
                    }else{
                        $c_info = $coordinatorModel->info($coordinator_id);
                        $c_contact = $coordinatorModel->contact($coordinator_id);
                        $brgy_profile = $coordinatorModel->select_brgy_profile($coordinator_id);
                        $data = [
                            'c_info' => $c_info,
                            'c_contact' => $c_contact,
                            'brgy_profile' => $brgy_profile,
                            'error' => 'Can\'t create staff account'
                        ];
                        echo view('coordinator/templates/header', $data);
                        echo view('coordinator/add_staff', $data);
                        echo view('coordinator/templates/footer', $data);
                    }
                }
            }else{
                return redirect()->to(base_url('coordinator/login'));
            }
        }

        public function teacher()
        {
            $session = \Config\Services::session();
            $coordinatorModel = new CoordinatorModel();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');

            $c_contact = $coordinatorModel->contact($coordinator_id);
            
            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'teachers' => $coordinatorModel->select_teacher($c_contact['district']),
                'coordinator_id' => $coordinator_id,
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $c_contact,
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'indexes' => ['title' => 'TEACHER']
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/teacher', $data);
            echo view('coordinator/templates/footer');
        }

        public function view_teacher($teacher_id)
        {
            $session = \Config\Services::session();
            $coordinatorModel = new CoordinatorModel();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');

            $c_contact = $coordinatorModel->contact($coordinator_id);
            $isExist = $coordinatorModel->check_teacher($teacher_id);
            if(empty($isExist)){
                throw new \CodeIgniter\Exceptions\PageNotFoundException($teacher_id . ' teacher does not exist');
            }
            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'coordinator_id' => $coordinator_id,
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $c_contact,
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'teacher_info' => $coordinatorModel->select_teacher_info($teacher_id),
                'teacher_contact' => $coordinatorModel->select_teacher_contact($teacher_id),
                'teacher_credential' => $coordinatorModel->select_teacher_credential($teacher_id),
                'indexes' => ['title' => 'TEACHER']
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/view_teacher', $data);
            echo view('coordinator/templates/footer');
        }
        
        public function announcement()
        {
            $session = \Config\Services::session();
            $coordinatorModel = new CoordinatorModel();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');
            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'coordinator_id' => $coordinator_id,
                'annnouncement' => $coordinatorModel->selectAnnouncements($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'indexes' => ['title' => 'STAFF']
            ];
            
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/announcement', $data);
            echo view('coordinator/templates/footer');
            

            
        }

        public function create_announcement()
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }

            if($this->request->getMethod() == 'post'){
                $coordinator_id = $session->get('coordinator_id');
                $content =  $this->request->getPost('content') ;
                $audience =  $this->request->getPost('audience') ;
                $imageName = $image_loc = "";
                if($this->request->getFile('image') == [])
                {
                    $image = "";
                }
                else{
                    $image = $this->request->getFile('image');
                    if($image->isValid() && !$image->hasMoved()){
                        $imageName = $image->getRandomName();
                        $image->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $imageName );
                        $image_loc = $coordinator_id . '/' . $imageName;

                    }
                }
                $coordinatorModel = new CoordinatorModel();
                $isCreated = $coordinatorModel->insertAnnouncement($coordinator_id, $content, $audience, $image_loc);

                if($isCreated == true){
                    echo 'post created';
                }else{
                    echo 'post not created';
                }
            }

        }

        public function edit_announcement($id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinatorModel = new CoordinatorModel();
            $coordinator_id = $session->get('coordinator_id');
            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'coordinator_id' => $coordinator_id,
                'id' => $id,
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'indexes' => ['title' => 'STAFF']
            ];
            
                echo view('coordinator/templates/header', $data);
                echo view('coordinator/edit_announcement', $data);
                echo view('coordinator/templates/footer');
            
        }

        public function edit_announcement_content($id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
           
            $coordinatorModel = new CoordinatorModel();
            $coordinator_id = $session->get('coordinator_id');

            if($this->request->getMethod() == "post"){
                $content = $this->request->getPost('content');
                $audience = $this->request->getPost('audience');
                if($coordinatorModel->select_announcement($coordinator_id, $id) == false){
                    return redirect()->to('coordinator/announcement')->with('failed', 'Announcement does not exist');
                }else{
                    $isQueried = $coordinatorModel->edit_announcement_content($coordinator_id, $id, $content, $audience);
                    if($isQueried == true){
                        $data = [
                            'class' => 'alert-success',
                            'message' => 'edited'
                        ];
                        echo json_encode($data);
                    }else{
                        $data = [
                            'alert' => 'alert-danger',
                            'message' => 'Unable to Edit Announcement Content'
                        ];
                        echo json_encode($data);
                    }
                }
            }else{
                $data = [
                    'alert' => 'alert-danger',
                    'message' => 'Announcement Does not Exists'
                ];
                echo json_encode($data);
            }
        }

        public function edit_announcement_image($id){
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinatorModel = new CoordinatorModel();
            $coordinator_id = $session->get('coordinator_id');

            if($this->request->getMethod()=="post"){
                $image = $this->request->getFile('image');

                if(empty($image->getName())){
                    return redirect()->to(base_url('coordinator/edit_announcement') . "/" . $id)->with('fail', 'Image is empty');
                }else{
                    if($image->isValid() && !$image->hasMoved()){
                        $imageName = $image->getRandomName();
                        $image->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $imageName );
                        $image_loc = $coordinator_id . '/' . $imageName;
                    }else{
                        $image_loc = "";
                    }
        
                    $isUpdated = $coordinatorModel->edit_announcement_image($coordinator_id, $id, $image_loc);
                    if($isUpdated){
                        return redirect()->to(base_url('coordinator/edit_announcement') . "/" . $id)->with('success', 'Image Updated ');
                    }else{
                        return redirect()->to(base_url('coordinator/edit_announcement') . "/" . $id)->with('fail', 'failed to update image');
                    }
                }
            }
        }

        public function backup()
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');
            $coordinatorModel = new CoordinatorModel();
            $c_contact = $coordinatorModel->contact($coordinator_id);
            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'backups' => $coordinatorModel->select_backups($coordinator_id),
                'indexes' => ['title' => 'BACKUP']
            ];
            $validation = $this->validate([
                'backup_type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Backup type Required'
                    ]
                ],
                'date_from' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Required'
                    ]
                ],
                'date_to' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Required'
                    ]
                ],
            ]);
            if($this->request->getMethod()=='post'){
                $data = [
                    'validation' => $this->validator,
                    'staffs' => $coordinatorModel->select_staff($coordinator_id),
                    'c_info' => $coordinatorModel->info($coordinator_id),
                    'c_contact' => $coordinatorModel->contact($coordinator_id),
                    'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                    'backups' => $coordinatorModel->select_backups($coordinator_id)
                ];
                if(!$validation){
                    echo view('coordinator/templates/header', $data);
                    echo view('coordinator/backup', $data);
                    echo view('coordinator/templates/footer');
                }else{
                    
                    $backup_type = $this->request->getPost('backup_type');
                    $date_from = $this->request->getPost('date_from');
                    $date_to = $this->request->getPost('date_to');
                

                    $osya_records = $coordinatorModel->backup_osy_mapping($c_contact['barangay'], $date_from, $date_to);


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
                    $spreadsheet->getActiveSheet()->getColumnDimension('x')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
                    $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);

                    $spreadsheet->getActiveSheet()->getStyle('A5:AG5')->applyFromArray($spsheetHeader);

                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->setCellValue('A5', 'OSY ID');
                    $sheet->setCellValue('B5', 'Staff ID');
                    $sheet->setCellValue('C5', 'Lastname');
                    $sheet->setCellValue('D5', 'Firstname');
                    $sheet->setCellValue('E5', 'Middlename');
                    $sheet->setCellValue('F5', 'Name Extension');
                    $sheet->setCellValue('G5', 'Birthdate');
                    $sheet->setCellValue('H5', 'Age');
                    $sheet->setCellValue('I5', 'Gender');
                    $sheet->setCellValue('J5', 'Civil Status');
                    $sheet->setCellValue('K5', 'Religion');
                    $sheet->setCellValue('L5', 'Email');
                    $sheet->setCellValue('M5', 'Contact');
                    $sheet->setCellValue('N5', 'Facebook');
                    $sheet->setCellValue('O5', 'Street');
                    $sheet->setCellValue('P5', 'Barangay');
                    $sheet->setCellValue('Q5', 'Guardian Fullname');
                    $sheet->setCellValue('R5', 'Guardian Email');
                    $sheet->setCellValue('S5', 'Guardian Contact');
                    $sheet->setCellValue('T5', 'Guardian Facebook');
                    $sheet->setCellValue('U5', 'LRN');
                    $sheet->setCellValue('V5', 'Educational Attainment');
                    $sheet->setCellValue('W5', 'Reason');
                    $sheet->setCellValue('X5', 'Other reason');
                    $sheet->setCellValue('Y5', 'Disability');
                    $sheet->setCellValue('Z5', 'PWD');
                    $sheet->setCellValue('AA5', 'Has PWD ID');
                    $sheet->setCellValue('AB5', 'Other Disability');
                    $sheet->setCellValue('AC5', 'Disease');
                    $sheet->setCellValue('AD5', 'Is Employed');
                    $sheet->setCellValue('AE5', 'Is 4ps Member');
                    $sheet->setCellValue('AF5', 'Is interested`');
                    $sheet->setCellValue('AG5', 'Mapping Date');
                    $rows = 6;
                    foreach($osya_records as $oscya){
                        $sheet->setCellValue('A' . $rows , $oscya['oscya_id']);
                        $sheet->setCellValue('B' . $rows , $oscya['user_id']);
                        $sheet->setCellValue('C' . $rows , $oscya['lastname']);
                        $sheet->setCellValue('D' . $rows , $oscya['firstname']);
                        $sheet->setCellValue('E' . $rows , $oscya['middlename']);
                        $sheet->setCellValue('F' . $rows , $oscya['extension']);
                        $sheet->setCellValue('G' . $rows , $oscya['birthdate']);
                        $sheet->setCellValue('H' . $rows , $oscya['age']);
                        $sheet->setCellValue('I' . $rows , $oscya['gender']);
                        $sheet->setCellValue('J' . $rows , $oscya['civil_status']);
                        $sheet->setCellValue('K' . $rows , $oscya['religion']);
                        $sheet->setCellValue('L' . $rows , $oscya['email']);
                        $sheet->setCellValue('M' . $rows , $oscya['contact']);
                        $sheet->setCellValue('N' . $rows , $oscya['facebook']);
                        $sheet->setCellValue('O' . $rows , $oscya['street']);
                        $sheet->setCellValue('p' . $rows , $oscya['brgy']);
                        $sheet->setCellValue('Q' . $rows , $oscya['fullname']);
                        $sheet->setCellValue('R' . $rows , $oscya['g_email']);
                        $sheet->setCellValue('S' . $rows , $oscya['g_contact']);
                        $sheet->setCellValue('T' . $rows , $oscya['g_facebook']);
                        $sheet->setCellValue('U' . $rows , $oscya['lrn']);
                        $sheet->setCellValue('V' . $rows , 'Grade' . $oscya['educ_attainment']);
                        $sheet->setCellValue('W' . $rows , $oscya['reason']);
                        $sheet->setCellValue('X' . $rows , $oscya['other_reason']);
                        $sheet->setCellValue('Y' . $rows , $oscya['disability']);
                        $sheet->setCellValue('Z' . $rows , $oscya['is_pwd'] == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AA' . $rows , $oscya['has_pwd_id'] == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AB' . $rows , $oscya['other_disability']);
                        $sheet->setCellValue('AC' . $rows , $oscya['disease']);
                        $sheet->setCellValue('AD' . $rows , $oscya['is_employed'] == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AE' . $rows , $oscya['is_fps_member']  == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AF' . $rows , $oscya['is_interested']  == 1 ? 'Yes' : 'No');
                        $sheet->setCellValue('AG' . $rows , $oscya['mapping_date']);
                        $rows++;
                    } 
                    
                    $writer = new Xlsx($spreadsheet);
                    $backup_name = uniqid();
                    if (!is_dir(FCPATH . "uploads/backups/" . $coordinator_id . '/')) {
                        mkdir(FCPATH . "uploads/backups/" . $coordinator_id . '/', 0777, TRUE);
                        $path = FCPATH . "uploads/backups/" . $coordinator_id . '/' . $backup_name . '.xlsx';
                        $writer->save($path);
                        $isCreated = $coordinatorModel->insert_backup_info($coordinator_id, $backup_name, $date_from, $date_to, $backup_type, $coordinator_id . '/'. $backup_name . '.xlsx');
                        if($isCreated == true){
                            return redirect()->to('coordinator/backup')->with('success', 'File Created');
                        }else{
                            return redirect()->to('coordinator/backup')->with('fail', 'Failed to create Backup file');
                        }
                    }else if(is_dir(FCPATH . "uploads/backups/" . $coordinator_id . '/')){
                        $path = FCPATH . "uploads/backups/" . $coordinator_id . '/' . $backup_name . '.xlsx';
                        $writer->save($path);
                        $isCreated = $coordinatorModel->insert_backup_info($coordinator_id, $backup_name, $date_from, $date_to, $backup_type, $coordinator_id . '/'. $backup_name . '.xlsx');
                        if($isCreated == true){
                            return redirect()->to('coordinator/backup')->with('success', 'File Created');
                        }else{
                            return redirect()->to('coordinator/backup')->with('fail', 'Failed to create Backup file');
                        }
                    }else{
                        return redirect()->to('coordinator/backup')->with('fail', 'Failed to create Backup file');
                    }
                }
            }else{
                echo view('coordinator/templates/header', $data);
                echo view('coordinator/backup', $data);
                echo view('coordinator/templates/footer');
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

        public function migration()
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');
            $coordinatorModel = new CoordinatorModel();
            $c_contact = $coordinatorModel->contact($coordinator_id);
            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $c_contact,
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'teachers' => $coordinatorModel->select_teacher($c_contact['district']),
                'facilities' => $coordinatorModel->select_facilities($coordinator_id),
                'indexes' => ['title' => 'MIGRATION']
                
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/migration', $data);
            echo view('coordinator/templates/footer', $data);
        }

        public function migrate_data()
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');
            
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
                                        $this->generate_oid(), 
                                        $staff_id, 
                                        $teacher_id, 
                                        $row[1] == "" ? ' ' : $row[1], // fullname
                                        $row[2] == "" ? ' ' : $row[2] ,//age
                                        $row[3] == "" ? ' ' : date('Y-m-d', strtotime($row[3])), // Birthdate
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
                        return redirect()->to(base_url('coordinator/migration'))->with('success', 'Data uploaded successfully');
                    }
                    
                }else{
                    return redirect()->to(base_url('coordinator/migration'))->with('fail', $message);
                }
                // print_r($templateHeader);
            }else{
                return redirect()->to(base_url('coordinator/migration'))->with('fail', 'File should be in xls, xlsx and csv format');
            }
        }

        public function my_account()
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinator_id = $session->get('coordinator_id');

            $coordinatorModel = new CoordinatorModel();

            $data =[
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'c_account' => $coordinatorModel->account($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'indexes' => ['title' => 'ACCOUNT']
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/account', $data);
            echo view('coordinator/templates/footer', $data);
            // echo '<pre>';
            // print_r($data);
        }

        public function edit_picture()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }

            $coordinatorModel = new CoordinatorModel();

            $coordinator_id = $session->get('coordinator_id');
            $image = $this->request->getFile('image');
            if($image->isValid() && !$image->hasMoved()){
                $imageName = $image->getRandomName();
                $image->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $imageName );
                $image_loc = $coordinator_id . '/' . $imageName;

                $coordinatorModel->edit_profile_pic($coordinator_id, $image_loc);
                return redirect()->to(base_url('coordinator/account'));
            }else{
                return redirect()->to(base_url('coordinator/account'));
            }

        }

        public function edit_credentials()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }

            $coordinator_id = $session->get('coordinator_id');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $coordinatorModel = new CoordinatorModel();

            $isQueried = $coordinatorModel->edit_account($coordinator_id, $username, $password);

            if($isQueried == true){
                $data = [
                    'class' => 'alert-success',
                    'message' => 'Updated Successfully'
                ];
                echo json_encode($data);
            }else{
                $data = [
                    'class' => 'alert-danger',
                    'message' => 'Failed to Update Account'
                ];
                echo json_encode($data);
            }
        }

        public function edit_contact_details()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }

            $coordinator_id = $session->get('coordinator_id');
            $email = $this->request->getPost('email');
            $contact_no = $this->request->getPost('contact_no');
            $facebook = $this->request->getPost('facebook');
            $street = $this->request->getPost('street');
            $barangay = $this->request->getPost('barangay');
            $district = $this->request->getPost('district');
            $zip_code = $this->request->getPost('zip_code');
            $city = $this->request->getPost('city');

            $coordinatorModel = new CoordinatorModel();
            $isQueried = $coordinatorModel->edit_contact($coordinator_id, $email, $contact_no, $facebook, $street, $barangay, $district, $zip_code,  $city);

            if($isQueried == true){
                $data = [
                    'class' => 'alert-success',
                    'message' => 'Updated Successfully'
                ];
                echo json_encode($data);
            }else{
                $data = [
                    'class' => 'alert-danger',
                    'message' => 'Failed to update'
                ];
                echo json_encode($data);
            }

        }

        public function edit_info_details()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }

            $coordinator_id = $session->get('coordinator_id');
            $lastname = $this->request->getPost('lastname');
            $firstname = $this->request->getPost('firstname');
            $middlename = $this->request->getPost('middlename');
            $suffix = $this->request->getPost('suffix');
            $birth = $this->request->getPost('birth');
            $age = $this->request->getPost('age');
            $gender = $this->request->getPost('gender');
            $civil_status = $this->request->getPost('civil_status');
            $religion = $this->request->getPost('religion');



            $coordinatorModel = new CoordinatorModel();
            $isQueried = $coordinatorModel->edit_info($coordinator_id, $lastname, $firstname, $middlename, $suffix, $birth, $age, $gender, $civil_status, $religion);

            if($isQueried == true){
                $data = [
                    'class' => 'alert-success',
                    'message' => 'Updated Successfully'
                ];
                echo json_encode($data);
            }else{
                $data = [
                    'class' => 'alert-danger',
                    'message' => 'Failed to update'
                ];
                echo json_encode($data);
            }

        }

        public function settings()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }


            $coordinatorModel = new CoordinatorModel();

            $coordinator_id = $session->get('coordinator_id');
            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'indexes' => ['title' => 'SETTINGS']
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/settings', $data);
            echo view('coordinator/templates/footer', $data);
        }

        public function edit_settings()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }

            $coordinator_id = $session->get('coordinator_id');

            $coordinatorModel = new CoordinatorModel();

            $barangay = $this->request->getPost('barangay');
            $about = $this->request->getPost('about');
            $contact_no = $this->request->getPost('contact_no');
            $address = $this->request->getPost('address');
            $from = $this->request->getPost('from');
            $to = $this->request->getPost('to');
            $email = $this->request->getPost('email');
            $facebook_page = $this->request->getPost('facebook_page');
            $official_web = $this->request->getPost('official_web');

            $logo_loc = "";
           
            $cover_photo_loc = "";
            
            $img_1 = $img_2 = "";

            $isInserted = $coordinatorModel->update_brgy_profile($coordinator_id, $barangay, $about, $address, $contact_no, $from, $to, $email, $facebook_page, $official_web, $logo_loc, $cover_photo_loc, $img_1, $img_2);

            if($isInserted){
                return redirect()->to(base_url('coordinator/settings'));
            }else{
                return redirect()->to(base_url('coordinator/settings'));
            }


        }

        public function edit_logo()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }

            $coordinator_id = $session->get('coordinator_id');

            $coordinatorModel = new CoordinatorModel();


            $logo = $this->request->getFile('logo');


            if($logo->isValid() && !$logo->hasMoved()){
                $logoName = $logo->getRandomName();
                $logo->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $logoName );
                $logo_loc = $coordinator_id . '/' . $logoName;
            }else{
                $logo_loc = "";
            }

            $isUpdated = $coordinatorModel->update_logo($coordinator_id, $logo_loc);
            if($isUpdated){
                return redirect()->to(base_url('coordinator/settings'));
            }else{
                return redirect()->to(base_url('coordinator/settings'));
            }


        }

        public function edit_cover_photo()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }

            $coordinator_id = $session->get('coordinator_id');

            $coordinatorModel = new CoordinatorModel();


            $cover_photo = $this->request->getFile('cover_photo');


            if($cover_photo->isValid() && !$cover_photo->hasMoved()){
                $coverPhotoName = $cover_photo->getRandomName();
                $cover_photo->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $coverPhotoName );
                $cover_photo_loc = $coordinator_id . '/' . $coverPhotoName;
            }else{
                $cover_photo_loc = "";
            }

            $isUpdated = $coordinatorModel->update_cover_photo($coordinator_id, $cover_photo_loc);
            if($isUpdated){
                return redirect()->to(base_url('coordinator/settings'));
            }else{
                return redirect()->to(base_url('coordinator/settings'));
            }


        }

        public function reports()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinatorModel = new CoordinatorModel();

            $coordinator_id = $session->get('coordinator_id');

            $c_contact = $coordinatorModel->contact($coordinator_id);

            $data = [
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
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/reports', $data);
            echo view('coordinator/templates/footer', $data);

        }

        public function generate_report()
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to('teacher/login');
            }
            $coordinator_id = $session->get('coordinator_id');
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
                
                $mpdf->WriteHTML($this->generate_pdf_report($purpose, $date_from, $date_to));
               
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
                        return redirect()->to('coordinator/reports')->with('success', 'Report Generated');
                    }else{
                        return redirect()->to('coordinator/reports')->with('fail', 'There\'s an Error in generating report');
                    }
                }else{
                    $mpdf->Output( FCPATH . '/uploads/reports/' . $coordinator_id . '/' . $file_name . '.pdf', "F" );
                    $isInserted = $coordinatorModel->insert_report($coordinator_id, $file_name, $purpose, $date_from, $date_to, $coordinator_id .'/'.$file_name . '.pdf');
                    if($isInserted == true){
                        return redirect()->to('coordinator/reports')->with('success', 'Report Generated');
                    }else{
                        return redirect()->to('coordinator/reports')->with('fail', 'There\'s an Error in generating report');
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
                            return redirect()->to('coordinator/reports')->with('success', 'Report Created');
                        }else{
                            return redirect()->to('coordinator/reports')->with('fail', 'Failed to create Report file');
                        }
                    }else if(is_dir(FCPATH . "uploads/reports/" . $coordinator_id . '/')){
                        $path = FCPATH . "uploads/reports/" . $coordinator_id . '/' . $file_name . '.xlsx';
                        $writer->save($path);
                        $isCreated = $coordinatorModel->insert_report($coordinator_id, $file_name, $purpose, $date_from, $date_to, $coordinator_id . '/'. $file_name . '.xlsx');
                        if($isCreated == true){
                            return redirect()->to('coordinator/reports')->with('success', 'File Created');
                        }else{
                            return redirect()->to('coordinator/reports')->with('fail', 'Failed to create Report file');
                        }
                    }else{
                        return redirect()->to('coordinator/reports')->with('fail', 'Failed to create Report file');
                    }
            }
        }

        public function generate_pdf_report($purpose, $date_from, $date_to)
        {
            $session = \Config\Services::session();
            if(empty($session->get('coordinator_id'))){
                return redirect()->to('teacher/login');
            }
            $coordinator_id = $session->get('coordinator_id');
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
            return view('coordinator/report', $data);
        }

        public function facility()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinatorModel = new CoordinatorModel();

            $coordinator_id = $session->get('coordinator_id');

            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'facilities' => $coordinatorModel->select_facilities($coordinator_id),
                'pages' => ['page'=>'facility'],
                'indexes' => ['title' => 'FACILITIES']
                
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/facility', $data);
            echo view('coordinator/templates/footer', $data);
        }

        public function save_facility()
        {
            if($this->request->getMethod() == 'post')
            {
                $session = \Config\Services::session();

                if($session->get('coordinator_id') == ""){
                    return redirect()->to(base_url('coordinator/login'));
                }
                $coordinatorModel = new CoordinatorModel();

                $coordinator_id = $session->get('coordinator_id');

                $facility_id = $this->generate_fid($coordinatorModel);
                $facility_name = $this->request->getPost('facility_name');
                $facility_location = $this->request->getPost('facility_location');
                $description = $this->request->getPost('description');
                $type = $this->request->getPost('facility_type');

                $facility_image = $this->request->getFile('facility_image');


                

                if($facility_image->isValid() && !$facility_image->hasMoved()){
                    $facility_image_name = $facility_image->getRandomName();
                    $facility_image->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $facility_image_name );
                    $facility_image_location = $coordinator_id . '/' . $facility_image_name;

                }else{
                    $facility_image_location = "";
                }

                $isAdded = $coordinatorModel->add_facility($facility_id, $coordinator_id, $facility_location, $facility_name, $description, $type, $facility_image_location);

                if($isAdded == true){
                    return redirect()->to('coordinator/facility')->with('success', 'Facility Added');
                }else{
                    return redirect()->to('coordinator/facility')->with('fail', 'Failed to add facility');
                }
            }
        }

        public function edit_facility()
        {
            if($this->request->getMethod() == 'post')
            {
                $session = \Config\Services::session();

                if($session->get('coordinator_id') == ""){
                    return redirect()->to(base_url('coordinator/login'));
                }
                $coordinatorModel = new CoordinatorModel();

                $coordinator_id = $session->get('coordinator_id');

                $facility_name = $this->request->getPost('name');
                $facility_location = $this->request->getPost('address');
                $facility_id = $this->request->getPost('facility_id');
                $description = $this->request->getPost('description');
                $type = $this->request->getPost('type');

                $facility_image = $this->request->getFile('picture');

                if($facility_image->isValid() && !$facility_image->hasMoved()){
                    $facility_image_name = $facility_image->getRandomName();
                    $facility_image->move(FCPATH . "uploads/assets/profiles/" .  $coordinator_id , $facility_image_name );
                    $facility_image_location = $coordinator_id . '/' . $facility_image_name;

                }else{
                    $facility_image_location = "";
                }

                $isAdded = $coordinatorModel->edit_facility($coordinator_id, $facility_id, $facility_location, $facility_name, $description, $type, $facility_image_location);

                if($isAdded == true){
                    return redirect()->to('coordinator/facility')->with('success', 'Facility Added');
                }else{
                    return redirect()->to('coordinator/facility')->with('fail', 'Failed to add facility');
                }
            }
        }

        public function schedules($f_id)
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinatorModel = new CoordinatorModel();

            $isExist = $coordinatorModel->check_fid($f_id);
            if(empty($isExist)){
                throw new \CodeIgniter\Exceptions\PageNotFoundException($f_id . ' facility does not exist');
            }
            $coordinator_id = $session->get('coordinator_id');

            $data = [
                'staffs' => $coordinatorModel->select_staff($coordinator_id),
                'c_info' => $coordinatorModel->info($coordinator_id),
                'c_contact' => $coordinatorModel->contact($coordinator_id),
                'brgy_profile' => $coordinatorModel->select_brgy_profile($coordinator_id),
                'activities' => $coordinatorModel->select_activity($f_id),
                'facility_info' => $coordinatorModel->select_facility_info($f_id),
                'facility' => ['id' => $f_id]
                
            ];
            echo view('coordinator/templates/header', $data);
            echo view('coordinator/schedules', $data);
            echo view('coordinator/templates/footer', $data);
        }

        public function edit_schedules($activity_id)
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }
            if($this->request->getMethod()=='post'){
                $facility_id = $this->request->getPost('facility_id');
                $title = $this->request->getPost('title'); 
                $date = $this->request->getPost('sched_date'); 
                $start = $this->request->getPost('start'); 
                $end = $this->request->getPost('end'); 
                $description = $this->request->getPost('description'); 
                $link = $this->request->getPost('link');

                $coordinatorModel = new CoordinatorModel();
                $coordinator_id = $session->get('coordinator_id');
    
                // print_r($this->request->getPost());
                $isExisted = $coordinatorModel->check_activity($activity_id);
                if($isExisted == true){
                    $isUpdated = $coordinatorModel->update_activity($activity_id, $title, $date, $start, $end, $description, $link);
                    if($isUpdated == true){
                        return redirect()->to('coordinator/schedules' . '/' . $facility_id)->with('success', 'Shedule Updated Successfully');
                    }else{
                        return redirect()->to('coordinator/schedules' . '/' . $facility_id)->with('fail', 'Failed to updated Schedule');
                    }
                }else{
                    return redirect()->to('coordinator/schedules' . '/' . $facility_id)->with('fail', 'Failed to updated Schedule');
                }
            }else{
                return redirect()->to(base_url('coordinator/login'));
            }
            
        }

        public function delete_schedules()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }
            if($this->request->getMethod()=='post'){
                $coordinatorModel = new CoordinatorModel();
                $coordinator_id = $session->get('coordinator_id');
    
                $facility_id = $this->request->getPost('facility_id');
                $activity_id = $this->request->getPost('activity_id');
                $isExisted = $coordinatorModel->check_activity($activity_id);
                if($isExisted == true){
                    $isDeleted = $coordinatorModel->delete_activity($activity_id);
                    if($isDeleted == true){
                        return redirect()->to('coordinator/schedules' . '/' . $facility_id)->with('success', 'Schedule Deleted Successfully');
                    }else{
                        return redirect()->to('coordinator/schedules' . '/' . $facility_id)->with('fail', 'Failed to Delete Schedule');
                    }
                }else{
                    return redirect()->to('coordinator/schedules' . '/' . $facility_id)->with('fail', 'Failed to Delete Schedule');
                }
            }else{
                return redirect()->to('coordinator/login')->with('fail', 'Failed to Update Schedule');
            }
        }

        public function save_activity()
        {
            $session = \Config\Services::session();

            if($session->get('coordinator_id') == ""){
                return redirect()->to(base_url('coordinator/login'));
            }
            $coordinatorModel = new CoordinatorModel();

            $coordinator_id = $session->get('coordinator_id');

            if($this->request->getMethod()=='post'){
                $coordinator_id = $session->get('coordinator_id');
                $facility_id = $this->request->getPost('facility_id');
                $activity_id = $this->generate_act_id($coordinatorModel);
                $title = $this->request->getPost('title');
                $description = $this->request->getPost('description');
                $sched_date = $this->request->getPost('sched_date');
                $start_time = $this->request->getPost('start');
                $end_time =$this->request->getPost('end');
                $link = empty($this->request->getPost('link')) ? '' : $this->request->getPost('link');

                $isInserted = $coordinatorModel->insert_activity($facility_id, $activity_id, $coordinator_id, $sched_date, $start_time, $end_time, $title, $description, $link);

                if($isInserted == true){
                    return redirect()->to('coordinator/schedules' . '/' . $facility_id)->with('success', 'Activity added successfully');
                }else{
                    return redirect()->back()->with('fail', 'Failed to create activity');
                }

            }

        }

        public function logout()
        {
            $session = \Config\Services::session();
            $userModel = new UserModel();
            $userModel->update_status($session->get('coordinator_id'), 0);
            
            $session->remove('coordinator_id');
            return redirect()->to(base_url('coordinator/login'));
        }

        public function chat()
        {
            if($this->request->getMethod()=='post'){
                $staff_id = $this->request->getPost('staff_id');
                $message = $this->request->getPost('message');
               
                $images = $this->request->getFile('addImage');

            }
        }
        
    }