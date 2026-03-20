<?php

$id = (int)$_GET['id'];

//Запрос pdo
$stmt = $pdo->prepare("SELECT * from article WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

$key = 'news' . $id;
if(!isset($_COOKIE[$key]) || !$_COOKIE[$key]) {
    setcookie($key, 1, time() + 86400, "/");
    //Запрос на обновление количества просмотров
    $stmt = $pdo->prepare("UPDATE article SET views = views + 1 WHERE id = ?");
    $stmt->execute([$id]);
}

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

    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$article['userId']]);
    $creator = $stmt->fetch();

    $client = new WebSocket\Client("ws://localhost:8080");
    $client->text($creator['email'] . ":" . $id);
    $client->text(json_encode([
        'email' => $creator['email'],
        'data' => [
            'id' => $creator['email'], 
            'title' => $article['title'], 
            'commenter' => $user['email'],
        ]
        ]));
    $client->close();

    redirect('/?act=view&id=' . $id);
}

require_once 'templates/view.php';