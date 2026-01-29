<?php

$user = checkUser($mysqli);

$id = $_GET['id'] ?? null;
if(!$id) {
    header('Location: /?act=articles');
    die();
}

$article = getUserArticle($mysqli, $id, $user['id']);
/* $results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "' AND userId = '" . $user['id'] . "'");
$article = $results->fetch_assoc();
if(!$article) {
    header('Location: /?act=articles');
    die();
} */
unlink($_SERVER['DOCUMENT_ROOT'] . "/images/" . $article['img']);
$mysqli->query("DELETE FROM article WHERE id = " . $id . " AND userId = " . $user['id']);
header('Location: /?act=articles');