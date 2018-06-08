<?php

    session_start();
    include('connection.php'); 

    // Error message
    $missingUsername = '<p><strong>Please enter a username!</strong></p>';
    $missingEmail = '<p><strong>Please enter your email address!</strong></p>';
    $invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
    $missingPassword = '<p><strong>Please enter a Password!</strong></p>';
    $invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
    $differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
    $missingPassword2 = '<p><strong>Please confirm your password</strong></p>';
    $errors = "";

    
    // Check username
    if (empty($_POST["sigin-up-username"])) {
        $errors .= $missingUsername;
    } else {
        $username = filter_var($_POST["sigin-up-username"], FILTER_SANITIZE_STRING);   
    }

    // Check email
    if (empty($_POST["sigin-up-email"])) {
        $errors .= $missingEmail;   
    } else {
        $email = filter_var($_POST["sigin-up-email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors .= $invalidEmail;   
        }
    }

    // Check password
    if (empty($_POST["sigin-up-password"])) {
        $errors .= $missingPassword; 
    } else if (!(strlen($_POST["sigin-up-password"]) > 6 && preg_match('/[A-Z]/',$_POST["sigin-up-password"]) && preg_match('/[0-9]/',$_POST["sigin-up-password"]))) {
        $errors .= $invalidPassword; 
    } else {
        $password = filter_var($_POST["sigin-up-password"], FILTER_SANITIZE_STRING); 
        if (empty($_POST["sigin-up-password2"])) {
          $errors .= $missingPassword2;
        } else {
            $password2 = filter_var($_POST["sigin-up-password2"], FILTER_SANITIZE_STRING);
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

    // All correct 
    $username = mysqli_real_escape_string($link, $username);
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);

    $sql = " SELECT * FROM users WHERE userName = '$username' ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query</div>';
        exit;
    }
    $results = mysqli_num_rows($result);
    if ($results) {
        echo '<div class="alert alert-danger">That username is already registered. Do you want to log in?</div>';
        exit;
    }


    $sql = " SELECT * FROM users WHERE userEmail = '$email' ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query</div>';

        // Debugging
        // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
        exit;
    }

    
    $results = mysqli_num_rows($result);
    if ($results) {
        echo '<div class="alert alert-danger">That email is already registered. Do you want to log in?</div>';
        exit;
    }

    // Active code
    $activationKey = bin2hex(openssl_random_pseudo_bytes(16));

    // Insert value to database
    $sql = " INSERT INTO users (`userName`, `userEmail`, `userPassword`, `activation`) VALUES ('$username', '$email', '$password', '$activationKey') ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
        exit;
    } 

    // Send activation email
    $message = "Please click on this link to activate your account:\n\n";
    $message .= "http://localhost/NotesOnline2/src/activate.php?email=" . urlencode($email) . "&key=$activationKey";
    if (mail($email, 'Confirm your Registration', $message, 'From:'.'thekamilc@gmail.com')) {
        echo "<div class='alert alert-success'>Thank for your registring! A confirmation email has been sent to $email. Please click on the activation link to activate your account.</div>";
    } 