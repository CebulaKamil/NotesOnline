<?php
    session_start();
    include('connection.php');

    $user_id = $_SESSION['user_id'];
    $newEmail = $_POST['update-email-value'];

    $sql = "SELECT * FROM users WHERE userEmail='$newEmail'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    if($count > 0) {
        echo "<div class='alert alert-danger'>There is already as user registred with that email! PLease choose another one!</div>";
        exit;
    } 

    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = mysqli_query($link, $sql);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $username = $row['userName'];
        $email = $row['userEmail'];
    } else {
        echo "There was an error retrieving the email from the database!";
        exit;
    }

    $activationKey = bin2hex(openssl_random_pseudo_bytes(16));
    $sql = "UPDATE users SET activationChangeEmail='$activationKey' WHERE user_id='$user_id'";
    $result = mysqli_query($link, $sql);
    if(!$result) {
        echo "<div class='alert alert-danger'>There was an error inserting the user details in the database!</div>";
    } else {
        $message = "Please click on this link prove that own this email:\n\n";
        $message .= "http://localhost/NotesOnline2/src/activate-new-email.php?email=" . urlencode($email) . "&new-email=" . urlencode($newEmail) . "&key=$activationKey";
        if (mail($newEmail, 'Email update', $message, 'From:'.'thekamilc@gmail.com')) {
            echo "<div class='alert alert-success'>An email has been sent to $newEmail. Please click own email adress.</div>";
        } 
    }

     