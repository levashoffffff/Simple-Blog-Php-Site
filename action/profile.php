<?php

$userId = checkUser($mysqli);

if(count($_POST)) {
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $about = $_POST['about'] ?? null;
    $query = "UPDATE user SET 
          name = '" . $name . "', 
          surname = '" . $surname . "', 
          phone = '" . $phone . "', 
          about = '" . $about . "' 
          WHERE id = " . (int)$id;
    $mysqli->query($query);
    header('Location: /?act=profile');
    exit;
}

require_once 'templates/profile.php';