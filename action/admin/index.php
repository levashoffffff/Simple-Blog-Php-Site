<?php

/* $user = checkAdminUser(/*$mysqli*//*$pdo); */
$user = checkAdminUser(/*$mysqli*/$pdo);
//Сколько статей хотим видеть на странице
$perPage = 5;
//Общее количество статей
$stmt = $pdo->prepare("SELECT COUNT(*) from article");
$stmt->execute();
$count = $stmt->fetchColumn();
//Подсчет количества страниц
$pages = ceil($count / $perPage);
//Смещение
$offset = 0;
$currentPage = (int)($_GET['page'] ?? null);
$currentPage = $currentPage > 1 ? $currentPage - 1 : 0;
$offset = $perPage * $currentPage;
//Получаем текущую страницу из URL, по умолчанию 1 Для кнопки prev и next
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
//Запрос pdo на статьи
$stmt = $pdo->prepare("SELECT * from article ORDER BY id DESC LIMIT ?, ?");
$stmt->execute([$offset, $perPage]);
$results = $stmt->fetchAll();

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/index.php';