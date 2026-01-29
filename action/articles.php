<?php

$user = checkUser($mysqli);

$results = $mysqli->query("SELECT * from article WHERE userId = '" . $user['id'] . "' ORDER BY id DESC");

require_once 'templates/articles.php';