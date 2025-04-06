<?php
session_start();
include('dbconnection.php');

if(isset($_POST['login_now_btn'])) {

    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {

        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);

        $login_query = "SELECT * FROM database_lovas WHERE email ='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($connection, $login_query);

        if(mysqli_num_rows($login_query_run) > 0) {

            $row = mysqli_fetch_array($login_query_run);
            
            if($row['verify_status'] == "1") {

                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];
                $_SESSION['status'] = "You are logged in successfully.";
                header("Location: dashboard.php");
                exit(0);

            } else {
                $_SESSION['status'] = "Please verify your email.";
                header("Location: login.php");
                exit(0);
            }

        } else {
            $_SESSION['status'] = "Invalid email or password!";
            header("Location: login.php");
            exit(0);
        }

    } else {
        $_SESSION['status'] = "All fields are mendotory.";
        header("Location: login.php");
        exit(0);
    }
   
}

?>