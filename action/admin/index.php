<?php

/* $user = checkAdminUser(/*$mysqli*//*$pdo); */
$user = checkAdminUser(/*$mysqli*/$pdo);
//Запрос pdo на статьи
$stmt = $pdo->prepare("SELECT * from article ORDER BY id DESC");
$stmt->execute();
$results = $stmt->fetchAll();

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/index.php';