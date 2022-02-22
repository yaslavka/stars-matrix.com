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

if(isset($_POST['auth'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];
    
    $base->Query("SELECT `id`, `login`, `password`, `ban` FROM `".$pr."_users` WHERE `login` = '".$base->Real($login)."' OR `email` = '".$base->Real($login)."'");
    if ($base->NumRows() == 1) {
        $login_data = $base->FetchArray();
        $pass = $func->md5Pass($_POST['password']);
        if ($login_data['password'] === $pass) {
            if ($login_data['ban'] == 0) {
            
                $remember = 'off';
                $hash = md5($login_data['id'].$login_data['login'].$login_data['password'].time());
                if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                    $base->Query("UPDATE `".$pr."_users` SET `user_hash` = '".$hash."' WHERE `id` = '".intval($login_data['id'])."' LIMIT 1");                
                    $remember = 'on';
                }
                $base->Query("UPDATE `".$pr."_users` SET `user_hash` = '".$hash."' WHERE `id` = '".intval($login_data['id'])."' LIMIT 1");
                $_SESSION['uid'] = $login_data['id'];
                echo json_encode(array('user_hash' => $hash, 'remember' => $remember, 'status' => 'success'));
                
            } else echo json_encode(array('err_ban' => 'err_ban', 'status' => 'error')); 
        } else echo json_encode(array('err_pass' => 'err_pass', 'status' => 'error'));
    } else echo json_encode(array('err_login' => 'err_login', 'status' => 'error'));
}