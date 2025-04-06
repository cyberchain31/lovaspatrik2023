<?php
session_start();

include('dbconnection.php');

if(isset($_GET['token'])) {

    $token = $_GET['token'];
    $verify_query = "SELECT verify_token,verify_status FROM database_lovas WHERE verify_token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($connection, $verify_query);

    if(mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_array($verify_query_run);
        // Vypis, ukaze zahashovany znak na stranke
        // echo $row['verify_token'];

        if($row['verify_status'] == "0") {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE database_lovas SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($connection, $update_query);

            if($update_query_run) {
                $_SESSION['status'] = "Your account has been verified successfully.";
                header("Location: login.php");
                exit(0);

            } else {
                $_SESSION['status'] = "Verification failed!";
                header("Location: login.php");
                exit(0);
            }

        } else {
            $_SESSION['status'] = "Email already verified. Please login.";
            header("Location: login.php");
            exit(0);
        }

    } else {
        $_SESSION['status'] = "This token does not exists!";
        header("Location: login.php");
    }

} else {
    $_SESSION['status'] = "Not allowed!";
    header("Location: login.php");
}

?>