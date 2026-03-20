<?php
require 'vendor/autoload.php';

$client = new WebSocket\Client("ws://localhost:8080");
$client->text("andrey@mail.ru:new-comment");
$client->close();