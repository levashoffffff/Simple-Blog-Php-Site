<?php

$userId = checkUser($mysqli);

$id = $_GET['id'] ?? null;
if(!$id) {
    header('Location: /?act=articles');
    die();
}

if(count($_POST)) {
    $title = $_POST['title'] ?? null;
    $content = $_POST['content'] ?? null;
    $query = "UPDATE article SET 
          userId = " . $userId . ", 
          title = '" . $title . "', 
          content = '" . $content . "'
          WHERE 
          id = " . $id . "
          AND 
          userId = " . $userId; 
    $mysqli->query($query);
    header('Location: /?act=articles');
    exit;
}

$results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "' AND userId = " . $userId . " LIMIT 1");
$article = $results->fetch_assoc();
if(!$article) {
    header('Location: /?act=articles');
    die();
}

require_once 'templates/edit.php';