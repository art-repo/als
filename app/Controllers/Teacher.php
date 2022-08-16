<?php

    namespace App\Controllers;
    use App\Models\TeacherModel;
    use App\Models\StaffModel;
    use DateTime;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpWord\PhpWord;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Fill;

    class Teacher extends BaseController
    {
        public function __construct()
        {
            helper(['url', 'form', 'id', 'cookie']);
        }

        public function login()
        {
            echo view ( 'templates/head');
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
                    echo view('teacher/login',['validation' => $this->validator]);
                }else{


                    //perform authentication
                    $username =  $this->request->getPost('username');
                    $password = $this->request->getPost('password');

                    $teacherModel = new TeacherModel();
                    $teacherData = $teacherModel->login($username, $password);

                    if(empty($teacherData)){
                        $data = [
                            'error' => 'Invalid username or password'
                        ];
                        echo view('teacher/login', $data);
                    }else{
                    //     // echo $als_coord_data['is_evaluated'];
                        if($teacherData['isActivated'] == 0 || $teacherData['is_evaluated'] == 0){
                            $data = [
                                'error' => 'Your account is must be activated and evaluated'
                            ];
                            echo view('teacher/login', $data);
                        }
                        if($teacherData['isActivated'] == 1 && $teacherData['is_evaluated'] == 1){
                            $sessionData = [
                                'user_id' => $teacherData['user_id'],
                                'username' => $teacherData['username'],
                            ];
                            $teacherModel->update_status($teacherData['user_id'], 1);
                            $session->set('teacher_id', $sessionData['user_id']);
                            

                            //set cookie

                            if($this->request->getPost('cookie') == 1){
                                set_cookie('usn', $username, 3000);
                                set_cookie('pass', $password, 3000);
                            }
                            
                            return redirect()->to(base_url('teacher/home'));
                        } 
                    }
                }
            }else{
                return view('teacher/login');
            }
           
        }

        public function forgot_password()
        {
            if($this->request->getMethod()=='post'){
                $teacher_email = $this->request->getPost('email');

                $teacherModel = new TeacherModel();

                $teacher = $teacherModel->check_email($teacher_email);
                if(empty($teacher)){
                    $data = [
                        'message' => 'Invalid Email'
                    ];
                    echo view('teacher/forgot_password', $data);
                }else{
                    //print_r($teacher);
                    $email = \Config\Services::email();
                    $email->setFrom('als.qcu11@gmail.com',$teacher['user_id']);
                    $email->setTo($teacher_email);
                    $email->setSubject('Reset ALS Teacher Password');

                    $message = '';
                    $message .='<h1>ALS Teacher</h1>';
                    $message .='<h3><a href = " ' . base_url('teacher/reset_password') . '/' . $teacher['user_id'] . ' ">Reset Password</a></h3>';
                    $email->setMessage($message);
                    if($email->send()){
                        echo view('teacher/forgot_pass_message');
                    }else{
                        $data = [
                            'message' => 'Invalid Email'
                        ];
                        echo view('teacher/forgot_password', $data);
                    }
                }
            }else{
                echo view('teacher/forgot_password');
            }
        }

        public function reset_password($teacher_id)
        {
            if($this->request->getMethod()=='post'){
                $new_password = $this->request->getPost('password');

                $teacherModel = new TeacherModel();
                $isUpdated = $teacherModel->reset_password($teacher_id, password_hash($new_password, PASSWORD_BCRYPT));

                if($isUpdated){
                    return view('teacher/reset_message');
                }else{
                    $data = [
                        'id' => $teacher_id,
                        'message' => 'Failed to update password'
                    ];
                    echo view('teacher/reset_password', $data);
                }

            }else{
                $data = [
                    'id' => $teacher_id
                ];
                echo view('teacher/reset_password', $data);
            }
        }

        public function dashboard()
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }
            $teacher_id = $session->get('teacher_id');
            $teacherModel = new TeacherModel();
            $t_contact = $teacherModel->select_teacher_contact($teacher_id);
            $data = [
                't_info' => $teacherModel->select_teacher_info($teacher_id),
                't_tasks' => $teacherModel->select_ten_task($teacher_id),
                'count_all_tasks' => $teacherModel->count_all_tasks($teacher_id),
                'count_completed_tasks' => $teacherModel->count_completed_tasks($teacher_id),
                'barangays' => $teacherModel->select_barangays($t_contact['district'])
            ];

            echo view('teacher/templates/header', $data);
            echo view('teacher/dashboard', $data);
            echo view('teacher/templates/footer');
        }

        public function barangay($coordinator_id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }
            $teacher_id = $session->get('teacher_id');
            $teacherModel = new TeacherModel();
            $isExist = $teacherModel->check_barangay($coordinator_id);
            if(empty($isExist)){
                throw new \CodeIgniter\Exceptions\PageNotFoundException($coordinator_id . ' barangay does not exist');
            }
            $t_contact = $teacherModel->select_teacher_contact($teacher_id);
            $barangay_coord = $teacherModel->select_barangay($coordinator_id);
            $data = [
                't_info' => $teacherModel->select_teacher_info($teacher_id),
                't_tasks' => $teacherModel->select_ten_task($teacher_id),
                'barangays' => $teacherModel->select_barangays($t_contact['district']),
                'barangay_coord' => $barangay_coord,
                'count_tasks' => $teacherModel->count_barangay_tasks($coordinator_id),
                'count_osy' => $teacherModel->count_all_osy($barangay_coord['barangay']),
                'counseled_records' => $teacherModel->select_counsel_records($teacher_id, $barangay_coord['barangay']),
                'all_tasks' => $teacherModel->select_all_tasks($coordinator_id, $teacher_id),
                'ongoing_tasks' => $teacherModel->select_ongoing_task($coordinator_id, $teacher_id),
                'accomplished_tasks' => $teacherModel->select_accomplish_task($coordinator_id, $teacher_id)
            ];

            echo view('teacher/templates/header', $data);
            echo view('teacher/barangay', $data);
            echo view('teacher/templates/footer');
        }

        public function staff_records($staff_id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();
            $isExist = $teacherModel->check_staff($staff_id);
            if(empty($isExist)){
                throw new \CodeIgniter\Exceptions\PageNotFoundException($staff_id . ' user does not exist');
            }
            $t_contact = $teacherModel->select_teacher_contact($teacher_id);

            $data = [
                't_info' => $teacherModel->select_teacher_info($teacher_id),
                't_tasks' => $teacherModel->select_ten_task($teacher_id),
                'barangays' => $teacherModel->select_barangays($t_contact['district']),
                'all_records' => $teacherModel->select_counseled_records($teacher_id),
                'osya_records' => $teacherModel->select_osya_records($staff_id),
                'ongoing_osy' => $teacherModel->select_ongoing_osy($staff_id, $teacher_id),
                'staff_info' => ['staff_id' => $staff_id],
                'counseled_osy' => $teacherModel->select_counseled_osy($staff_id, $teacher_id),
                'page_info' => [
                    'title' => 'staff_records', 
                    'staff_id' => $staff_id
                ]
            ];

            echo view('teacher/templates/header', $data);
            echo view('teacher/staff_records', $data);
            echo view('teacher/templates/footer', $data);

        }

        public function records()
        {
            $session = \Config\Services::session();

            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();
            $t_contact = $teacherModel->select_teacher_contact($teacher_id);

            $data = [
                't_info' => $teacherModel->select_teacher_info($teacher_id),
                't_tasks' => $teacherModel->select_ten_task($teacher_id),
                'barangays' => $teacherModel->select_barangays($t_contact['district']),
                'all_records' => $teacherModel->select_counseled_records($teacher_id)
            ];
            echo view('teacher/templates/header', $data);
            echo view('teacher/records', $data);
            echo view('teacher/templates/footer');
        }
        
        public function activate($teacher_id)
        {
            if($this->request->getMethod()=='post'){
                $activation_code = $this->request->getPost('activation_code');
                $teacherModel = new TeacherModel();
                $teacher_data = $teacherModel->activation_code($teacher_id);
                if($teacher_data['activation_code'] == $activation_code){
                    $isActivated = $teacherModel->update_activation_status($teacher_id);
                    if($isActivated == true){
                        return view('teacher/activation_message');
                    }else{
                        $data = [
                            'tch_data' => ['tch_id' => $teacher_id],
                            'message' => 'Failed to Activate Account'
                        ];
                        echo view('teacher/activate_account', $data);
                    }
                    
                }else{
                    $data = [
                        'tch_data' => ['tch_id' => $teacher_id],
                        'message' => 'Invalid Activation Code'
                    ];
                    echo view('teacher/activate_account', $data);
                }
            }else{
                $data = [
                    'tch_data' => ['tch_id' => $teacher_id]
                ];
                echo view('teacher/activate_account', $data);
            }
        }

        public function logout()
        {
            $session = \Config\Services::session();
            $teacherModel = new TeacherModel();
            $setOffline = $teacherModel->update_status($session->get('teacher_id'), 0);
            if($setOffline == true){
                $session->remove('teacher_id');
                return redirect()->to(base_url('teacher/login'));
            }
        }

        public function task()
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();

            $data = [
                't_info' => $teacherModel->select_teacher_info($teacher_id),
                'tasks' => $teacherModel->select_all_task($teacher_id)
            ];

            echo view('teacher/templates/header', $data);
            echo view('teacher/task', $data);
            echo view('teacher/templates/footer');
        }

        public function filter_by()
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();

            $filter_var = $this->request->getPost('filter_by');


            switch ($filter_var) {
                case 'barangay':
                       echo json_encode($teacherModel->select_per_barangay($teacher_id));
                    break;
                case 'date':
                    # code...
                    break;
                case 'date':
                    # code...
                    break;    
                default:
                    # code...
                    break;
            }
        }

        public function generate_task($staff_id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();
            $osya_records = $teacherModel->select_osya_records($staff_id);

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
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);

            $spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray($spsheetHeader);

            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'OSCYA ID');
            $sheet->setCellValue('B1', 'Fullname');
            $sheet->setCellValue('C1', 'Contact');
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Mapping Date');
            $rows = 2;
            foreach($osya_records as $oscya){
                $sheet->setCellValue('A' . $rows , $oscya['oscya_id']);
                $sheet->setCellValue('B' . $rows , $oscya['fullname']);
                $sheet->setCellValue('C' . $rows , $oscya['contact']);
                $sheet->setCellValue('D' . $rows , $oscya['email']);
                $sheet->setCellValue('E' . $rows , $oscya['mapping_date']);
                $rows++;
            } 
            
            $writer = new Xlsx($spreadsheet);
            $writer->save('tasks.xlsx');
            return $this->response->download('tasks.xlsx', null)->setFileName('my_task.xlsx');
             
        }

        public function generate_osy_mapping($staff_id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();
            $osya_records = $teacherModel->select_osy_mapping($staff_id);

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
            $writer->save('tasks.xlsx');
            return $this->response->download('tasks.xlsx', null)->setFileName('my_task.xlsx');
        }

        public function view_oscya_details($oscya_id, $staff_id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();
            $t_contact = $teacherModel->select_teacher_contact($teacher_id);
            $data = [
                't_info' => $teacherModel->select_teacher_info($teacher_id),
                "oscya_info" => $teacherModel->oscya_info($oscya_id),
                "oscya_contact" => $teacherModel->oscya_contact($oscya_id),
                "oscya_mapping" => $teacherModel->oscya_mapping($oscya_id),
                "oscya_guardian" => $teacherModel->oscya_guardian($oscya_id),
                "oscya_counselling" => $teacherModel->oscya_counselling($oscya_id),
                'page_info' => [
                    'page' => 'view_oscya_details', 
                    'oscya_id' => $oscya_id,
                    'staff_id' => $staff_id
                ],
                'barangays' => $teacherModel->select_barangays($t_contact['district']),
            ];

            echo view('teacher/templates/header', $data);
            echo view('teacher/view_oscya_details', $data);
            echo view('teacher/templates/footer', $data);
        }
        public function view_oscya_record($oscya_id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();
            $t_contact = $teacherModel->select_teacher_contact($teacher_id);
            $data = [
                't_info' => $teacherModel->select_teacher_info($teacher_id),
                "oscya_info" => $teacherModel->oscya_info($oscya_id),
                "oscya_contact" => $teacherModel->oscya_contact($oscya_id),
                "oscya_mapping" => $teacherModel->oscya_mapping($oscya_id),
                "oscya_guardian" => $teacherModel->oscya_guardian($oscya_id),
                "oscya_counselling" => $teacherModel->oscya_counselling($oscya_id),
                'page_info' => [
                    'page' => 'view_oscya_details', 
                    'oscya_id' => $oscya_id,
                ],
                'barangays' => $teacherModel->select_barangays($t_contact['district']),
            ];

            echo view('teacher/templates/header', $data);
            echo view('teacher/view_oscya_record', $data);
            echo view('teacher/templates/footer', $data);
        }

        public function generate_oscya_detail($oscya_id)
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }

            $teacher_id = $session->get('teacher_id');

            $teacherModel = new TeacherModel();

            $data = [
                "oscya_info" => $teacherModel->oscya_info($oscya_id),
                "oscya_contact" => $teacherModel->oscya_contact($oscya_id),
                "oscya_mapping" => $teacherModel->oscya_mapping($oscya_id),
                "oscya_guardian" => $teacherModel->oscya_guardian($oscya_id),
                "oscya_counselling" => $teacherModel->oscya_counselling($oscya_id),
                'teacher_info' => $teacherModel->select_teacher_info($teacher_id)
            ];
            return view('teacher/ae', $data);
        }

        public function generate_ae_pdf($oscya_id)
        {
            $teacherModel = new TeacherModel();
            $oscya_info = $teacherModel->oscya_info($oscya_id);
            $filename = $oscya_info['lastname'] . ', ' . $oscya_info['firstname'] . ' ' . $oscya_info['middlename'] . ' ' . $oscya_info['extension'] . '-' . $oscya_id; 
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->SetHTMLHeader( '
                <table class="header-data">
                    <tr>
                        <td class="logo-left">
                        <img style="width:80px;height:80px;" src = "' . base_url('public/uploads/assets/profiles') . '/' . 'depedlogo.png' . '">
                        </td>
                        <td class="center">
                            <span>Republic of the Philippines</span><br>
                            <span>Department of Education</span><br>
                            <h4>ALTERNATIVE LEARNING SYSTEM</h5>
                            <h3>ALS MAPPING FORM(AMF)</h4>
                            <h4>Learner\'s Basic Profile</h6>
                        </td>
                        <td class="logo-right">
                            <img style="width:90px;height:70px;" src = "' . base_url('public/uploads/assets/profiles') . '/' . 'alslogo.png'. '">
                        </td>
                    </tr>
                </table>
            ');
            $mpdf->AddPage('', // L - landscape, P - portrait 
                    '', '', '', '',
                    20, // margin_left
                    20, // margin right
                    30, // margin top
                    30, // margin bottom
                    8, // margin header
                    10); // margin footer
            $mpdf->WriteHTML($this->generate_oscya_detail($oscya_id));
            $this->response->setHeader('Content-Type', 'application/pdf');
            // $mpdf->Output('sample.pdf', \Mpdf\Output\Destination::STRING_RETURN);
            $mpdf->Output($filename . '.pdf', 'I');
        }

        public function download_ae_pdf($oscya_id)
        {
            $teacherModel = new TeacherModel();
            $oscya_info = $teacherModel->oscya_info($oscya_id);
            $filename = $oscya_info['lastname'] . ', ' . $oscya_info['firstname'] . ' ' . $oscya_info['middlename'] . ' ' . $oscya_info['extension'] . '-' . $oscya_id; 
            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML($this->generate_oscya_detail($oscya_id));
            $this->response->setHeader('Content-Type', 'application/pdf');
            // $mpdf->Output('sample.pdf', \Mpdf\Output\Destination::STRING_RETURN);
            $mpdf->Output($filename . '.pdf', 'D');
        }

        public function update_lrn()
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }
            $teacher_id = $session->get('teacher_id');

            // $teacherModel = new TeacherModel();

            // if($this->request->getMethod()=='post'){
            //     $lrn = $this->request->getPost('lrn');
            //     $oscya_id = $this->request->getPost('oscya_id');

            //     $isUpdated = $teacherModel->update_oscya_lrn($oscya_id, $lrn);

            //     if($isUpdated == true){
            //         return redirect()->to('teacher/view_oscya_details' . '/' . $oscya_id)->with('success', 'LRN Updated');
            //     }else{
            //         return redirect()->to('teacher/view_oscya_details' . '/' . $oscya_id)->with('failed', 'Failed to update LRN');
            //     }
            // }
        }

        public function osy_counselling()
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }
            $teacher_id = $session->get('teacher_id');  
            if($this->request->getMethod()=='post'){
                $teacherModel = new TeacherModel();
                $oscya_id = $this->request->getPost('oscya_id');
                $lrn = $this->request->getPost('lrn');
                $educ_type = $this->request->getPost('educ_type');
                $is_interested = $this->request->getPost('int_in_als');
                $counselling_date = date('Y-m-d H:i:s');
                $updateLRN = $teacherModel->update_oscya_lrn($oscya_id, $lrn);
                $staff_id = $this->request->getPost('staff_id');

                $isUpdated = $teacherModel->update_oscya_counselling($teacher_id, $oscya_id, $lrn, $educ_type, $is_interested, $counselling_date);
                if($isUpdated == true){
                    return redirect()->to('teacher/staff_records' . '/' . $staff_id )->with('success', 'OSY Evaluated Successfully');
                }else{
                    return redirect()->to('teacher/staff_records' . '/' . $staff_id )->with('fail', 'Failed to evaluate OSY');
                }

            }
        }

        public function osy_admission()
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login');
            }
            $teacher_id = $session->get('teacher_id');  
            if($this->request->getMethod()=='post'){
                $teacherModel = new TeacherModel();
                $oscya_id = $this->request->getPost('oscya_id');
                $lrn = $this->request->getPost('lrn');
                $pis_score = $this->request->getPost('pis_score');
                $exam_type = $this->request->getPost('exam_type');
                $learning_mode = $this->request->getPost('learning_mode');
                $grade_level = $this->request->getPost('educ_attainment');
                
                $updateLRN = $teacherModel->update_oscya_lrn($oscya_id, $lrn);
                $updateOSYData = $teacherModel->insert_oscya_admission($teacher_id, $oscya_id, $lrn, $pis_score, $exam_type, $learning_mode, $grade_level);
                if($updateLRN == true && $updateOSYData == true){
                    $OSCYAInfo  = $teacherModel->oscya_info($oscya_id);
                    $OSCYAContact = $teacherModel->oscya_contact($oscya_id);
                    $teacherModel->register_osy($lrn, $teacher_id, $OSCYAInfo, $OSCYAContact);
                    return redirect()->to('teacher/view_oscya_details' . '/' . $oscya_id)->with('success', 'OSY Admission Recorded');
                }else{
                    return redirect()->to('teacher/view_oscya_details' . '/' . $oscya_id)->with('fail', 'Failed to save OSY admission info');
                }
                
            }
        }

        public function save_personal_detail()
        {
            $session = \Config\Services::session();
            $teacherModel = new TeacherModel();
            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
            }
            $oscya_id = $this->request->getPost('oscya_id');
            $lastname = $this->request->getPost('lastname');
            $firstname = $this->request->getPost('firstname');
            $middlename = $this->request->getPost('middlename');
            $extension = $this->request->getPost('extension');
            $birthdate = $this->request->getPost('birthdate');
            $age = $this->request->getPost('age');
            $gender = $this->request->getPost('gender');
            $civil_status = $this->request->getPost('civil_status');
            $religion = $this->request->getPost('religion');

            $isQueried = $teacherModel->update_personal_info($oscya_id, $lastname, $firstname, $middlename, $extension, $birthdate, $age, $gender, $civil_status, $religion);

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

            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
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

            $teacherModel = new TeacherModel();

            $isQueried = $teacherModel->update_contact_detail($oscya_id, $email, $contact, $facebook, $street, $brgy, $district, $city, $state, $zip_code, $p_street, $p_barangay, $p_district, $p_city, $p_state, $p_zip_code);

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

            if($session->get('teacher_id') ==""){
                return redirect()->to(base_url('teacher/login'));
            }

            $oscya_id = $this->request->getPost('oscya_id');
            $fullname = $this->request->getPost('gfullname');
            $email = $this->request->getPost('gemail');
            $contact = $this->request->getPost('gcontact');
            $facebook = $this->request->getPost('gfacebook');


            $teacherModel = new TeacherModel();

            $isQueried = $teacherModel->update_guardian_detail($oscya_id, $fullname, $email, $contact, $facebook);

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

            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
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


            $teacherModel = new TeacherModel();

            $isQueried = $teacherModel->update_mapping_detail($oscya_id, $educ_attainment, $reason, $other_reason, $is_pwd, $has_pwd_id, $disability, $other_disability, $disease,  $is_employed, $is_fps_member, $is_interested);

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

        public function account()
        {
            $session = \Config\Services::session();

            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
            }
            $teacher_id = $session->get('teacher_id');
            $teacherModel = new TeacherModel();
            $t_contact = $teacherModel->select_teacher_contact($teacher_id);
            $data = [
                't_info' => $teacherModel->select_teacher_info($teacher_id),
                't_contact' => $teacherModel->select_teacher_contact($teacher_id),
                't_account' => $teacherModel->select_teacher_account($teacher_id),
                't_credential' => $teacherModel->select_teacher_credential($teacher_id),
                't_tasks' => $teacherModel->select_ten_task($teacher_id),
                'count_all_tasks' => $teacherModel->count_all_tasks($teacher_id),
                'count_completed_tasks' => $teacherModel->count_completed_tasks($teacher_id),
                'barangays' => $teacherModel->select_barangays($t_contact['district'])
            ];

            echo view('teacher/templates/header', $data);
            echo view('teacher/account', $data);
            echo view('teacher/templates/footer');
        }

        public function edit_picture()
        {
            $session = \Config\Services::session();

            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
            }

            $teacherModel = new TeacherModel();

            $teacher_id = $session->get('teacher_id');
            $image = $this->request->getFile('image');
            if($image->isValid() && !$image->hasMoved()){
                $imageName = $image->getRandomName();
                $image->move(FCPATH . "uploads/assets/profiles/" .  $teacher_id , $imageName );
                $image_loc = $teacher_id . '/' . $imageName;

                $teacherModel->edit_profile_pic($teacher_id, $image_loc);
                return redirect()->to(base_url('teacher/account'));
            }else{
                return redirect()->to(base_url('teacher/account'));
            }

        }

        public function edit_credentials()
        {
            $session = \Config\Services::session();
            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
            }
            $teacherModel = new TeacherModel();
            $teacher_id = $session->get('teacher_id');

            if($this->request->getMethod()=='post'){
                $valid_id = $this->request->getFile('updateID');
                $file_ext = ['png', 'jpg'];
                if($valid_id->isValid() && !$valid_id->hasMoved()){
                    if(!in_array($valid_id->guessExtension(), $file_ext)){
                        return redirect()->to('teacher/account')->with('fail', 'Only .png and .jpg is Allowed.');
                    }else if($valid_id->getSize() > 20000000){
                        return redirect()->to('teacher/account')->with('fail', 'Scanned copy should be lessthan 20 mb.');
                    }else{
                        
                        $new_name = $valid_id->getRandomName();
                        $isMoved = $valid_id->move(FCPATH . "uploads/assets/profiles/" .  $teacher_id, $new_name );
                        $brgy_id_loc = $teacher_id . "/" .$new_name;
                        if($isMoved == true){
                            $isUpdated = $teacherModel->edit_valid_id($teacher_id, $brgy_id_loc);
                            if($isUpdated == true){
                                return redirect()->to('teacher/account')->with('success', 'Valid ID updated');
                            }else{
                                return redirect()->to('teacher/account')->with('fail', 'Failed to update Valid ID');
                            }
                        }else{
                            return redirect()->to('teacher/account')->with('fail', 'Failed to update Valid ID');
                        }
                    }
                }else {
                    return redirect()->to('teacher/account')->with('fail', 'ID required');
                }
            }
        }

        public function edit_contact_details()
        {
            $session = \Config\Services::session();

            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
            }

            $teacherModel = new TeacherModel();

            $teacher_id = $session->get('teacher_id');
            $email = $this->request->getPost('email');
            $contact_no = $this->request->getPost('contact_no');
            $facebook = $this->request->getPost('facebook');
            $street = $this->request->getPost('street');
            $barangay = $this->request->getPost('barangay');
            $district = $this->request->getPost('district');
            $zip_code = $this->request->getPost('zip_code');
            $city = $this->request->getPost('city');

            
            $isQueried = $teacherModel->edit_contact($teacher_id, $email, $contact_no, $facebook, $street, $barangay, $district, $zip_code,  $city);

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

            if($session->get('teacher_id') == ""){
                return redirect()->to(base_url('teacher/login'));
            }

            $teacherModel = new TeacherModel();

            $teacher_id = $session->get('teacher_id');
            $lastname = $this->request->getPost('lastname');
            $firstname = $this->request->getPost('firstname');
            $middlename = $this->request->getPost('middlename');
            $suffix = $this->request->getPost('suffix');
            $birth = $this->request->getPost('birth');
            $age = $this->request->getPost('age');
            $gender = $this->request->getPost('gender');
            
            $isQueried = $teacherModel->edit_info($teacher_id, $lastname, $firstname, $middlename, $suffix, $birth, $age, $gender);

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

        public function update_password()
        {
            $session = \Config\Services::session();
            if(empty($session->get('teacher_id'))){
                return redirect()->to('teacher/login')->with('fail', 'You must sign in first');
            }
            $teacher_id = $session->get('teacher_id');
            if($this->request->getMethod() == 'post'){
                $username = $this->request->getPost('username');
                $old_password = $this->request->getPost('old_password');
                $new_password = $this->request->getpost('new_password');

                $teacherModel = new TeacherModel();

                $isExist = $teacherModel->check_current_password($username, $old_password);
                if($isExist == true){
                    $isUpdated = $teacherModel->update_current_password($teacher_id, $username, password_hash($new_password, PASSWORD_BCRYPT));
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
                return redirect()->to('teacher/login')->with('fail', 'You must sign in');
            }
        }
    }
