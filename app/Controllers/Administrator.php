<?php

    namespace App\Controllers;

    class Administrator extends BaseController
    {

        public function __construct()
        {
            
        }

        public function login()
        {
            echo view('administrator/templates/login_header');
            echo view('administrator/login');
            echo view('administrator/templates/login_footer');
        }

        public function dashboard()
        {
            echo view('administrator/templates/header');
            echo view('administrator/dashboard');
            echo view('administrator/templates/footer');
        }
    }

