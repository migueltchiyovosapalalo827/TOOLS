<?php
namespace Controllers;
error_reporting(E_STRICT | E_ALL);

use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class Email
{

protected $hostName;
protected $userName;
protected $Password;
protected $mail;




public function __construct($hostName,$userName,$Password)
{  
    $this->hostName = $hostName;
    $this->userName = $userName;
    $this->Password = $Password;
}

public function config()
{
    # code...

//Load Composer's autoloader
require 'vendor/autoload.php';

//Passing `true` enables PHPMailer exceptions
$this->mail = new PHPMailer(true);
    //Server settings
   //$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $this->mail->isSMTP();                                            //Send using SMTP
    $this->mail->Host       = $this->hostName;                     //Set the SMTP server to send through
    $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $this->mail->Username   = $this->userName;                     //SMTP username
    $this->mail->Password   = $this->Password;                               //SMTP password
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $this->mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead 
    $this->mail->Port =  465;
    $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );                                  //TCP port to connect to; use 587 if you have
}
  
public function sendMail($conteudo,$from,$to )
{
    # code...
    $msg = "";
    $erro = false;
    

    $this->mail->setFrom($from, $conteudo['nome']);
   
    $this->mail->addAddress($to, 'TOOLS');
   
   try {
    $this->mail->addReplyTo($to, 'TOOLS');
    
   $this->mail->Subject = $conteudo['assunto'];
   //Keep it simple - don't use HTML
   $this->mail->isHTML(false);
   //Build a simple message body
   $this->mail->Body = <<<EOT
Email: {$conteudo['email']}
Nome: {$conteudo['nome']}
Telefone: {$conteudo['contacto']}
Messagem: {$conteudo['message']}
EOT;
   //Send the message, check for errors
   if (!$this->mail->send()) {
       //The reason for failing to send will be in $mail->ErrorInfo
       //but you shouldn't display errors to users - process the error, log it on your server.
       $erro = true;
       $msg = 'Desculpe, algo deu errado. Por favor, tente novamente mais tarde.';

   } else {
       $erro = false;
       $msg = 'Mensagem enviada! Obrigado por nos contactar.';
   }
   } catch (Exception $e) {
    $erro = true;
    $msg = 'Endereço de email inválido, mensagem ignorada.';
   }


     $dado=['msg'=>$msg,'erro'=>$erro];
      return $dado;

}

}