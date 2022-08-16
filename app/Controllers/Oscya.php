<?php

namespace App\Controllers;
use App\Models\OscyaModel;

class Oscya extends BaseController
{
    public function __construct()
    {

        helper(['url', 'form']);
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
        echo view('templates/header');
        echo view('oscya/before_proceeding');
        echo view('templates/footer');
    }

    public function oscya_form()
    {
        echo view('templates/header');
        echo view('oscya/oscya_form');
        echo view('templates/footer');
    }
    
    public function submit()
    {
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
                    'required' => 'middlename Required'
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
                    'required' => 'Age of Birth Required'
                ]
            ],
            "gender" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gender Required'
                ]
            ], 
            "civil_status" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Civil Status Required'
                ]
            ], 
            "contact" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Contact Required'
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
            "zipcode" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Zipcode Required'
                ]
            ], 
            "pstreet" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Permanent Zipcode Required'
                ]
            ], 
            "pbarangay" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Permanent Barangay Required'
                ]
            ], 
            "pdistrict" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Permanent District Required'
                ]
            ], 
            "pcity" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Permanent City Required'
                ]
            ], 
            "pstate" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Permanent State Info Required'
                ]
            ], 
            "pzipcode" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Permanent Zipcode Info Required'
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
                    'required' => 'Required'
                ]
            ],
            "has_pwd" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Required'
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
                    'required' => 'Required'
                ]
            ], 
            "is_interested" => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'DepEd Programs Interest Required'
                ]
            ]
        ]);
        if(!$validation){
            echo view('templates/header');
            echo view('oscya/oscya_form',['validation' => $this->validator]);
            echo view('templates/footer');
        }else{
            //Instantiate Oscya Model
            $oscyaModel = new OscyaModel();
            //<Personal Details>


            $oid = $this->generate_oid();
            $user_id = 'Online';
            $lastname =  $this->request->getPost('lastname');
            $firstname = $this->request->getPost('firstname');
            $middlename = $this->request->getPost('middlename');
            $extension = $this->request->getPost('extension') == '' ? '' : $this->request->getPost('extension');
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
            $zipcode =  $this->request->getPost('zipcode');
            $pstreet = $this->request->getPost('pstreet');
            $pbarangay = $this->request->getPost('pbarangay');
            $pdistrict = $this->request->getPost('pdistrict');
            $pcity = $this->request->getPost('pcity');
            $pstate = $this->request->getPost('pstate');
            $pzipcode =  $this->request->getPost('pzipcode');
            
            //<Guardian's Details>
            $gfullname = $this->request->getPost('gfullname');
            $gemail = $this->request->getPost('gemail') == '' ? '' : $this->request->getPost('gemail');
            $gfacebook = $this->request->getPost('gfacebook') == '' ? '' : $this->request->getPost('gfacebook');
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
            

            $isInserted = $oscyaModel->insertOscya($oid, $user_id, $lastname, $firstname, $middlename, $extension, $birthdate, $age, $gender, $civil_status, $religion, $email, $contact, $facebook, $street, $barangay, $district, $city, $state, $zipcode, $pstreet, $pbarangay, $pdistrict, $pcity, $pstate, $pzipcode, $gfullname, $gemail, $gcontact, $gfacebook, $educ_attainment, $reason, $other_reason, $disability, $is_pwd, $has_pwd, $other_disability, $disease, $is_employed, $is_fps_member, $is_interested, $mapping_date);
            if ($isInserted == true) {
                echo 'Inserted';
            }else{
                echo 'Not Inserted';
            }
        }
    }
}
