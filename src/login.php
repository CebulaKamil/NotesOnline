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
            
            //If remember me is not checked
            if (empty($_POST['remember-me'])) {
                echo "success";
            } else {
                // Check remember me
                $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
                $authentificator2 = openssl_random_pseudo_bytes(20);

                function f1 ($a, $b) {
                    $c = $a . "," . bin2hex($b);
                    return $c;
                };

                $cookieValue = f1($authentificator1, $authentificator2);
                setcookie("remember-me", $cookieValue, time() + 129600);

                function f2 ($a) {
                    $b = hash('sha256', $a);
                    return $b;
                };

                $f2authentificator2 = f2($authentificator2);
                $user_id = $_SESSION['user_id'];
                $expiration = date('Y-m-d H:i:s', time() + 1296000);

                $sql = " INSERT INTO remember_me (authentificator1, f2authentificator2, user_id, expires) VALUES ('$authentificator1', '$f2authentificator2', '$user_id', '$expiration') ";


                $result = mysqli_query($link, $sql);
                if (!$result) {
                    echo '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>' ;
                } else {
                    echo "success";
                }
            }
        }
    }    
