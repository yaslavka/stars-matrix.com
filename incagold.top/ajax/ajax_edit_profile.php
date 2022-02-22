<?php
session_start();
$uid = intval($_SESSION['uid']);

# Автозагрузка классов
function __autoload($name) {
    include('../class/class.'.$name.'.php');
}

$conf = new config;
$func = new functions;
$base = new database($conf->Host, $conf->User, $conf->Pass, $conf->Base);
$pr = $conf->Pr;


if (isset($_POST['edit']) && $_POST['edit'] == 'acc') {
    $error = 0;

    $lastname = $func->isLastName($_POST['lastname']);
    if ($lastname === false) {
        $error = 1;
        echo json_encode(array('message' => 'Фамилия имеет неверный формат! Разрешены только буквы и цифры русского и английского алфавита.', 'status' => 'error'));
        return;
    }

    $name = $func->isName($_POST['firstname']);
    if ($name === false) {
        $error = 1;
        echo json_encode(array('message' => 'Имя имеет неверный формат! Разрешены только буквы и цифры русского и английского алфавита.', 'status' => 'error'));
        return;
    }

    $skype = $base->Real($_POST['skype']);
    $vk = $base->Real($_POST['vk']);

    $phone = $_POST['phone'];
    //$phone = str_replace(array("(",")"," ","-"), "", $phone);
    $phone = $func->isPhone($phone);
    if ($phone === false) {
        $error = 1;
        echo json_encode(array('message' => 'Укажите телефон в международном формате, со знаком "+" и от 10 до 17 цифр. ', 'status' => 'error'));
        return;
    }

    
    if ($error == 0) {
        $base->Query("UPDATE `".$pr."_users` SET `firstname` = '".$name."', `lastname` = '".$lastname."', `skype` = '".$skype."', `vk` = '".$vk."', `phone` = '".$phone."' WHERE `id` = '".$uid."'");
        echo json_encode(array('message' => 'Данные успешно изменены!', 'status' => 'success'));
        return;
    }
}

if (isset($_POST['feedback']) && $_POST['feedback'] == 'create') {
    $error = 0;

    $base->Query("SELECT * FROM `".$pr."_feedback` WHERE `uid` = '".$uid."' AND `stat` = '2'");
    if ($base->NumRows() != 0) {
        $error = 1;
        echo json_encode(array('message' => 'Вы уже оставили отзыв', 'status' => 'error'));
        return;
    }

    if ((strlen($_POST['theme'])<5)or(strlen($_POST['theme'])>300)) {
        $error = 1;
        echo json_encode(array('message' => 'Укажите заголовок отзыва. От 5 до 300 символов', 'status' => 'error'));
        return;
    }
    $theme = $func->ProcessText($_POST['theme']);

    if ((strlen($_POST['mess'])<100)or(strlen($_POST['mess'])>10000)) {
        $error = 1;
        echo json_encode(array('message' => 'Напишите ваш отзыв. От 100 до 10000 символов', 'status' => 'error'));
        return;
    }
    $mess = $func->ProcessText($_POST['mess']);

    if ($error == 0) {
        $base->Query("INSERT INTO `".$pr."_feedback` (`uid`, `theme`, `mess`, `stat`) VALUES ('".$uid."', '".$base->Real($theme)."', '".$base->Real($mess)."', '1')");
        echo json_encode(array('message' => 'Отзыв успешно отправлен', 'status' => 'success'));
        return;
    }
}



if (isset($_POST['edit']) && $_POST['edit'] == 'delivery') {
    $error = 0;

    $country = $func->isText($_POST['country'], 2, 50);
    if ($country === false) {
        $error = 1;
        echo json_encode(array('message' => 'Страна имеет неверный формат! Разрешены только буквы русского и английского алфавита.', 'status' => 'error'));
        return;
    }
    $region = $func->isText($_POST['region'], 2, 50);
    if ($region === false) {
        $error = 1;
        echo json_encode(array('message' => 'Регион/Область имеет неверный формат! Разрешены только буквы русского и английского алфавита.', 'status' => 'error'));
        return;
    }
    $postcode = $func->isTextNum($_POST['postcode'], 2, 10);
    if ($postcode === false) {
        $error = 1;
        echo json_encode(array('message' => 'Почтоый индекс имеет неверный формат! Разрешены только буквы и цифры русского и английского алфавита.', 'status' => 'error'));
        return;
    }
    $city = $func->isText($_POST['city'], 2, 50);
    if ($city === false) {
        $error = 1;
        echo json_encode(array('message' => 'Город имеет неверный формат! Разрешены только буквы русского и английского алфавита.', 'status' => 'error'));
        return;
    }
    $street = $func->isText($_POST['street'], 2, 60);
    if ($street === false) {
        $error = 1;
        echo json_encode(array('message' => 'Улица имеет неверный формат! Разрешены только буквы русского и английского алфавита.', 'status' => 'error'));
        return;
    }
    $home = $func->isTextNum($_POST['home'], 1, 40);
    if ($home === false) {
        $error = 1;
        echo json_encode(array('message' => 'Дом имеет неверный формат! Разрешены только буквы и цифры русского и английского алфавита.', 'status' => 'error'));
        return;
    }
    $kvartira = $func->isTextNum($_POST['kvartira'], 0, 14);
    if ($kvartira === false) {
        $error = 1;
        echo json_encode(array('message' => 'Квартира имеет неверный формат! Разрешены только буквы и цифры русского и английского алфавита.', 'status' => 'error'));
        return;
    }


    if ($error == 0) {
        $base->Query("UPDATE `".$pr."_users` SET `postcode` = '".$postcode."', `country` = '".$country."', `region` = '".$region."', `city` = '".$city."', `street` = '".$street."', `home` = '".$home."', `kvartira` = '".$kvartira."' WHERE `id` = '".$uid."'");
        echo json_encode(array('message' => 'Данные успешно изменены!', 'status' => 'success'));
        return;
    }
}








if (isset($_POST['edit']) && $_POST['edit'] == 'pass') {
    //$uid = intval($_POST['uid']);
    $error = 0;
    
    $old_pass = $func->md5Pass($_POST['old_pass']);
    $base->Query("SELECT `password` FROM `".$pr."_users` WHERE `id` = '".$uid."'");
    $pass = $base->FetchRow();
    if($old_pass != $pass) {
        $error = 1;
        echo json_encode(array('message' => 'Старый пароль введен неверно!', 'status' => 'error'));
        return;
    }
    
    $new_pass = $func->isPass($_POST['new_pass']);
    $new_repass = $func->isPass($_POST['new_repass']);
    if ($new_pass === false) {
        $error = 1;
        echo json_encode(array('message' => 'Новый пароль имеет неверный формат! Разрешены только буквы и цифры английского алфавита.', 'status' => 'error'));
        return;
    }
    
    if ($new_pass != $new_repass) {
        $error = 1;
        echo json_encode(array('message' => 'Новый пароль и повтор пароля не совпадают!', 'status' => 'error'));
        return;
    }
   
    if ($error == 0) {
        $new_pass = $func->md5Pass($_POST['new_pass']);
        $base->Query("UPDATE `".$pr."_users` SET `password` = '".$new_pass."' WHERE `id` = '".$uid."'");
        echo json_encode(array('message' => 'Новый пароль успешно установлен!', 'status' => 'success'));
        return;
    }
}
?>