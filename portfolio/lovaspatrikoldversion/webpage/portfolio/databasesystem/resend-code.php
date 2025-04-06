<?php
session_start();

include('dbconnection.php');

  // Composer
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  // Load Composer's autoloader
  require 'vendor/autoload.php';

function resend_email_verify($name,$email,$verify_token) {

    $mail = new PHPMailer(true);

    $mail->isSMTP();                                         //Send using SMTP
    $mail->SMTPAuth   = true; 

    $mail->Host       = "smtp.gmail.com";                    //Set the SMTP server to send through          //Enable SMTP authentication
    $mail->Username   = "cyberchain31@gmail.com";            //SMTP username
    $mail->Password   = "fzdvhujonrlhymkk";                  //SMTP password (vytvorene cez google ucet)

    $mail->SMTPSecure = "tls";                              //Enable implicit TLS encryption
    $mail->Port       = 587;                                //TCP port to connect to; use 465 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("cyberchain31@gmail.com",$name);
    $mail->addAddress($email);                               //Add a recipient

    //Content
    $mail->isHTML(true);                                    //Set email format to HTML
    $mail->Subject = "Resend Email Verification of Database / lovaspatrik.sk";

    $email_template = "
    <h2>Hello,</h2>
    <h3>verify your email address to login with the below give link from lovaspatrik.sk.</h3>
    <br></br>
    <a href='http://lovaspatrik.sk/page/database/verify-email.php?token=$verify_token'> >CLICK ON VERIFY< </a>
    <h4>Patrik Lovás</h4> 
    ";  

                // hosting
         //  'http://lovaspatrik.sk/page/database/verify-email.php?token=$verify_token'
               // xampp  
         //  'http://localhost/myphp/database/verify-email.php?token=$verify_token'

    $mail->Body = $email_template;
    $mail->send();
}

if(isset($_POST['resend_email_verify_btn'])) {

    if(!empty(trim($_POST['email']))) {

    $email = mysqli_real_escape_string($connection, $_POST['email']);

    $checkemail_query = "SELECT * FROM database_lovas WHERE email='$email' LIMIT 1";
    $checkemail_query_run = mysqli_query($connection, $checkemail_query);

    if(mysqli_num_rows($checkemail_query_run) > 0) {

        $row = mysqli_fetch_array($checkemail_query_run);
        if($row['verify_status'] == "0") {

            $name = $row['name'];
            $email = $row['email'];
            $verify_token = $row['verify_token'];

            resend_email_verify($name,$email,$verify_token);

            $_SESSION['status'] = "Verification email link has been sent to your email address." ;
            header("Location: login.php");
            exit(0);

        } else {
            $_SESSION['status'] = "Email already verified. Please login.";
            header("Location: resend-email-verification.php");
            exit(0);
        }

    } else {
        $_SESSION['status'] = "Email is not registered. Please register now.";
        header("Location: register.php");
        exit(0);
    }

 } else {
    $_SESSION['status'] = "Please enter the email field.";
    header("Location: resend-email-verification.php");
    exit(0);
 }

}

?>