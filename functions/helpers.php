<?php
//Импортируем необходимые классы для PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Функция для отправки почты
function sendEmail() : void {
    $mail = new PHPMailer(true);

try {

    $mail->isSMTP();                                      // Отправка через SMTP
    $mail->Host       = 'ssl://smtp.mail.ru';                 // Основной SMTP сервер
    $mail->SMTPAuth   = true;                             // Включить аутентификацию
    $mail->Username   = 'artur.levashoff@mail.ru';           // Ваш email
    $mail->Password   = 'your-app-password';              // Пароль приложения
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Шифрование TLS
    $mail->Port       = 465;                              // Порт для TLS

    // --- ПОЛУЧАТЕЛИ ---
    $mail->setFrom('your-email@gmail.com', 'Your Name');  // От кого
    $mail->addAddress('recipient@example.com', 'Joe User'); // Кому

    // --- СОДЕРЖИМОЕ ПИСЬМА ---
    $mail->isHTML(true);                                  // Формат письма - HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // --- ОТПРАВКА ---
    $mail->send();
    echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function checkUser(/*$mysqli*/$pdo): array {
    if(empty($_SESSION['userId'])) {
        redirect('/?act=login');
    }
    $userId = (int)$_SESSION['userId'];
    //Запрос mysqli
    /* $results = $mysqli->query("SELECT * from user WHERE id = '" . $userId . "' LIMIT 1");
    $user = $results->fetch_assoc(); */

    //Запрос pdo на пользователя
    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    if(!$user) {
        redirect('/?act=login');
    }

    return $user;
}

function checkAdminUser(/*$mysqli*/$pdo): array {
    $user = checkUser($pdo);
    if($user['isAdmin'] != 1) {
        redirect('/?act=login');
    }

    return $user;
}

function getUser(/*$mysqli*/$pdo): array {
    $userId = (int)($_SESSION['userId'] ?? null);
    if(!$userId) {
        return[];
    }
    //Запрос pdo на пользователя
    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    if(!$user) {
        return[];
    }

    return $user;
}

function upload(int $userId):string {
    $img = $_FILES['file']['tmp_name'];
        $size_img = getimagesize($img);
        $width = $size_img[0];
        $height = $size_img[1];
        $mime = $size_img['mime'];
        switch ($size_img['mime']) {
            case 'image/jpeg':
                $src = imagecreatefromjpeg($img);
                $ext = "jpg";
                break;
            case 'image/gif':
                $src = imagecreatefromgif($img);
                $ext = "gif";
                break;
            case 'image/png':
                $src = imagecreatefrompng($img);
                $ext = "png";
        }

        $wNew = 348;
        $hNew = floor($height / ($width / $wNew));
        $dest = imagecreatetruecolor($wNew, $hNew);

        imagecopyresampled($dest, $src, 0, 0, 0, 0, $wNew, $hNew, $width, $height);
        
        $microtime = str_replace('.', '', microtime(true));
        $random = rand(100, 999);
        $filename = "photo-" . $userId . "-" . $microtime . "-" . $random . '.' . $ext;
        $fullFilename = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $filename;

        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($dest, $fullFilename, 100);
                break;
            case 'image/gif':
                imagegif($dest, $fullFilename);
                break;
            case 'image/png':
                imagepng($dest, $fullFilename);
                break;
        }

    return $filename;
}

function getUserArticle(/*$mysqli*/$pdo,  int $id, array $user):array {
    if($user['isAdmin'] == 1) {
        $stmt = $pdo->prepare("SELECT * from article WHERE id = ?");
        $stmt->execute([$id]);
    } else {
        //Запрос pdo
        $stmt = $pdo->prepare("SELECT * from article WHERE id = ? AND userId = ?");
        $stmt->execute([$id, $user['id']]);
    }

    $article = $stmt->fetch();

    //Запрос mysqli
    /* $results = $mysqli->query("SELECT * from article WHERE id = '" . $id . "' AND userId = '" . $userId . "'");
    $article = $results->fetch_assoc(); */
    if(!$article) {
        redirect('/?act=articles');
    }
    return $article;
}

//Если функция ничего не возвращает, тогда void
function redirect(string $uri):void {
    header('Location: ' . $uri);
    die();
}