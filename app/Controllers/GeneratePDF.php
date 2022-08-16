<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Model\StaffModel;
use Mpdf\Mpdf;
use \PhpOffice\PhpWord\PhpWord;

class GeneratePDF extends Controller
{

    public function index() 
    {
        return view('pdf-view');
    }

    public function htmlToPDF(){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($this->index());
        $this->response->setHeader('Content-Type', 'application/pdf');
        // $mpdf->Output('sample.pdf', \Mpdf\Output\Destination::STRING_RETURN);
        $mpdf->Output('download.pdf', 'S');
        // $email = \Config\Services::email();

        // $email->setFrom('als.qcu@gmail.com', 'Your Name');
        // $email->setTo('art.acebuche.antonio.qcu@gmail.com');
        

        // $email->setSubject('Email Test');
        // $email->setMessage('Testing pdf');
        // $content = $mpdf->Output('', 'S');
        // $filename ="sample.pdf";
        // $email->attach($content, 'attachment', $filename, 'application/pdf');

        // $email->send();
        
    }

    public function generate_word()
    {
        
    }

}