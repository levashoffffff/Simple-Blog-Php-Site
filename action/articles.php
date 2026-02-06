<?php

$user = checkUser(/*$mysqli*/$pdo);

//Запрос pdo
$stmt = $pdo->prepare("SELECT * from article WHERE userId = ? ORDER BY id DESC");
$stmt->execute([$user['id']]);
$results = $stmt->fetchAll();

//Запрос mysqli
/* $results = $mysqli->query("SELECT * from article WHERE userId = '" . $user['id'] . "' ORDER BY id DESC"); */

require_once 'templates/articles.php';