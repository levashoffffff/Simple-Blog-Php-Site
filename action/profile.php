<?php

/* $user = checkUser($mysqli); */
$user = checkUser($pdo);

if(count($_POST)) {
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $about = $_POST['about'] ?? null;
    
    //Запрос pdo
    $stmt = $pdo->prepare("UPDATE user SET 
          name = ?, 
          surname = ?, 
          phone = ?, 
          about = ?
          WHERE id = ?");
    $stmt->execute([$name, $surname, $phone, $about, (int)$user['id']]);

    //Запрос mysqli
    /* $query = "UPDATE user SET 
          name = '" . $name . "', 
          surname = '" . $surname . "', 
          phone = '" . $phone . "', 
          about = '" . $about . "' 
          WHERE id = " . (int)$user['id'];
    $mysqli->query($query); */
      redirect('/?act=profile');
}

require_once 'templates/profile.php';