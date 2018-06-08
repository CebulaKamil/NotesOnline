<?php
    session_start();
    include('connection.php');

    $missingEmail = '<p><strong>Please enter your email address!</strong></p>';
    $invalidEmail = '<p><strong>Please enter a valid email address !</strong></p>';
    $errors = "";
    
    if (empty($_POST["forgot-email"])) {
        $errors .= $missingEmail;   
    } else {
        $email = filter_var($_POST["forgot-email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors .= $invalidEmail;   
        }
    }

    if ($errors) {
        $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
        echo $resultMessage;
        exit;
    }

    $email = mysqli_real_escape_string( $link, $email );

    $sql = " SELECT * FROM users WHERE userEmail = '$email' ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query</div>';
        exit;
    }

    $count = mysqli_num_rows($result);
    if ($count != 1) {
        echo '<div class="alert alert-danger">That emails does not exist on our database!</div>';
        exit;
    }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $user_id = $row['user_id'];
    $key = bin2hex(openssl_random_pseudo_bytes(16));
    $time = time();
    $status = 'pending';
    $sql = " INSERT INTO forgot_password (`user_id`, `reset_key`, `time`, `status`) VALUES ('$user_id', '$key', '$time', '$status') ";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
        exit;
    } 

    $message = "Please click on this link to reset your password:\n\n";
    $message .= "http://localhost/NotesOnline2/src/reset-password.php?user_id=$user_id&key=$key";
    if (mail($email, 'Reset your password', $message, 'From:'.'thekamilc@gmail.com')) {
        echo "<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password.</div>";
    } 