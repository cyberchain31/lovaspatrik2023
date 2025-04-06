<?php
  session_start();

  include('dbconnection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name,$get_email,$token) {

    $mail = new PHPMailer(true);

    $mail->isSMTP();                                         //Send using SMTP
    $mail->SMTPAuth   = true; 

    $mail->Host       = "smtp.gmail.com";                    //Set the SMTP server to send through          //Enable SMTP authentication
    $mail->Username   = "cyberchain31@gmail.com";            //SMTP username
    $mail->Password   = "fzdvhujonrlhymkk";                               //SMTP password (vytvorene cez google ucet)

    $mail->SMTPSecure = "tls";                              //Enable implicit TLS encryption
    $mail->Port       = 587;                                //TCP port to connect to; use 465 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("cyberchain31@gmail.com",$get_name);
    $mail->addAddress($get_email);                               //Add a recipient

    //Content
    $mail->isHTML(true);                                    //Set email format to HTML
    $mail->Subject = "Reset Password Notification of Database / lovaspatrik.sk.";

    $email_template = "
    <h2>Hello,</h2>
    <h3>you are receiving this email because we received a password reset request for you account from lovaspatrik.sk.</h3>
    <br></br>
    <a href='http://lovaspatrik.sk/page/database/password-change.php?token=$token&email=$get_email'> >CLICK TO CHANGE PASSWORD< </a>
    <h4>Patrik Lovás</h4>
    ";  

                // hosting
         //  'http://lovaspatrik.sk/page/database/password-change.php?token=$token&email=$get_email'
               // xampp  
         //  'http://localhost/myphp/database/password-change.php?token=$token&email=$get_email'

    $mail->Body = $email_template;
    $mail->send();

}

if(isset($_POST['password_reset_link'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM database_lovas WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($connection, $check_email);

    if(mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['name'];
        $get_email = $row['email'];

        $update_token = "UPDATE database_lovas SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($connection, $update_token);
        
        if($update_token_run) {
            send_password_reset($get_name,$get_email,$token);

            $_SESSION['status'] = "We e-mailed you a password reset link.";
            header("Location: password-reset.php");
            exit(0);
           
        } else {
            $_SESSION['status'] = "Something went wrong!";
            header("Location: password-reset.php");
            exit(0);
        }

    } else {
        $_SESSION['status'] = "No email found.";
        header("Location: password-reset.php");
        exit(0);
    }
}


if(isset($_POST['password_update'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $new_password = mysqli_real_escape_string($connection, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);
    $token = mysqli_real_escape_string($connection, $_POST['password_token']);

        if(!empty($token)) {

            if(!empty($email) && !empty($new_password) &&  !empty($confirm_password)) {
                $check_token = "SELECT verify_token FROM database_lovas WHERE verify_token='$token' LIMIT 1";
                $check_token_run = mysqli_query($connection, $check_token);

                if(mysqli_num_rows($check_token_run) > 0) {

                    if($new_password == $confirm_password) {
                        $update_password = "UPDATE database_lovas SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
                        $update_password_run = mysqli_query($connection, $update_password);

                        if($update_password_run) {

                            $new_token = md5(rand())."cyber";
                            $update_to_new_token = "UPDATE database_lovas SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
                            $update_to_new_token_run = mysqli_query($connection, $update_to_new_token);

                            $_SESSION['status'] = "New password successfully updated.";
                            header("Location: login.php");
                            exit(0);

                        } else {
                            $_SESSION['status'] = "Did not update password. Something went wrong!";
                            header("Location: password-change.php?token=$token&email=$email");
                            exit(0);
                        }


                       } else {
                        $_SESSION['status'] = "Password and confirm password does not match!";
                        header("Location: password-change.php?token=$token&email=$email");
                        exit(0);
                    }


                } else {
                    $_SESSION['status'] = "Invalid token.";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit(0);
                }

        
            } else {
                $_SESSION['status'] = "All filed are mandetory.";
                header("Location: password-change.php?token=$token&email=$email");
                exit(0);
       }

   } else {
        $_SESSION['status'] = "No token available.";
        header("Location: password-change.php");
        exit(0);
   }
    
}


?>