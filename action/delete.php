<?php

$user = checkUser(/*$mysqli*/$pdo);

$id = $_GET['id'] ?? null;
if(!$id) {
    redirect('/?act=articles');
}

$article = getUserArticle(/*$mysqli*/$pdo, $id, $user);
/* $results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "' AND userId = '" . $user['id'] . "'");
$article = $results->fetch_assoc();
if(!$article) {
    header('Location: /?act=articles');
    die();
} */
unlink($_SERVER['DOCUMENT_ROOT'] . "/images/" . $article['img']);

if($user['isAdmin']) {
    $stmt = $pdo->prepare("DELETE FROM article WHERE id = ?");
    $stmt->execute([$id]);
} else {
    $stmt = $pdo->prepare("DELETE FROM article WHERE id = ? AND userId = ?");
    $stmt->execute([$id, $user['id']]);
}


//Запрос mysqli
/* $mysqli->query("DELETE FROM article WHERE id = " . $id . " AND userId = " . $user['id']); */
if($user['isAdmin'] == 1) {
    redirect('/?act=adminArticles');
}else {
    redirect('/?act=articles');
}
