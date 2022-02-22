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


if( isset( $_POST['my_file_upload'] ) ){  
    // ВАЖНО! тут должны быть все проверки безопасности передавемых файлов и вывести ошибки если нужно
    $files      = $_FILES; // полученные файлы
    $done_files = array();

    $error = 0;

    $tempp=$files[0]["type"];
    if (($tempp=="image/gif")or($tempp=="image/png")or($tempp=="image/jpg")or($tempp=="image/jpeg")) { }  else  {
        $error = 1;
        echo json_encode(array('message' => 'Не верный формат файла. Допускается только jpg, gif и png', 'status' => 'error'));
        return;
    }

    $uploaddir = '../avatars';
    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );     // cоздадим папку если её нет

    if ($error == 0) {
        require ('../includes/imgresize.php');

        foreach( $files as $file ){ // переместим файлы из временной директории в указанную
            $num = rand(11111, 99999); $genn = md5($num); $genn = substr($genn, 0, 40);
            $razsh=substr(strrchr($file['name'], '.'), 1);
            $uploadfile = $uploaddir."/".$genn.".".$razsh;

            //$file_name = cyrillic_translit( $file['name'] );
            if ( move_uploaded_file( $file['tmp_name'], "$uploadfile" ) ) {
                $done_files[] = realpath( "$uploadfile" );
                img_resize($uploadfile, 300);
                $urlimg = $uploadfile;

                $base->Query("SELECT `avatar` FROM `".$pr."_users` WHERE `id` = '".$uid."'");
                $data_u = $base->FetchArray();
                if ($data_u["avatar"] != "") {
                    unlink($data_u["avatar"]);
                }

                $base->Query("UPDATE `".$pr."_users` SET `avatar` = '".$urlimg."' WHERE `id` = '".$uid."'");

            }
        }


        echo json_encode(array('message' => 'Фотография успешно загружена', 'status' => 'success'));
        return;

    }

    //$data = $done_files ? array('files' => $done_files ) : array('error' => 'Ошибка загрузки файлов.');
   // die( json_encode( $data ) );
}


## Транслитирация кирилических символов
function cyrillic_translit( $title ){
    $iso9_table = array(
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
        'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
    );

    $name = strtr( $title, $iso9_table );
    $name = preg_replace('~[^A-Za-z0-9\'_\-\.]~', '-', $name );
    $name = preg_replace('~\-+~', '-', $name ); // --- на -
    $name = preg_replace('~^-+|-+$~', '', $name ); // кил - на концах

    return $name;
}