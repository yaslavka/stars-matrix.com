<?php
session_start();

# Автозагрузка классов
function __autoload($name) {
    include('../class/class.'.$name.'.php');
}

$conf = new config;
$func = new functions;
$mail = new mail;
$base = new database($conf->Host, $conf->User, $conf->Pass, $conf->Base);
$pr = $conf->Pr;


if ((isset($_POST['login']) && $_POST['login'] != null) or
    (isset($_POST['email']) && $_POST['email'] != null) or
    (isset($_POST['password']) && $_POST['password'] != null) or
    (isset($_POST['confirmall']) && $_POST['confirmall'] != null)) {

    $login = $_POST['login'];
    $email = $_POST['email'];
    $pass = $passorig = $_POST['password'];
    $confirmall = $_POST['confirmall'];

    $errors = null;

    if (!$confirmall) { $errors[] = "confirmall_false"; }

    if (!preg_match("/^[a-zA-Z0-9]{6,25}$/", $pass)) { $errors[] = 'pass_false'; } else { $pass = $func->md5Pass($pass); }


    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) { $errors[] = 'email_false'; }

    $base->Query("SELECT * FROM `".$pr."_users` WHERE `email` = '".$base->Real($email)."'");
    if ($base->NumRows() != 0) { $errors[] = 'email_rows'; }


    if (!preg_match("/^[a-zA-Z0-9]{4,15}$/", $login)) { $errors[] = 'login_false'; }

    $base->Query("SELECT * FROM `".$pr."_users` WHERE `login` = '".$base->Real($login)."'");
    if ($base->NumRows() != 0) { $errors[] = 'login_base'; }


} else {
    $errors[] = 'nodata';
}





if (!is_array($errors)) {
    if (isset($_COOKIE['ref'])) {
        $referer_login = $_COOKIE['ref'];
    } else {
        $referer_login = '';
    }

    $base->Query("SELECT * FROM `" . $pr . "_users` WHERE `login` = '" . $referer_login . "' LIMIT 1");
    if ($base->NumRows() <> 0) {
        $user_data = $base->FetchArray();
        $referer_id = $user_data['id'];
    } else {
        $admins_acc = $conf->AdminsAcc; // АДМИНСКИЕ ID
        $referer_id = $admins_acc[array_rand($admins_acc, 1)];    // ТУТ ВСТАВИТЬ РАНДОМНОГО СПОНСОРА АДМИНА
        $referer_id = 0; // id 0 для того чтобы были переливы от админа в глубину
    }
}


if (is_array($errors)) {
    echo $func->Responce($errors);
} else {

    $avatar = '/img/noavatar.png';
    //$hash4confirm = md5($login.$pass.time().$email);
    $hash4confirm = "1";

    $base->Query("INSERT INTO `".$pr."_users` (`login`, `email`, `password`, `user_hash`, `avatar`, `code_confirm`, `referer`) VALUES ('".$base->Real($login)."', '".$base->Real($email)."', '".$base->Real($pass)."', 'firstenter', '".$avatar."', '".$hash4confirm."', '".$referer_id."')"); // РЕАЛ

    //$base->Query("INSERT INTO `".$pr."_users` (`login`, `email`, `password`, `user_hash`, `avatar`, `code_confirm`, `referer`, `money_rur`, `money_usd`) VALUES ('".$base->Real($login)."', '".$base->Real($email)."', '".$base->Real($pass)."', 'firstenter', '".$avatar."', '1', '".$referer_id."', '100', '5')"); // ТЕСТ

    $login_id = $base->LastInsert();
    $_SESSION['uid'] = $login_id;

    $base->Query("UPDATE `".$pr."_users` SET `countref` = `countref` + '1' WHERE `id` = '".$referer_id."'");

    $m_subj = "Вы зарегистрировались в ".$_SERVER['HTTP_HOST'];
   /* $m_mess = "Здравствуйте ".$login."!<br>Вы зарегистрировались в ".$_SERVER['HTTP_HOST']."<br><br>
Для активации аккаунта, подтвердите Вашу регистрацию по ссылке: <a href='http://".$_SERVER['HTTP_HOST']."/confirm/".$login."/".$hash4confirm."'>http://".$_SERVER['HTTP_HOST']."/confirm/".$login."/".$hash4confirm."</a>
<br><br>
После активации вы сможете войти в аккаунт, используя следующие данные:<br><br> Ваш логин: ".$login."<br>Ваш пароль: ".$passorig; */

    $m_mess = "Здравствуйте ".$login."!<br>Вы зарегистрировались в ".$_SERVER['HTTP_HOST']."<br><br>
     Ваши данные для входа:<br><br> Ваш логин: ".$login."<br>Ваш пароль: ".$passorig;
    $mail->SendMail($email, $m_subj, $m_mess);

    echo $func->Responce(array('ok'));
}
