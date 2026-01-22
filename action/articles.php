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

$results = $mysqli->query("SELECT * from article WHERE userId = '" . $id . "'");

require_once 'templates/articles.php';