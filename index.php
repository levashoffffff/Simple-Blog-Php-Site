<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Проверяем, запрашивают ли css или js файл
/* if (strpos($_SERVER['REQUEST_URI'], '.css') !== false || 
    strpos($_SERVER['REQUEST_URI'], '.js') !== false) {
    
    $filePath = __DIR__ . $_SERVER['REQUEST_URI'];
    if (file_exists($filePath)) {
        // Определяем тип контента
        if (strpos($_SERVER['REQUEST_URI'], '.css') !== false) {
            header('Content-Type: text/css');
        } else if (strpos($_SERVER['REQUEST_URI'], '.js') !== false) {
            header('Content-Type: application/javascript');
        }
        
        readfile($filePath);
        exit;
    }
} */

session_start();

//Подключаем и данные файлы доступны во всем коде
require_once 'config/config.php';
//Файл с маршрутами
require_once 'config/router.php';
require_once 'functions/helpers.php';

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';

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

///ТУТ ОШИБКА РАЗОБРАТЬСЯ
/* $user = checkAdminUser(/*$mysqli*//*$pdo); */

if(isset($_REQUEST['act']) && !empty($routers[$_REQUEST['act']])) {
    require_once $routers[$_REQUEST['act']];
} else {
    require_once 'action/index.php';
}
