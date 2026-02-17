<?php

$user = checkUser(/*$mysqli*/$pdo);

$id = $_GET['id'] ?? null;
if(!$id) {
    redirect('/?act=articles');
}

if(count($_POST)) {
    $sql = '';
    if($_FILES['file']['size']) {
        $filename = upload($user['id']);
        $sql = "img = '" . $filename . "', ";
        $article = getUserArticle(/*$mysqli*/$pdo, $id, $user);
        unlink($_SERVER['DOCUMENT_ROOT'] . "/images/" . $article['img']);
    }
    $title = strip_tags($_POST['title'] ?? null);
    $content = strip_tags($_POST['content'] ?? null);
    if($user['isAdmin']) {
        $stmt = $pdo->prepare("UPDATE article SET
          " . $sql . " 
          title = ?, 
          content = ?
          WHERE 
          id = ?");
        $stmt->execute([$title, $content, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE article SET
            " . $sql . " 
            title = ?, 
            content = ?
            WHERE 
            id = ?
            AND 
            userId = ?");
        $stmt->execute([$title, $content, $id, $user['id']]);
    }


    //Запрос mysqli
    /* $query = "UPDATE article SET
          " . $sql . " 
          title = '" . $title . "', 
          content = '" . $content . "'
          WHERE 
          id = " . $id . "
          AND 
          userId = " . $user['id']; 
    $mysqli->query($query); */
    if($user['isAdmin']) {
        redirect('/?act=adminArticles');
    } else {
        redirect('/?act=articles');
    }
    
}

if($user['isAdmin']) {
    //Если админ
    $stmt = $pdo->prepare("SELECT * from article WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
} else {
    //Если обычный пользователь
    $stmt = $pdo->prepare("SELECT * from article WHERE id = ? AND userId = ? LIMIT 1");
    $stmt->execute([$id, $user['id']]);
}

$article = $stmt->fetch();

//Запрос mysqli
/* $results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "' AND userId = " . $user['id'] . " LIMIT 1");
$article = $results->fetch_assoc(); */
if(!$article) {
    redirect('/?act=articles');
}

require_once 'templates/edit.php';