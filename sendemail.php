<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if (isset($_POST['submit'])) {
    $name = trim($_POST['Name']);
    $email = trim($_POST['Email']);
    $phone = trim($_POST['Phone']);
    $service = trim($_POST['Service']);
    $message = trim($_POST['Message']);
    
    $forbiddenDomains = ['gmail.com', 'yahoo.com', 'outlook.com'];
    $emailDomain = substr(strrchr($email, "@"), 1);

    if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
        $alert = '<div class="alert-error">
                    <span>Please fill in all fields.</span>
                  </div>';
    } elseif (in_array($emailDomain, $forbiddenDomains)) {
        $alert = '<div class="alert-error">
                    <span>Please use a business email address. Gmail, Yahoo, and Outlook emails are not accepted.</span>
                  </div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alert = '<div class="alert-error">
                    <span>Invalid email address.</span>
                  </div>';
    } else {
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sales@alaan.ly';
            $mail->Password = 'aSB4@3#bB56@Ku';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('sales@alaan.ly');
            $mail->addAddress('sales@alaan.ly');

            $mail->isHTML(true);
            $mail->Subject = 'Alaan website (Contact form)';
            $mail->Body = "<h3>Name: $name <br>Email: $email <br>Phone Number: $phone <br>Service: $service <br>Message: $message</h3>";

            $mail->send();
            $alert = '<div class="alert-success">
                        <span>Message Sent! Thank you for contacting us. Please verify your email address.</span>
                      </div>';
        } catch (Exception $e) {
            $alert = '<div class="alert-error">
                        <span>'.$e->getMessage().'</span>
                      </div>';
        }
    }
}
?>

