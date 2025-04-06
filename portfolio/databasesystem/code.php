<?php
  session_start();

  include('dbconnection.php');

  // Composer
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  // Load Composer's autoloader
  require 'vendor/autoload.php';

  function sendemail_verify($name,$email,$verify_token) {

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
    $mail->Subject = "Email Verification of Database / lovaspatrik.sk";

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
  
  if(isset($_POST['register_btn'])) {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $password = $_POST['password'];
     $verify_token = md5(rand());

   // Overenie, ci funguje spojenie s emailom
   //   sendemail_verify("$name","$email","$verify_token");
   //   echo "send?";

     // Overeneie emailu
     $check_email_query = "SELECT email FROM database_lovas WHERE email='$email' LIMIT 1";
     $check_email_query_run = mysqli_query($connection, $check_email_query);

     if(mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email Id already exists!";
        header("Location: register.php");
     }
     else {
        // vlozenie dat do databazy
        $query = "INSERT INTO database_lovas (name,email,phone,password,verify_token) VALUES ('$name','$email','$phone','$password','$verify_token')";
        $query_run = mysqli_query($connection, $query);
        
        if($query_run) {
            sendemail_verify("$name","$email","$verify_token");
            $_SESSION['status'] = "Registration success. Please verify your email address.";
            header("Location: register.php");
        }
        else {
            $_SESSION['status'] = "Registration failed!";
            header("Location: register.php");
        }
     }

  }

?>