<?php
if(count($_POST) > 0) {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $password = password_hash($password, PASSWORD_DEFAULT);

    $results = $mysqli->query("SELECT * from user WHERE email = '" . $email . "'");
    $user = $results->fetch_assoc();
    var_dump($user);
    exit;
}

require_once 'templates/login.php';