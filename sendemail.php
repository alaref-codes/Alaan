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
  $countryCode = trim($_POST['CountryCode']);
  $companyName = trim($_POST['CompanyName']);
  $jobTitle = trim($_POST['Jobtitle']);
  $website = trim($_POST['Website']);
  $businessArea = trim($_POST['BusinessArea']);
  $services = $_POST['Services'];
  $message = trim($_POST['Message']);
    
    $forbiddenDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com'];
    $emailDomain = substr(strrchr($email, "@"), 1);

    if (empty($name) || empty($email) || empty($phone) || empty($companyName) || empty($jobTitle) || empty($businessArea) || empty($services) || empty($message)) {
        $alert = '<div class="alert-error">
                    <span>Please fill in all required fields.</span>
                  </div>';
    } elseif (in_array($emailDomain, $forbiddenDomains)) {
        $alert = '<div class="alert-error">
                    <span>Please use a business email address. Gmail, Yahoo, iCloud, and Outlook emails are not accepted.</span>
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
            $mail->CharSet = 'UTF-8'; // Set character set to UTF-8
            $mail->Subject = 'Alaan website (Contact form)';

            $servicesList = implode(", ", $services);
            $phoneWithCountryCode = $countryCode . ' ' . $phone;

            $mail->Body = "
                <h3>Name: $name <br>
                Email: $email <br>
                Phone Number: $phoneWithCountryCode <br>
                Company Name: $companyName <br>
                Job Title: $jobTitle <br>
                Website: $website <br>
                Business Area: $businessArea <br>
                Services: $servicesList <br>
                Message: $message</h3>
            ";

            $mail->send();
            $alert = '<div class="alert-success">
                        <span>Message Sent! Thank you for contacting us. We will contact you as soon as possible.</span>
                      </div>';
        } catch (Exception $e) {
            $alert = '<div class="alert-error">
                        <span>'.$e->getMessage().'</span>
                      </div>';
        }
    }
}
?>

