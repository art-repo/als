<?php

namespace App\Controllers;
use App\Models\HomeModel;

class Home extends BaseController
{
    public function index() 
    {

        if (! is_file(APPPATH . 'Views/index.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Index');
        }
        echo view('templates/header');
        echo view('index');
        echo view('templates/footer');
    }

    public function about()
    {
        echo view('templates/header');
        echo view('about');
        echo view('templates/footer');
    }

    public function faqs()
    {
        echo view('templates/header');
        echo view('faqs');
        echo view('templates/footer');
    }

    public function barangay()
    {

        $homeModel = new HomeModel();
        $data = [
            'barangays' => $homeModel->select_barangay()
        ];
        echo view('templates/head');
        echo view('barangay', $data);
        echo view('templates/footer');
    }
}
