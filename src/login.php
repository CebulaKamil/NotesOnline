<?php

    session_start();
    include("connection.php");

    $missingEmail = '<p><stong>Please enter your email address!</strong></p>';
    $missingPassword = '<p><stong>Please enter your password!</strong></p>';
    $errors = ""; 

    // Check login email
    if (empty($_POST["login-email"])) {
        $errors .= $missingEmail;   
    } else {
        $email = filter_var($_POST["login-email"], FILTER_SANITIZE_EMAIL);
    }
    
    // Check login password
    if (empty($_POST["login-password"])) {
        $errors .= $missingPassword;   
    } else {
        $password = filter_var($_POST["login-password"], FILTER_SANITIZE_STRING);
    }

    // If there are any errors
    if ($errors) {
        $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
        echo $resultMessage;   
    } else {
        // No errors
        $email = mysqli_real_escape_string($link, $email);
        $password = mysqli_real_escape_string($link, $password);
        $password = hash('sha256', $password);

        // Check useremail and password
        $sql = "SELECT * FROM users WHERE userEmail='$email' AND userPassword='$password' AND activation='activated'";
        $result = mysqli_query($link, $sql);
        
        if (!$result) {
            echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
        }
         
        // Dont match username and password
        $count = mysqli_num_rows($result);
        if ($count !== 1) {
            echo '<div class="alert alert-danger">Wrong Username or Password!</div>';
        } else {
            // Log the user in
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['userName']=$row['userName'];
            $_SESSION['userEmail']=$row['userEmail'];
            
            if (empty($_POST['remember-me'])) {
                //If remember me is not checked
                echo "success";
            }
        }
    }    
