<?php

$user = checkUser(/*$mysqli*/$pdo);

$id = $_GET['id'] ?? null;
if(!$id) {
    redirect('/?act=articles');
}

$article = getUserArticle(/*$mysqli*/$pdo, $id, $user['id']);
/* $results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "' AND userId = '" . $user['id'] . "'");
$article = $results->fetch_assoc();
if(!$article) {
    header('Location: /?act=articles');
    die();
} */
unlink($_SERVER['DOCUMENT_ROOT'] . "/images/" . $article['img']);
//Запрос pdo
$stmt = $pdo->prepare("DELETE FROM article WHERE id = ? AND userId = ?");
$stmt->execute([$id, $user['id']]);

//Запрос mysqli
/* $mysqli->query("DELETE FROM article WHERE id = " . $id . " AND userId = " . $user['id']); */
redirect('/?act=articles');