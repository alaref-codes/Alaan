<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit']) && $_POST['Email'] && $_POST['Email'] != '' &&  $_POST['Name'] != '' &&  $_POST['Phone'] != ''){
    
if(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)){
    
    
  $name = $_POST['Name'];
  $email = $_POST['Email'];
  $phone = $_POST['Phone'];
  $message = $_POST['Message'];

  try{
    $mail->isSMTP();
    $mail->Host = 'mail.alaan.ly'; //'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sales@alaan.ly'; // Gmail address which you want to use as SMTP server
    $mail->Password = '_edb$O+CjX%}'; //'dlbvbtfjmsljmwrc'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  
    $mail->Port = '587'; //'465'; //'587';

    $mail->setFrom('sales@alaan.ly'); // Email address which you used as SMTP server
    $mail->addAddress('sales@alaan.ly'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

    $mail->isHTML(true);
    $mail->Subject = 'Alaan website (Contact form)';
    $mail->Body = "<h3>Name : $name <br>Email : $email <br>Phone Number : $phone <br>Message : $message</h3>";

    $mail->send();
    $alert = '<div class="alert-success">
                 <span>Message Sent! Thank you for contacting us. please verfiy your email address</span>
                </div>';
  }  catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
  }
    }
}
?>
