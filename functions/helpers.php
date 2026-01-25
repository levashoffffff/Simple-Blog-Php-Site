<?php

function checkUser($mysqli): int {
    
    if(empty($_SESSION['userId'])) {
        header('Location: /?act=login');
        die();
    }
    $userId = (int)$_SESSION['userId'];
    $results = $mysqli->query("SELECT * from user WHERE id = '" . $userId . "' LIMIT 1");
    $user = $results->fetch_assoc();
    if(!$user) {
        header('Location: /?act=login');
        die();
    }

    return $userId;
}