<?php
// Файлы phpmailer
require 'PHPMailer-6.5.4/PHPMailer.php';
require 'PHPMailer-6.5.4/SMTP.php';
require 'PHPMailer-6.5.4/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$tel = $_POST['tel'];
$servise = $_POST['servise'];
$messager = $_POST['messager'];

// Формирование самого письма
$title = "Заголовок письма";
$body = "
<h2>Привет! Владик, тебе пришла заявка! Пора за работу!</h2>
<b>Имя:</b> $name<br>
<b>Телефон для связи:</b> $tel<br>
<b>Выбранная Услуга:</b> $servise<br>
<b>Мессенджер для связи:</b> $messager<br>
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'bot.zayavka@mail.ru'; // Логин на почте
    $mail->Password   = 'JdavzMq75dcGsU6dBgMj'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('bot.zayavka@mail.ru', 'БОт отправки формы'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('2gk03@mail.ru');

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result, "status" => $status]);