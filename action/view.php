<?php

$id = (int)$_GET['id'];

//Запрос pdo
$stmt = $pdo->prepare("SELECT * from article WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

//Запрос mysqli
/* $results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "'"); */
$article = $results->fetch_assoc();

require_once 'templates/view.php';