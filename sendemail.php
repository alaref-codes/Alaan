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
  $companyname = trim($_POST['CompanyName']);
  $jobtitle = trim($_POST['Jobtitle']);
  $website = trim($_POST['Website']);
  $businessarea = trim($_POST['BusinessArea']);
  $services = isset($_POST['Services']) ? $_POST['Services'] : [];
  $message = trim($_POST['Message']);
    
    $forbiddenDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com'];
    $emailDomain = substr(strrchr($email, "@"), 1);


    $missingFields = [];

    if (empty($name)) {
        $missingFields[] = 'Your Name';
    }
    if (empty($email)) {
        $missingFields[] = 'your Buisness Email';
    }
    if (empty($phone)) {
        $missingFields[] = 'your Phone';
    }
    if (empty($companyname)) {
        $missingFields[] = 'Company/Organization Name';
    }
    if (empty($jobtitle)) {
        $missingFields[] = 'your Job Title';
    }
    if (empty($website)) {
      $missingFields[] = 'your Job Title';
  }
    if (empty($businessarea)) {
        $missingFields[] = 'your Business Area';
    }
    if (empty($services)) {
        $missingFields[] = 'The Services you are looking for';
    }
    if (empty($message)) {
        $missingFields[] = 'your Message';
    }

    if (!empty($missingFields)) {
      $alert = '<div class="alert-error" style="margin-top: 2%;">
                  <span>Please fill in the following fields: ' . implode(', ', $missingFields) . '.</span>
                </div>';
    } elseif (in_array($emailDomain, $forbiddenDomains)) {
        $alert = '<div class="alert-error" style="margin-top: 2%;">
                    <span>Please use a business email address. Gmail, Yahoo, iCloud, and Outlook emails are not accepted.</span>
                  </div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alert = '<div class="alert-error" style="margin-top: 2%;">
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
            $mail->CharSet = 'UTF-8'; // Set character set to UTF-8
            $mail->Subject = 'Alaan website (Contact form)';

            $serviceslist = implode(", ", $services);

            $mail->Body = "
                <h3>Name: $name <br>
                Email: $email <br>
                Phone Number: $phone <br>
                Company Name: $companyname <br>
                Job Title: $jobtitle <br>
                Website: $website <br>
                Business Area: $businessarea <br>
                Services: $serviceslist <br>
                Message: $message</h3>
            ";

            $mail->send();
            $alert = '<div class="alert-success" style="margin-top: 2%;">
                        <span>Message Sent! Thank you for contacting us. We will contact you as soon as possible.</span>
                      </div>';
        } catch (Exception $e) {
            $alert = '<div class="alert-error" style="margin-top: 2%;">
                        <span>'.$e->getMessage().'</span>
                      </div>';
        }
    }
}
?>

