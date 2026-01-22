<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config.php';
session_start();
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
    }
    die();
}

require_once 'templates/index.php';