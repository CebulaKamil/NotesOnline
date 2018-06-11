<?php 
    session_start();
    include('connection.php');

    $id = $_SESSION['user_id'];
    $newUserName = $_POST['update-username-value'];

    $sql = "UPDATE users SET userName='$newUserName' WHERE user_id='$id'";
    $result = mysqli_query($link, $sql);
    if(!$result) {
        echo "<div class='alert alert-danger'>There was an error updating storing the new username in the database</div>";
    }