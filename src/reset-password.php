<?php 
    session_start();
    include('connection.php'); 
?>
    <!DOCTYPE html>
    <html lang="en">
    <head> 
        <title>Notes Online-Reset Password</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Style -->
        <link rel="stylesheet" href="css/resetStyle.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
        
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10 contactForm">
                <h1>Reset Password:</h1>
                <div id="forgot-message"></div>

        <?php
            if(!isset($_GET['user_id']) || !isset($_GET['key'])) {
                echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email to reset your password.</div>'; 
                exit;
            }

            $user_id = $_GET['user_id'];
            $key = $_GET['key'];
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
            echo "
            <form method='POST' id='password-reset-form'>
                <input type='hidden' name='reset-key' value='$key'>
                <input type='hidden' name='reset-user_id' value='$user_id'>
                <div class='form-group'>
                    <label for='password'>Enter your new Password:</label>
                    <input type='password' name='reset-password' id='password' placeholder='Enter Password' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='password2'>Submit new Password:</label>
                    <input type='password' name='reset-password2' id='password2' placeholder='Submit new Password' class='form-control'>
                </div>
                <input type='submit' name='reset-password' class='btn btn-success btn-lg' value='Reset Password'>
            </form>";
        ?>
            </div>
        </div>
        <script src="js/reset-password.js"></script>
    </body>
    </html>

