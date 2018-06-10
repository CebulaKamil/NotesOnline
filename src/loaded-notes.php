<?php
    session_start();
    include('connection.php');

    $user_id = $_SESSION['user_id'];
    
    $sql = "DELETE FROM notes WHERE notes=''";
    $result = mysqli_query($link, $sql);
    if(!$result) {
        echo "<div class='alert alert-danger'>An error occured!</div>";
        exit;
    }

    $sql = "SELECT * FROM notes WHERE user_id='$user_id' ORDER BY time DESC";
    if($result = mysqli_query($link, $sql)) {
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $note_id = $row['id'];
                $note = $row['notes'];
                $time = $row['time'];
                $time = date("F d l, Y G:i:s A", $time);
                
                echo "
                <div class='note'>
                    <div class='note-delete'>
                        <button class='btn-lg btn-danger delete-button'>Delete</button>
                    </div>
                    <div class='notes-box' id='$note_id'>
                        <div class='notes-box__header'>$note</div>
                        <div class='notes-box__time'>$time</div>  
                    </div>
                </div>";
            }
        } else {
            echo "<div class='alert alert-danger'>You have not created any notes yet!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>An error occured!</div>";
    }

 