<?php
if(empty($_SESSION['userId'])) {
    header('Location: /?act=login');
    die();
}
$id = $_SESSION['userId'];
$results = $mysqli->query("SELECT * from user WHERE id = '" . $id . "' LIMIT 1");
$user = $results->fetch_assoc();
if(!$user) {
    header('Location: /?act=login');
    die();
}

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