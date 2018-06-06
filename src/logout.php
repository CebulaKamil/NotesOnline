<?php

    if (isset($_SESSION['user_id'])) {
        if (isset($_GET['logout']) && $_GET['logout'] == 1) {
            session_destroy();
            setcookie("rememberme", "", time() - 3600);  
        }
    }
