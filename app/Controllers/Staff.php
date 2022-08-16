<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\OscyaModel;
use App\Models\StaffModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class Staff extends BaseController
{

    public function __construct()
    {
        helper(["url", "form"]);

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

    public function index()
    {
        $page = 'login';
        if (! is_file(APPPATH . 'Views/staff/'. $page .'.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $pageData = [
            'title' => 'Login',
            'for' => 'Staff'
        ];
        echo view ('templates/head');
        echo view('staff/login', $pageData);
        
    }

    public function activate($coordinator_id, $staff_id)
    {
        $page = 'activate_account';
        if (! is_file(APPPATH . 'Views/staff/'. $page .'.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $data = [
            'staff_id' => $staff_id,
            'coordinator_id' => $coordinator_id
        ];
        echo view('staff/activate_account', $data);
    }

    public function activation()
    {
        if($this->request->getMethod() == 'post'){
            $staff_id = $this->request->getPost('staff_id');
            $activation_code = $this->request->getPost('activation_code');
            $coordinator_id = $this->request->getPost('coordinator_id');
            $staffModel = new StaffModel();
            $code = $staffModel->check_activation_code($staff_id);
               
            if(!empty($code) && $code['activation_code'] == $activation_code)
            {
                $updateActivationStatus = $staffModel->update_activation_status($staff_id, $coordinator_id);
                if($updateActivationStatus == true){
                    return redirect()->to('staff/activate'. '/' . $coordinator_id . '/' . $staff_id)->with('success', 'Your Account successfully Activated');
                }else{
                    return redirect()->to('staff/activate'. '/' . $coordinator_id . '/' . $staff_id)->with('fail', 'Failed to activate account');
                }
            }else{
                return redirect()->to('staff/activate'. '/' . $coordinator_id . '/' . $staff_id)->with('fail', 'Invalid Activation code');
            }
        }else{
            return redirect()->to('staff/login');
        }
    }

    public function forgot_password()
    {
        if($this->request->getMethod() == 'post'){
            $staffModel = new StaffModel();
            $staff_email = $this->request->getPost('email');
            $user = $staffModel->check_email($staff_email);
            if(!empty($user)){
                $email = \Config\Services::email();

                $email->setFrom('alsecollaboration@alsgov.com', 'System');
                $email->setTo($staff_email);

                $email->setSubject('Reset Password');
                $message = '';
                $message .= '<h1 style="font-weight:bold;">Reset your ALS Coordinator Password</h1>';
                $message .= '<a href="' . base_url('staff/reset_password' . '/' . $user['user_id']) . '">Reset</a>';
                $email->setMessage($message);
                if($email->send()){
                    return redirect()->to('staff/forgot_password')->with('success', "Check your email to reset your password");
                }else{
                    return redirect()->to('staff/forgot_password')->with('fail', "Invalid Email");
                }
            }else{
                return redirect()->to('staff/forgot_password')->with('fail', "Invalid Staff");
            }
        }else{
            echo view('staff/forgot_password');
        }
    }

    public function reset_password($user_id)
    {
        if($this->request->getMethod() == 'post'){
            $new_pass = $this->request->getPost('new_pass');
            $staffModel = new StaffModel(); 
            $accData = $staffModel->account_detail($user_id);

            if(!empty($accData)){
                $isUpdated = $staffModel->update_password($user_id, password_hash($new_pass, PASSWORD_BCRYPT));
                if($isUpdated == true){
                    return redirect()->to('staff/reset_password'. '/' . $user_id )->with('success', "Check your email to reset your password");
                }else{
                    return redirect()->to('staff/reset_password'. '/' . $user_id )->with('fail', "Can't change current password");
                }
            }else{
                return redirect()->to('coordinator/login')->with('fail', 'Invalid User');
            }

        }else{
            $staffModel = new StaffModel(); 
            $accData = $staffModel->account_detail($user_id);
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
                    'required' => 'Password Required'
                ]
            ]
        ]);

        if(!$validation){
            //redirect to login with validation messages
            echo view('staff/login', ['validation' => $this->validator]);
        }else{
            //perform authentication

            $username =  $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $coordinatorData = $userModel->staff($username, $password);

            if(empty($coordinatorData)){
                return redirect()->to('staff/login')->with('fail', 'Invalid username or password');
            }else{
                // echo $als_coord_data['is_evaluated'];
                if($coordinatorData['isActivated'] == 0 || $coordinatorData['is_evaluated'] == 0){
                    return redirect()->to('staff/login')->with('fail', 'Your account is must be activated and evaluated');
                }
                if($coordinatorData['isActivated'] == 1 && $coordinatorData['is_evaluated'] == 1){
                    $sessionData = [
                        'user_id' => $coordinatorData['user_id'],
                        'username' => $coordinatorData['username'],
                    ];
                    $userModel->update_status($coordinatorData['user_id'], 1);
                    $session->set('staff_id', $sessionData['user_id']);
                    $session->set('passkey', $password);

                    //set cookie

                    if($this->request->getPost('cookie') == 1){
                        set_cookie('usn', $username, 3000);
                        set_cookie('pass', $password, 3000);
                    }
                        
                    return redirect()->to(base_url('staff/home'));
                } 
            }
        }
    }

    public function showSession()
    {
        $session = \Config\Services::session();

        print_r($session->get('staff_id'));
    }

    public function dashboard()
    {

        $page = 'dashboard';
        if (! is_file(APPPATH . 'Views/staff/'. $page .'.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $session = \Config\Services::session();

        if(empty($session->get('staff_id'))){
            return redirect()->to(base_url('staff/login'));
        }

        $staffModel = new StaffModel();

        $staff_id = $session->get('staff_id');


        $staff_info = $staffModel->staff_info($staff_id);
        $staff_contact = $staffModel->staff_contact($staff_id);
        $ages = $staffModel->count_ages($staff_id);
        $totalRecord =$staffModel->count_record($staff_id);
        $numberOfMale = $staffModel->count_male($staff_id);
        $numberOfFemale = $staffModel->count_female($staff_id);
        

        $staff_account = $staffModel->staff_account($staff_id);
        $coordinator_id = $staff_account['creator_id'];

        $data = [
            'brgy_profile' => $staffModel->select_brgy_profile($coordinator_id),
            'staff_info' => $staff_info,
            'staff_contact' => $staff_contact,
            'record' => $totalRecord->totalRecord,
            'maleCount' => $numberOfMale->Gender,
            'femaleCount' => $numberOfFemale->Gender,
            
            'ages' => $ages,
            'count_civil_status' =>$staffModel->count_civil_status($staff_id),
            'educ_attainment' => $staffModel->count_educ_attainment($staff_id),
            'reason' => $staffModel->count_reason($staff_id),
        ];
        echo view('staff/templates/header', $data);
        echo view('staff/dashboard', $data);
        echo view('staff/templates/footer');
    }

    public function data_privacy()
    {
        $page = 'data_privacy';
        if (! is_file(APPPATH . 'Views/staff/'. $page .'.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $session = \Config\Services::session();

        if($session->get('staff_id') == ''){
            return redirect()->to(base_url('staff/login'))->with('fail', 'You must login first');
        }
        $staff_id = $session->get('staff_id');
        $staffModel = new StaffModel();
        $staff_account = $staffModel->staff_account($staff_id);
        $coordinator_id = $staff_account['creator_id'];

        if($this->request->getMethod()=="post"){
            if($this->request->getPost('agree') == 1){
                return redirect()->to('staff/add_oscya');
            }else{
                return redirect()->to('staff/data_privacy');
            }
        }
        $data = [
            'brgy_profile' => $staffModel->select_brgy_profile($coordinator_id),
            'contact' => $staffModel->staff_contact($staff_id),
            'staff_info' => $staffModel->staff_info($staff_id),
            'staff_session' => $session->get('staffSessionData'),
        ];
        echo view('staff/templates/header', $data);
        echo view('staff/data_privacy', $data);
        echo view('staff/templates/footer', $data);
    }

    public function add_oscya()
    {

        $page = 'add_oscya';
        if (! is_file(APPPATH . 'Views/staff/'. $page .'.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $session = \Config\Services::session();

        if($session->get('staff_id') == ''){
            return redirect()->to(base_url('staff/login'))->with('fail', 'You must login first');
        }
        $staff_id = $session->get('staff_id');
        $staffModel = new StaffModel();
        $staff_account = $staffModel->staff_account($staff_id);
        $coordinator_id = $staff_account['creator_id'];

        $data = [
            'brgy_profile' => $staffModel->select_brgy_profile($coordinator_id),
            'contact' => $staffModel->staff_contact($staff_id),
            'staff_info' => $staffModel->staff_info($staff_id),
            'staff_session' => $session->get('staffSessionData')
        ];
        echo view('staff/templates/header', $data);
        echo view('staff/add_oscya', $data);
        echo view('staff/templates/footer');
    }

    public function submit()
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }
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
            'middlename' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Middlename Required'
                ]
            ],
            'birthdate' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Date of Birth Required'
                ]
            ],
            'age' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Age Required'
                ]
            ],
            "gender" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please Choose your Gender'
                ]
            ],
            "civil_status" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please Provide Civil Status'
                ]
            ],
            
            "street" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Street Info Required'
                ]
            ],
            "barangay" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Barangay Info Required'
                ]
            ],
            "district" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'District Required'
                ]
            ],
            "city" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'City Required'
                ]
            ],
            "state" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'State Required'
                ]
            ],
            "gfullname" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Guardian\'s Fullname Required'
                ]
            ],
            "gcontact" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Guardian\'s Contact Number Required'
                ]
            ],
            "educ_attainment" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Highest Educational Attainment Required'
                ]
            ],
            "reason" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Reason for not dropping out/not enrolling Required'
                ]
            ],
            "is_pwd" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Select Yes or No'
                ]
            ],
            "has_pwd" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Select Yes or No'
                ]
            ],
            "disability" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please Specify OSY disability'
                ]
            ],
            "is_employed" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Employment Status Required'
                ]
            ],
            "is_fps_member" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please Select Yes if OSY is 4P\'s Beneficiary'
                ]
            ],
            "is_interested" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Select Yes if OSY is Interested in DepEd Programs'
                ]
            ]
        ]);
        $staffModel = new StaffModel();
        $staff_id = $session->get('staff_id');
        $staff_account = $staffModel->staff_account($staff_id);
        $staff_contact = $staffModel->staff_contact($staff_id);
        $coordinator_id = $staff_account['creator_id'];
        $data = [
            'staff_info' => $staffModel->staff_info($staff_id),
            'brgy_profile' => $staffModel->select_brgy_profile($coordinator_id),
            'contact' => $staffModel->staff_contact($staff_id),
            'staff_session' => $session->get('staffSessionData'),
            'validation' => $this->validator
        ];
        if(!$validation){
            echo view('staff/templates/header', $data);
            echo view('staff/add_oscya', $data);
            echo view('staff/templates/footer');
        }else{
            //Instantiate Oscya Model
            $oscyaModel = new OscyaModel();
            //<Personal Details>


            $oid = $this->generate_oid();
            $user_id = $session->get('staff_id');
            $lastname =  $this->request->getPost('lastname');
            $firstname = $this->request->getPost('firstname');
            $middlename = $this->request->getPost('middlename');
            $extension = $this->request->getPost('extension') == '' ? '' : $this->request->getPost('extension');
            $fullname = $lastname . ', ' . $firstname . ' ' . $middlename . ' ' . $extension;
            $birthdate =  $this->request->getPost('birthdate');
            $age = $this->request->getPost('age');
            $gender = $this->request->getPost('gender');
            $civil_status = $this->request->getPost('civil_status');
            $religion = $this->request->getPost('religion') == '' ? '' : $this->request->getPost('religion');

            //<Contact Details>
            $email = $this->request->getPost('email') == '' ? '' : $this->request->getPost('email');
            $facebook = $this->request->getPost('facebook') == '' ? '' : $this->request->getPost('facebook');
            $contact = $this->request->getPost('contact');
            $street = $this->request->getPost('street');
            $barangay = $this->request->getPost('barangay');
            $district = $this->request->getPost('district');
            $city = $this->request->getPost('city');
            $state = $this->request->getPost('state');
            // $zipcode =  $this->request->getPost('zipcode');
            // $pstreet = $this->request->getPost('pstreet');
            // $pbarangay = $this->request->getPost('pbarangay');
            // $pdistrict = $this->request->getPost('pdistrict');
            // $pcity = $this->request->getPost('pcity');
            // $pstate = $this->request->getPost('pstate');
            // $pzipcode =  $this->request->getPost('pzipcode');
            $zipcode = '';
            $pstreet = '';
            $pbarangay = '';
            $pdistrict = '';
            $pcity = '';
            $pstate = '';
            $pzipcode =  '';

            //<Guardian's Details>
            $gfullname = $this->request->getPost('gfullname');
            // $gemail = $this->request->getPost('gemail') == '' ? '' : $this->request->getPost('gemail');
            // $gfacebook = $this->request->getPost('gfacebook') == '' ? '' : $this->request->getPost('gfacebook');
            $gemail = '';
            $gfacebook = '';
            $gcontact = $this->request->getPost('gcontact');

            //<Mapping/Self Assessment>
            $educ_attainment = $this->request->getPost('educ_attainment');
            $reason = $this->request->getPost('reason');
            $other_reason = $this->request->getPost('other_reason') == '' ? '' : $this->request->getPost('other_reason');
            $is_pwd = $this->request->getPost('is_pwd')  == '' ? '' : $this->request->getPost('is_pwd');
            $has_pwd = $this->request->getPost('has_pwd');
            $disability = $this->request->getPost('disability') == '' ? '' : $this->request->getPost('disability');
            $other_disability = $this->request->getPost('other_disability') == '' ? '' : $this->request->getPost('other_disability');
            $disease = $this->request->getPost('disease') == '' ? '' : $this->request->getPost('disease');
            $is_employed = $this->request->getPost('is_employed');
            $is_fps_member = $this->request->getPost('is_fps_member');
            $is_interested = $this->request->getPost('is_interested');
            $mapping_date = date('Y-m-d');


            $isInserted = $oscyaModel->insertOscya($oid, $user_id, $lastname, $firstname, $middlename, $extension, $fullname, $birthdate, $age, $gender, $civil_status, $religion, $email, $contact, $facebook, $street, $barangay, $district, $city, $state, $zipcode, $pstreet, $pbarangay, $pdistrict, $pcity, $pstate, $pzipcode, $gfullname, $gemail, $gcontact, $gfacebook, $educ_attainment, $reason, $other_reason, $disability, $is_pwd, $has_pwd, $other_disability, $disease, $is_employed, $is_fps_member, $is_interested, $mapping_date);
            if ($isInserted == true) {
                return redirect()->to(base_url('/staff/oscya_detail' . '/' . $oid))->with('success', 'OSYA Data added');
            }else{
                return redirect()->to(base_url('staff/add_oscya'));
            }
        }
    }

    public function view_oscya()
    {
        $page = 'view_oscya';
        if (! is_file(APPPATH . 'Views/staff/'. $page .'.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $session = \Config\Services::session();
        
        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }
        $staff_id = $session->get('staff_id');
        $staffModel = new StaffModel();

        $staff_account = $staffModel->staff_account($staff_id);
        $coordinator_id = $staff_account['creator_id'];
        $brgy_profile = $staffModel->select_brgy_profile($coordinator_id);
        $data = [
            'brgy_profile' => $brgy_profile,
            'title' => 'Staff List',
            'oscya_list' => $staffModel->view_oscya($staff_id),
            'all_oscya' => $staffModel->view_all_oscya($brgy_profile['barangay']),
            'staff_info' => $staffModel->staff_info($staff_id),
            'count_records' => $staffModel->count_record($staff_id),
            'count_all_records' => $staffModel->count_all_record($brgy_profile['barangay']),
            'page' => ['title' => 'View OSY records']
        ];


        echo view('staff/templates/header', $data);
        echo view('staff/view_oscya', $data);
        echo view('staff/templates/footer');


    }

    public function search_oscya($oscya_id)
    {
        $session = \Config\Services::session();
        
        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }
        $staff_id = $session->get('staff_id');
        $staffModel = new StaffModel();
        if(!empty($oscya_id)){
            $result = $staffModel->search_oscya($staff_id, $oscya_id);
            if(empty($result)){
                echo json_encode(['message' => 'No Data']);
            }else{
                echo json_encode($result);
            }
        }else{
            echo json_encode([]);
        }
       
    }

    public function oscya_detail($oscya_id)
    {
        $page = 'oscya_detail';
        if (! is_file(APPPATH . 'Views/staff/'. $page .'.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staffModel = new StaffModel();

        $staff_id = $session->get('staff_id');
        $staff_account = $staffModel->staff_account($staff_id);
        $coordinator_id = $staff_account['creator_id'];

        $oscya_info = $staffModel->oscya_info($oscya_id);
        if(empty($oscya_info)){
            return redirect()->to('staff/view_oscya')->with('fail', 'Record Does not Exist');
        }else{
            $data = [
                'brgy_profile' => $staffModel->select_brgy_profile($coordinator_id),
                "title" => "Oscya Details",
                'staff_info' => $staffModel->staff_info($staff_id),
                "oscya_info" => $staffModel->oscya_info($oscya_id),
                "oscya_contact" => $staffModel->oscya_contact($oscya_id),
                "oscya_mapping" => $staffModel->oscya_mapping($oscya_id),
                "oscya_guardian" => $staffModel->oscya_guardian($oscya_id)
            ];
    
            echo view('staff/templates/header', $data);
            echo view('staff/oscya_detail', $data);
            echo view('staff/templates/footer');
        }
        

        
    }

    public function generate_osy_detail($oscya_id)
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staffModel = new StaffModel();

        $staff_id = $session->get('staff_id');

        $data = [
            "oscya_info" => $staffModel->oscya_info($oscya_id),
            "oscya_contact" => $staffModel->oscya_contact($oscya_id),
            "oscya_mapping" => $staffModel->oscya_mapping($oscya_id),
            "oscya_guardian" => $staffModel->oscya_guardian($oscya_id),
            'staff_info' => $staffModel->staff_info($staff_id)
        ];
        return view('staff/ae', $data);
    }

    public function generate_osy_mapping_form($oscya_id)
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staffModel = new StaffModel();

        $staff_id = $session->get('staff_id');
        
        $oscya_info = $staffModel->oscya_info($oscya_id);
        if(empty($oscya_info)){
            return redirect()->to('staff/oscya_detail' . '/' . $oscya_id)->with('fail', 'Record Does not Exist');
        }else{
            $filename = $oscya_info['fullname'] .'-' . $oscya_id; 
            $mpdf = new \Mpdf\Mpdf();
    
            $mpdf->WriteHTML($this->generate_osy_detail($oscya_id));
            $this->response->setHeader('Content-Type', 'application/pdf');
            // $mpdf->Output('sample.pdf', \Mpdf\Output\Destination::STRING_RETURN);
            $mpdf->Output($filename . '.pdf', 'I');
        }
        

    }

    public function download_osy_mapping_form($oscya_id)
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staffModel = new StaffModel();

        $staff_id = $session->get('staff_id');
        
        $oscya_info = $staffModel->oscya_info($oscya_id);
        if(empty($oscya_info)){
            return redirect()->to('staff/oscya_detail' . '/' . $oscya_id)->with('fail', 'Record Does not Exist');
        }else{
            $filename = $oscya_info['lastname'] . ', ' . $oscya_info['firstname'] . ' ' . $oscya_info['middlename'] . ' ' . $oscya_info['extension'] . '-' . $oscya_id; 
            $mpdf = new \Mpdf\Mpdf();
    
            $mpdf->WriteHTML($this->generate_osy_detail($oscya_id));
            $this->response->setHeader('Content-Type', 'application/pdf');
            // $mpdf->Output('sample.pdf', \Mpdf\Output\Destination::STRING_RETURN);
            $mpdf->Output($filename . '.pdf', 'D');
        }
        

    }

    public function save_personal_detail()
    {
        $session = \Config\Services::session();
        $staffModel = new StaffModel();
        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }
        $oscya_id = $this->request->getPost('oscya_id');
        $lastname = $this->request->getPost('lastname');
        $firstname = $this->request->getPost('firstname');
        $middlename = $this->request->getPost('middlename');
        $extension = $this->request->getPost('extension');
        $fullname = $lastname . ', ' . $firstname . ' ' . $middlename . ' ' . $extension; 
        $birthdate = $this->request->getPost('birthdate');
        $age = $this->request->getPost('age');
        $gender = $this->request->getPost('gender');
        $civil_status = $this->request->getPost('civil_status');
        $religion = $this->request->getPost('religion');

        $isQueried = $staffModel->update_personal_info($oscya_id, $lastname, $firstname, $middlename, $extension, $fullname, $birthdate, $age, $gender, $civil_status, $religion);

        if($isQueried == true){
            $response = [
                'class' => 'alert-success',
                'message' => 'Data updated successfully'
            ];
            echo json_encode($response);
        }else{
            $response = [
                'class' => 'alert-success',
                'message' => 'Failed to update data'
            ];
            echo json_encode($response);
        }
    }

    public function save_contact_detail()
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $oscya_id = $this->request->getPost('oscya_id');
        $email = $this->request->getPost('email');
        $contact = $this->request->getPost('contact');
        $facebook = $this->request->getPost('facebook');
        $street = $this->request->getPost('street');
        $brgy = $this->request->getPost('brgy');
        $district = $this->request->getPost('district');
        $city = $this->request->getPost('city');
        $state = $this->request->getPost('state');
        $zip_code = $this->request->getPost('civil_status');
        $p_street = $this->request->getPost('street');
        $p_barangay = $this->request->getPost('brgy');
        $p_district = $this->request->getPost('district');
        $p_city = $this->request->getPost('city');
        $p_state = $this->request->getPost('state');
        $p_zip_code = $this->request->getPost('civil_status');

        $staffModel = new StaffModel();

        $isQueried = $staffModel->update_contact_detail($oscya_id, $email, $contact, $facebook, $street, $brgy, $district, $city, $state, $zip_code, $p_street, $p_barangay, $p_district, $p_city, $p_state, $p_zip_code);

        if($isQueried){
            $response = [
                'class' => 'alert-success',
                'message' => 'Data updated successfully'
            ];
            echo json_encode($response);
        }else{
            $response = [
                'class' => 'alert-danger',
                'message' => 'Failed to update data'
            ];
            echo json_encode($response);
        }
    }

    public function save_guardian_detail()
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') ==""){
            return redirect()->to(base_url('staff/login'));
        }

        $oscya_id = $this->request->getPost('oscya_id');
        $fullname = $this->request->getPost('gfullname');
        $email = $this->request->getPost('gemail');
        $contact = $this->request->getPost('gcontact');
        $facebook = $this->request->getPost('gfacebook');


        $staffModel = new StaffModel();

        $isQueried = $staffModel->update_guardian_detail($oscya_id, $fullname, $email, $contact, $facebook);

        if($isQueried == true){
            $response = [
                'class' => 'alert-success',
                'message' => 'Guardian Details Successfully Updated'
            ];
            echo json_encode($response);
        }else{
            $response = [
                'class' => 'alert-success',
                'message' => 'Failed to Update Guardian Details'
            ];
            echo json_encode($response);
        }

    }

    public function save_mapping_details()
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $oscya_id = $this->request->getPost('oscya_id');
        $educ_attainment = $this->request->getPost('educ_attainment');
        $reason = $this->request->getPost('reason');
        $other_reason = $this->request->getPost('other_reason');
        $is_pwd = $this->request->getPost('is_pwd');
        $has_pwd_id = $this->request->getPost('has_pwd_id');
        $disability = $this->request->getPost('disability');
        $other_disability = $this->request->getPost('other_disability');
        $disease = $this->request->getPost('disease');
        $is_employed = $this->request->getPost('is_employed');
        $is_fps_member = $this->request->getPost('is_fps_member');
        $is_interested = $this->request->getPost('is_interested');


        $staffModel = new StaffModel();

        $isQueried = $staffModel->update_mapping_detail($oscya_id, $educ_attainment, $reason, $other_reason, $is_pwd, $has_pwd_id, $disability, $other_disability, $disease,  $is_employed, $is_fps_member, $is_interested);

        if($isQueried == true){
            $response = [
                'class' => 'alert-success',
                'message' => 'Mapping Details Successfully Updated'
            ];
            echo json_encode($response);
        }else{
            $response = [
                'class' => 'alert-danger',
                'message' => 'Failed to Update Mapping Details'
            ];
            echo json_encode($response);
        }
    }

    public function credentials()
    {
        $page = 'account';
        if (! is_file(APPPATH . 'Views/staff/'. $page .'.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staffModel = new StaffModel();
        $staff_id = $session->get('staff_id');
        $staff_account = $staffModel->staff_account($staff_id);
        $coordinator_id = $staff_account['creator_id'];

        $data = [
            'brgy_profile' => $staffModel->select_brgy_profile($coordinator_id),
            'session_data' => $staff_id,
            'staff_account' => $staffModel->staff_account($staff_id),
            'staff_info' => $staffModel->staff_info($staff_id),
            'staff_contact' => $staffModel->staff_contact($staff_id),
            
        ];


        echo view('staff/templates/header', $data);
        echo view('staff/account', $data);
        echo view('staff/templates/footer');
    }

    public function edit_picture()
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staffModel = new StaffModel();

        $staff_id = $session->get('staff_id');
        $image = $this->request->getFile('image');
        if($image->isValid() && !$image->hasMoved()){
            $imageName = $image->getRandomName();
            $image->move(FCPATH . "uploads/assets/profiles/" .  $staff_id , $imageName );
            $image_loc = $staff_id . '/' . $imageName;

            $isUpdated = $staffModel->edit_profile_pic($staff_id, $image_loc);
            return redirect()->to(base_url('staff/account'))->with('success', 'Profile Picture Updated');
        }else{
            return redirect()->to(base_url('staff/account'))->with('failed', 'Failed to Update Profile Picture');
        }
    }

    public function edit_credentials()
    {
        $session = \Config\Services::session();

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staff_id = $session->get('staff_id');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('new_password');

        $staffModel = new StaffModel();

        $isQueried = $staffModel->edit_account($staff_id, $username, password_hash($password, PASSWORD_BCRYPT));

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

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staff_id = $session->get('staff_id');
        $email = $this->request->getPost('email');
        $contact_no = $this->request->getPost('contact_no');
        $facebook = $this->request->getPost('facebook');
        $street = $this->request->getPost('street');
        $barangay = $this->request->getPost('barangay');
        $district = $this->request->getPost('district');
        $zip_code = $this->request->getPost('zip_code');
        $city = $this->request->getPost('city');

        $staffModel = new StaffModel();
        $isQueried = $staffModel->edit_contact($staff_id, $email, $contact_no, $facebook, $street, $barangay, $district, $zip_code,  $city);

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

        if($session->get('staff_id') == ""){
            return redirect()->to(base_url('staff/login'));
        }

        $staff_id = $session->get('staff_id');
        $lastname = $this->request->getPost('lastname');
        $firstname = $this->request->getPost('firstname');
        $middlename = $this->request->getPost('middlename');
        $suffix = $this->request->getPost('suffix');
        $birth = $this->request->getPost('birth');
        $age = $this->request->getPost('age');
        $gender = $this->request->getPost('gender');
        $civil_status = $this->request->getPost('civil_status');
        $religion = $this->request->getPost('religion');



        $staffModel = new StaffModel();
        $isQueried = $staffModel->edit_info($staff_id, $lastname, $firstname, $middlename, $suffix, $birth, $age, $gender, $civil_status, $religion);

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

    public function age_bracket()
    {

    }

    public function logout()
    {
        $session = \Config\Services::session();
        $userModel = new UserModel();
        $userModel->update_status($session->get('staff_id'), 0);
        $session->remove('staff_id');
        return redirect()->to(base_url('staff/login'));
    }

}
