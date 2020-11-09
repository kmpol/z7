<?php
$folder = $_POST['podkatalog'];

    $_SESSION['id'] = $_COOKIE['user'];
    if(isset($_COOKIE['user'])) {
        if(!@mkdir($_COOKIE['user'] ."/$folder", 0777, true)) {
        };
    }

?>