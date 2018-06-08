<?php
    session_start();
    include('connection.php'); 

    if(!isset($_POST['reset-user_id']) || !isset($_POST['reset-key'])) {
        echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email to reset your password.</div>'; 
        exit;
    }

    $user_id = $_POST['reset-user_id'];
    $key = $_POST['reset-key'];
    $time = time() - 86400;

    $user_id = mysqli_real_escape_string($link, $user_id);
    $key = mysqli_real_escape_string($link, $key);

    $sql = "SELECT user_id FROM forgot_password WHERE reset_key = '$key' AND user_id = '$user_id' AND time > '$time' AND status='pending'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query!</div>'; 
        exit;
    } 

    $count = mysqli_num_rows($result);
    if ($count !== 1) {
        echo '<div class="alert alert-danger">Please try again.</div>';
        exit;
    }

    $missingPassword = '<p><strong>Please enter a Password!</strong></p>';
    $invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
    $differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
    $missingPassword2 = '<p><strong>Please confirm your password</strong></p>';
    $errors = "";

    // Check password
    if (empty($_POST["reset-password"])) {
        $errors .= $missingPassword; 
    } else if (!(strlen($_POST["reset-password"]) > 6 && preg_match('/[A-Z]/',$_POST["reset-password"]) && preg_match('/[0-9]/',$_POST["reset-password"]))) {
        $errors .= $invalidPassword; 
    } else {
        $password = filter_var($_POST["reset-password"], FILTER_SANITIZE_STRING); 
        if (empty($_POST["reset-password2"])) {
          $errors .= $missingPassword2;
        } else {
            $password2 = filter_var($_POST["reset-password2"], FILTER_SANITIZE_STRING);
            if ($password !== $password2) {
                $errors .= $differentPassword;
            }
        }
    }

    // Check errors
    if ($errors) {
        $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
        echo $resultMessage;
        exit;
    }

    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);
    $user_id = mysqli_real_escape_string($link, $user_id);

    $sql = "UPDATE users SET userPassword='$password' WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        echo '<div class="alert alert-danger">There was a problem storing the new password in database</div>';
        exit;
    } 

    $sql = "UPDATE forgot_password SET status = 'used' WHERE reset_key = '$key' AND user_id = '$user_id'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query!</div>'; 
    } else {
        echo '<div class="alert alert-success">Your password has been update successfully! <a href="index.php">Login</a></div>'; 
    }


