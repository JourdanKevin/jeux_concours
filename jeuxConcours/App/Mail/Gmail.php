<?php
namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

class Gmail{
    private $mail;
    function __construct(){
        $this->mail = new PHPMailer;
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = GM_USER;           // SMTP username
        $this->mail->Password = GM_PASS;                         // SMTP password
        $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587;
        $this->mail->setFrom(GM_USER, GM_FROM);
        $this->mail->isHTML(true);      
        $this->mail->CharSet = 'UTF-8';                             // Set email format to HTML       
        // $mail->AddEmbeddedImage('img/2u_cs_mini.jpg', 'logo_2u');                                 
    }
    function send($to,$name,$subject){
        $this->mail->addAddress($to,$name);
        $this->mail->Subject = $subject;  
        ob_start(); 
            require VIEWS . "mail/mailTemplateInscription.php";
        $body = ob_get_clean();
        $this->mail->Body = $body;
        if(!$this->mail->send()) {
            echo "Mailer Error: " . $this->mail->ErrorInfo;
            return false;
        } else {
            echo 'Message has been sent';
            return true;
        }
    }

}

?>

