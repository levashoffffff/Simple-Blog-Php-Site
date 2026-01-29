<?php

$user = checkUser($mysqli);
$error = '';
if(count($_POST)) {
    $title = strip_tags($_POST['title'] ?? null);
    $content = strip_tags($_POST['content'] ?? null);
    if(!$_FILES['file']['size']) {
        $error = 'Картинка не найдена';
    }elseif (!$title || !$content) {
        $error = 'Заголовок или текст не найден';
    }else {
        $filename = upload($user['id']);
        $query = "INSERT INTO article SET 
            userId = " . $user['id'] . ", 
            title = '" . $title . "', 
            content = '" . $content . "',
            img = '" . $filename . "', 
            createdAt = now()";
        $mysqli->query($query);
        header('Location: /?act=articles');
        die();
    }
}

require_once 'templates/add.php';