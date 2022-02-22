<?php
class mail {
   
	# Сброс пароля
	function Recovery($login, $key, $code) {
        $subject = "Восстановление пароля на сайте ".$_SERVER['HTTP_HOST'];
        $message = '
            <html>
                <head>
                    <title>Сервис для заработка в интернете.</title>
                </head>
                <body>
                    <p>Здравствуйте! Вам нужно подтвердить сброс пароля на сайте - '.$_SERVER['HTTP_HOST'].'<br>
                    <a href="https://'.$_SERVER['HTTP_HOST'].'/recovery/'.$login.'/'.$key.'/'.$code.'">Сбросить пароль</a></p>
                    <p>Если ссылка "Сбросить пароль" не работает, скопируйте следующую ссылку и откройте в своём браузере: https://'.$_SERVER['HTTP_HOST'].'/recovery/'.$login.'/'.$key.'/'.$code.'</p>
                </body>
            </html>
        ';
        return $this->SendMail($login, $subject, $message);
	}
    
    # Восстановление пароля
	function RecoverySucces($login, $pass) {
        $subject = "Ваш новый пароль на сайте ".$_SERVER['HTTP_HOST'];
        $message = '
            <html>
                <head>
                    <title>Сервис для заработка в интернете.</title>
                </head>
                <body>
                    <p>Здравствуйте! Вы сбросили пароль на сайте - '.$_SERVER['HTTP_HOST'].'</p>
                    <p>Новый пароль: '.$pass.'</p>
                </body>
            </html>
        ';
        return $this->SendMail($login, $subject, $message);
	}
    
	# Создание заголовков письма
	function Headers() {
        $headers = "MIME-Version: 1.0\r\n";
        $headers.= "Content-type: text/html; charset=utf-8\r\n";
        $headers.= "Date: ".date("m.d.Y (H:i)",time())."\r\n";
        $headers.= "From: no-reply@".$_SERVER['HTTP_HOST']."\r\n";
		return $headers;
	}
	
	# Отправка
	function SendMail($recipient, $subject, $message) {
		$message .= "<br>----------------------------------------------------
		<br>Сообщение было выслано системой, пожалуйста, не отвечайте на него!";
		return (mail($recipient, $subject, $message, $this->Headers())) ? true : false;
	}
    
}
?>