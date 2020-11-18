<?php namespace App\Controllers;

class Mymail extends BaseController
{
    public $smtp_host;
    public $smtp_user;
    public $smtp_pass;
    public function __construct()
    {
        $this->smtp_host = "mail.rezekiduasaudara.com";
        $this->smtp_user = "support@rezekiduasaudara.com";
        $this->smtp_pass = "muh4mm4ds4w";
    }

	public function index()
	{
		return view('form_email');
	}
	

    public function send_mail()
    {
        $to = $this->request->getPost('to');
        $cc = $this->request->getPost('cc');
        $bcc = $this->request->getPost('bcc');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        $file = $this->request->getFile('file');
        // $file_temp = $file->getTempName();
        // $file_type = $file->getMimeType();
        // $file_name = $file->getRandomName();
        // $attach = new \CURLFile($file_temp, $file_type, $file_name);

        $email = \Config\Services::email();

        $config["protocol"]   = "smtp";
        $config["SMTPHost"]   = $this->smtp_host; //isi sesuai nama domain/mail server
        $config["SMTPUser"]   = $this->smtp_user; //alamat email SMTP
        $config["SMTPPass"]   = $this->smtp_pass; //password email SMTP
        $config["SMTPPort"]   = 465;
        $config["SMTPCrypto"] = "ssl";
        $config["mailType"]   = "html";
        $email->initialize($config);

        $email->setFrom("support@rezekiduasaudara.com", "Support Rezeki Dua Saudara");
        $email->setTo($to);
        // $email->setCC($cc);
        // $email->setBCC($bcc);
        $email->setSubject($subject);
        $email->setMessage($message);
        // $email->attach($file);
        if(!$email->send())
        {
            echo "Email tidak terkirim";
            print_r($email->printDebugger(['headers','subject','body']));
        }
        else
        {
            echo "Email terkirim";
        }
        
    }

    public function test_mail()
    {
        $email_smtp = \Config\Services::email();
 
        $config["protocol"] = "smtp";
         
        //isi sesuai nama domain/mail server
        $config["SMTPHost"]  = "mail.rezekiduasaudara.com";
         
        //alamat email SMTP
        $config["SMTPUser"]  = "support@rezekiduasaudara.com"; 
         
        //password email SMTP
        $config["SMTPPass"]  = "muh4mm4ds4w"; 
         
        $config["SMTPPort"]  = 465;
        $config["SMTPCrypto"] = "ssl";
         
        $email_smtp->initialize($config);
         
        $email_smtp->setFrom("support@rezekiduasaudara.com", "Nama Pengirim");
        $email_smtp->setTo("vindypratama8@gmail.com");
        $email_smtp->setSubject("Ini subjectnya");
        $email_smtp->setMessage("Ini isi/body email");
         
        if(!$email_smtp->send())
        {
            echo "Email tidak terkirim";
            print_r($email_smtp->printDebugger(['headers','subject','body']));
        }
        else
        {
            echo "Email terkirim";
        }
    }
}