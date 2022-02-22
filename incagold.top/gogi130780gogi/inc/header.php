<?php
?>

<html>
<head>
    <!-- Заголовок страниц -->
    <title>{!TITLE!}</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Шрифты, стили и иконка -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/gogi130780gogi/css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/bootstrap/4.0.0/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
</head>

<body>
    <div class="wrap">
        <?php
        if ($admin_auth == true) {


            $db->Query("SELECT `id` FROM `".$pref."_withdrawal` WHERE `stat` = '0'");
            $c_withdraw = $db->NumRows();
            $db->Query("SELECT `id` FROM `".$pref."_orders` WHERE `delivery` = '0' AND `stat` > '0'");
            $c_delivery = $db->NumRows();
            $db->Query("SELECT `id` FROM `".$pref."_feedback` WHERE `stat` = '1'");
            $c_fb = $db->NumRows();

        ?>
            <div class="header">
                <div class="title">
                    <div class="title_img"><img src="/gogi130780gogi/img/title.png" alt="img" style="width: 40px"></div>
                    <div class="title_text">Панель администратора</div>
                </div>
            </div>
        
            <div class="content">
                <div class="headc">{!TITLE!}</div>
                <div class="bodyc">
                    <div class="menu">
                        <div class="menu_title">Разделы панели</div>
                        <div class="menu_cat">Работа</div>
                        <ul>
                            <li><a href="/gogi130780gogi/?menu=auth&sel=stata">Статистика</a></li>
                            <li><a href="/gogi130780gogi/?menu=auth&sel=users">Пользователи</a></li>
                            <!--<li><a href="/gogi130780gogi/?menu=auth&sel=orders">Заказы <?=($c_delivery > 0) ? "[".$c_delivery."]" : ""?></a></li>
                            <li><a href="/gogi130780gogi/?menu=auth&sel=orders_arch">Архив заказов</a></li>-->
                            <li><a href="/gogi130780gogi/?menu=auth&sel=feedback">Отзывы <?=($c_fb > 0) ? "[".$c_fb."]" : ""?></a></li>
                            <li><a href="/gogi130780gogi/?menu=auth&sel=withdrawal">Запросы на вывод <?=($c_withdraw > 0) ? "[".$c_withdraw."]" : ""?></a></li>
                        </ul>
                        <div class="menu_cat">Настройки</div>
                        <ul>
                            <li><a href="/gogi130780gogi/?menu=auth&sel=settings">Настройки</a></li>

                            <li><a href="/gogi130780gogi/?menu=auth&sel=logout">Выход</a></li>
                        </ul>
                    </div>
                    
                    <div class="content_right">
            <?php
        }