<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

//Подключаем и данные файлы доступны во всем коде
require_once 'config.php';
require_once 'functions/helpers.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(isset($_GET['act'])) {
    switch($_GET['act']) {
        case 'register': 
            require_once 'action/register.php';
            break;
        case 'login': 
            require_once 'action/login.php';
            break;
        case 'profile': 
            require_once 'action/profile.php';
            break;
        case 'add': 
            require_once 'action/add.php';
            break;
        case 'articles': 
            require_once 'action/articles.php';
            break;
        case 'edit': 
            require_once 'action/edit.php';
            break;
        case 'delete': 
            require_once 'action/delete.php';
            break;
        case 'logout': 
            require_once 'action/logout.php';
            break;
        case 'view': 
            require_once 'action/view.php';
            break;
    }
    die();
}


$user = null;
$userId = intval($_SESSION['userId'] ?? null);
if($userId) {
    $results = $mysqli->query("SELECT * from user WHERE id = '" . $userId . "' LIMIT 1");
    $user = $results->fetch_assoc();
}

$results = $mysqli->query("SELECT * from article ORDER BY id DESC LIMIT 9");

require_once 'templates/index.php';