<?php
class functions {

    public function getUrl($url, $mask = "^[a-zA-Z0-9_]", $len = "{2,40}") {
		return (is_array($url)) ? false : (preg_match("/{$mask}{$len}$/", $url)) ? $url : false;
	}

    public function isAjax($text, $mask = "^[a-zA-Z0-9_]", $len = "{2,40}") {
		return (is_array($text)) ? false : (preg_match("/{$mask}{$len}$/", $text)) ? $text : false;
	}
    
    public function isMail($mail) {
		if(is_array($mail) && empty($mail) && mb_strlen($mail) > 255 && strpos($mail,'@') > 64) return false;
			return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail)) ? false : strtolower($mail);
	}
    
	public function isLogin($login, $mask = "^[a-zA-Z0-9]", $len = "{4,16}") {
		return (is_array($login)) ? false : (preg_match("/{$mask}{$len}$/", $login)) ? $login : false;
	}
    
    public function isPass($password, $mask = "^[a-zA-Z0-9]", $len = "{6,25}") {
		return (is_array($password)) ? false : (preg_match("/{$mask}{$len}$/", $password)) ? $password : false;
	}
    
    public function isName($name, $mask = "^[A-Za-zА-Яа-яЁё]", $len = "{0,20}") {
		return (is_array($name)) ? false : (preg_match("/{$mask}{$len}$/ui", $name)) ? $name : false;
	}

    public function isLastName($lname, $mask = "^[A-Za-zА-Яа-яЁё]", $len = "{0,20}") {
		return (is_array($lname)) ? false : (preg_match("/{$mask}{$len}$/ui", $lname)) ? $lname : false;
	}

    public function isPhone($phone, $mask = "^[+][0-9]", $len = "{7,17}") {
		return (is_array($phone)) ? false : (preg_match("/{$mask}{$len}$/", $phone)) ? $phone : false;
	}

    public function isText($res, $len1, $len2, $mask = "^[A-Za-zА-Яа-яЁё\ ]") {
		return (is_array($res)) ? false : (preg_match("/{$mask}{{$len1},{$len2}}$/ui", $res)) ? $res : false;
	}

    public function isNum($res, $len1, $len2, $mask = "^[0-9\ ]") {
		return (is_array($res)) ? false : (preg_match("/{$mask}{{$len1},{$len2}}$/ui", $res)) ? $res : false;
	}

    public function isTextNum($res, $len1, $len2, $mask = "^[A-Za-zА-Яа-яЁё0-9\ ]") {
		return (is_array($res)) ? false : (preg_match("/{$mask}{{$len1},{$len2}}$/ui", $res)) ? $res : false;
	}

    public function ProcessText($text) {
		$text = trim($text); # Удаляем пробелы по бокам
		$text = stripslashes($text); # Удаляем слэши
		$text = htmlspecialchars($text); # Переводим HTML в текст
		$text = preg_replace("/ +/", " ", $text); # Множественные пробелы заменяем на одинарные
		$text = preg_replace("/(\r\n){3,}/", "\r\n\r\n", $text); # Убираем лишние переводы строк (больше 1 строки)
		$test = nl2br ($text); # Заменяем переводы строк на тег
		$text = preg_replace("/^\"([^\"]+[^=><])\"/u", "$1«$2»", $text); # Ставим людские кавычки
		$text = preg_replace("/(«){2,}/","«",$text); # Убираем лишние левые кавычки (больше 1 кавычки)
		$text = preg_replace("/(»){2,}/","»",$text); # Убираем лишние правые кавычки (больше 1 кавычки)      
		$text = preg_replace("/(\r\n){2,}/u", "</p><p />", $text); # Ставим абзацы
		$text = preg_replace("~(\\\|\*|\?|\[|\?|\]|\(|\\\$|\))~", "",$text);
		return $text;
	}
    
    public function Responce($a){
      echo json_encode(array('responce'=>$a));
    }

    
    public function md5Recovery($code) {
		$code = strtolower(trim($code));
		return md5("rgbvxf".$code."6hgdd");
	}
    
        public function md5Pass($pass) {
		$pass = strtolower(trim($pass));
		return md5("ggyhf".$pass."yyutgr");
	}
    
    
    public function FormCode($user) {
		return md5($user."Ft6mDo4".date('d'));
	}
    
    public function generatePas($length=10) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = mb_strlen($chars) - 1;  
        while (mb_strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        $code = $code;
        return $code;
    }

    public function viewk($amount) {
        if ($amount >= 1000000) { $result = $amount / 1000000; $result .= " МЛН"; }
        elseif ($amount >= 10000) { $result = $amount / 1000; $result .= "К"; }
        elseif ($amount >= 0) { $result = $amount; }
        return $result;
    }


}