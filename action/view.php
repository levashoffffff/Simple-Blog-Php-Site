<?php

$id = (int)$_GET['id'];
$results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "'");
$article = $results->fetch_assoc();

require_once 'templates/view.php';