<?php

$userId = checkUser($mysqli);

if(count($_POST)) {
    $title = $_POST['title'] ?? null;
    $content = $_POST['content'] ?? null;
    $query = "INSERT INTO article SET 
          userId = " . $userId . ", 
          title = '" . $title . "', 
          content = '" . $content . "', 
          createdAt = now()";
    $mysqli->query($query);
    header('Location: /?act=articles');
    exit;
}

require_once 'templates/add.php';