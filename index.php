<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

//Подключаем и данные файлы доступны во всем коде
require_once 'config/config.php';
//Файл с маршрутами
require_once 'config/router.php';
require_once 'functions/helpers.php';

//Подключение к БД через PDO
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);

//Подключение к БД через mysqli
/* $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); */

if(isset($_REQUEST['act'])) {
    if(!empty($routers[$_REQUEST['act']])) {
        require_once $routers[$_REQUEST['act']];
    }
/*     switch($_REQUEST['act']) {
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
    } */
    die();
}


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