<?php 
    session_start();
    include('connection.php'); 
?>
    <!DOCTYPE html>
    <html lang="en">
    <head> 
        <title>Notes Online-Activate</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Style -->
        <link rel="stylesheet" href="css/activateStyle.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10 contactForm">
                <h1>Account Activation</h1>
        <?php
        if(!isset($_GET['email']) || !isset($_GET['key'])) {
            echo '<div class="alert alert-danger">There was an error. Please click on the activation you received by email</div>'; 
            exit;
        }

        $email = $_GET['email'];
        $key = $_GET['key'];

        $email = mysqli_real_escape_string($link, $email);
        $key = mysqli_real_escape_string($link, $key);

        $sql = "UPDATE users SET activation='activated' WHERE (userEmail='$email' AND activation='$key') LIMIT 1";
        $result = mysqli_query($link, $sql);

        if(mysqli_affected_rows($link) == 1) {
            echo '<div class="alert alert-success">Your account has been activated.</div>';
            echo '<a href="index.php" type="button" class="btn-lg btn-sucess">Log in<a/>'; 
        } else {
            echo '<div class="alert alert-danger">Your account could not be activated. Please try again later.</div>';
            
            // For debugging
            // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
        }
    ?>
    </body>

