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
    $title = $_POST['title'] ?? null;
    $content = $_POST['content'] ?? null;
    $query = "INSERT INTO article SET 
          userId = " . $id . ", 
          title = '" . $title . "', 
          content = '" . $content . "', 
          createdAt = now()";
    $mysqli->query($query);
    header('Location: /?act=articles');
    exit;
}

require_once 'templates/add.php';