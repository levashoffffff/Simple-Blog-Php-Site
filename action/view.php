<?php

$id = (int)$_GET['id'];

//Запрос pdo
$stmt = $pdo->prepare("SELECT * from article WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

$stmtComment = $pdo->prepare("SELECT c.*, u.* from comment c LEFT JOIN user u ON u.id = c.userId WHERE articleId = ? AND isModerative = 1");
$stmtComment->execute([$id]);


//Запрос mysqli
/* $results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "'"); */
/* $article = $results->fetch_assoc(); */

if(count($_POST)) {
    $comment = $_POST['comment'];
    $user = getUser($pdo);
    $userId = $user['id'] ?? null;
    $isModerative = $userId ? 1 : 0;
    $stmtAddComment = $pdo->prepare("INSERT INTO comment SET userId = ?, articleId = ?, content = ?, isModerative = ?, createdAt = NOW()");
    $stmtAddComment->execute([$userId, $id, $comment, $isModerative]);
    redirect('/?act=view&id=' . $id);
}

require_once 'templates/view.php';