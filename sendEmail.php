<?php
/**
 * This example shows how to send a message to a whole list of recipients efficiently.
 */

//Import the PHPMailer class into the global namespace
//
date_default_timezone_set('Etc/UTC'); 


include('./Controllers/Email.php');
use Controllers\Email;
$dns="cp-38.webhostbox.net"; // mudar o conteudo desta varial com o dns de email da  gecesta
$user="geral@fdj-sa.com";  // mudar o conteudo desta varial com o utilizador de email da gecesta
$password="@fdj-sa"; // mudar o conteudo desta varial com a password de email da  gecesta
$email="geral@fdj-sa.com"; // mudar o conteudo desta varial com  email da  gecesta
$mail = new Email($dns,$user,$password);
$mail->config();
//$_POST = json_decode(file_get_contents("php//input"), true);
$reposta = $mail->sendMail($_POST,$_POST['email'],$email);
if ($reposta['erro'] == true) {
    # code...
    http_response_code(500);
}
header('Content-type:application/json;charset=utf-8');
echo json_encode($reposta);
exit();