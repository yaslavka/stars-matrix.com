<?php
session_start();

# Автозагрузка классов
function __autoload($name) {
    include('../class/class.'.$name.'.php');
}



$config = new config;
$mail = new mail;
$func = new functions;
$base = new database($config->Host, $config->User, $config->Pass, $config->Base);
$pr = $config->Pr;

if (isset($_POST['email'])) {
    $login = $base->Real($_POST['email']);
    if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $login)) {
        $base->Query("SELECT * FROM `".$pr."_users` WHERE `email` = '".$login."'");
        if ($base->NumRows() > 0) {
            $chars = 'abcdefhiknrstyzABDEFGHKNQRSTYZ1234567890';
            $numChars = strlen($chars);
            $string = '';
            for ($i = 0; $i < 8; $i++) {
                $string .= substr($chars, rand(1, $numChars) - 1, 1);
            }
            $base->Query("UPDATE `".$pr."_users` SET `code_recovery` = '".$base->Real($string)."' WHERE `email` = '".$login."'");
            $key = $func->md5Recovery($string);

            $mail->Recovery($login, $key, $string);
            echo json_encode(array('message' => 'Сообщение с инструкцией для восстановления пароля отправлено на ваш E-mail. Письмо может идти с задержкой до 5 минут. Не забудьте проверить папку СПАМ.', 'status' => 'success'));
        
        } else echo json_encode(array('message' => 'Ошибка! Пользователь с таким E-mail не зарегистрирован.', 'status' => 'error'));
    } else echo json_encode(array('message' => 'Ошибка! E-mail имеет неверный формат.', 'status' => 'error'));
}