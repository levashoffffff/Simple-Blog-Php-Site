<?php
$user = null;
$userId = intval($_SESSION['userId'] ?? null);
if($userId) {
    //Запрос mysqli на получение user
    /* $results = $mysqli->query("SELECT * from user WHERE id = '" . $userId . "' LIMIT 1"); */

    //Запрос pdo на получение user
    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
}
//Запрос mysqli на получение статей
/* $results = $mysqli->query("SELECT * from article ORDER BY id DESC LIMIT 9"); */

//Запрос pdo на получение статей. Поскольку подстановок нет, то использовать prepare не нужно
$stmt = $pdo->query("SELECT * from article ORDER BY id DESC LIMIT 9");

require_once 'templates/index.php';