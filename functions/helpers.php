<?php
//Импортируем необходимые классы для PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
/* use PHPMailer\PHPMailer\SMTP; */
use PHPMailer\PHPMailer\Exception;

function getUserIp() {
    if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

//Функция для отправки почты
function sendEmail(string $subject, string $body) : void {
    $mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                      // Отправка через SMTP
    $mail->Host       = 'ssl://smtp.mail.ru';                 // Основной SMTP сервер
    $mail->SMTPAuth   = true;                             // Включить аутентификацию
    $mail->Username   = 'artur.levashoff@mail.ru';           // Ваш email
    $mail->Password   = '7joIoWsbvnRo3ubNKSu3';              // Пароль приложения
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Шифрование TLS
    $mail->Port       = 465;                              // Порт для TLS
    $mail->CharSet = "UTF-8";
    // --- ПОЛУЧАТЕЛИ ---
    $mail->setFrom('artur.levashoff@mail.ru', 'Artur Levashov');  // От кого
    $mail->addAddress('artur.levashoff@gmail.com', 'Joe User'); // Кому

    // --- СОДЕРЖИМОЕ ПИСЬМА ---
    $mail->isHTML(true);                                  // Формат письма - HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    // --- ОТПРАВКА ---
    $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        die();
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