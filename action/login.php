<?php
$error = '';
if(count($_POST) > 0) {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    //Запрос через mysqli c фильтрацией данных real_escape_string от sql инъекций
    /* $email = $mysqli->real_escape_string($email);
    $results = $mysqli->query("SELECT * from user WHERE email = '" . $email . "'");
    $user = $results->fetch_assoc(); */

    //Запрос через PDO. Фильтрация не нужна, т.к. pdo сам всё фильтрует
    $stmt = $pdo->prepare("SELECT * from user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['userId'] = $user['id'];
        if($user['isAdmin']) {
            redirect('/admin');
        } else {
            redirect('/?act=profile');
        }
    } else {
        $error = 'User is not found';
    }
}

require_once 'templates/login.php';