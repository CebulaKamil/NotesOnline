<?php
$link = mysqli_connect("mysql02.thekamilc1998.beep.pl", "db_notes_admin", "XIRonMen7789X!", "notes_online");
if(mysqli_connect_error()){
    die('ERROR: Unable to connect:' . mysqli_connect_error()); 
    echo "<script>window.alert('Hi!')</script>";
}
    ?>