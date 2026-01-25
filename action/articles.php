<?php

$userId = checkUser($mysqli);

$results = $mysqli->query("SELECT * from article WHERE userId = '" . $userId . "'");

require_once 'templates/articles.php';