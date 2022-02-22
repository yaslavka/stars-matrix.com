<!DOCTYPE html>
<html>
    <head>
        <title>{!TITLE!}</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="keywords" content="{!KEYWORDS!}">
        <meta name="description" content="{!DESCRIPTION!}">
        <link rel="shortcut icon" href="/favicon.png">
        <link rel="stylesheet" type="text/css" href="/bootstrap/4.0.0/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/css/metisMenu.min.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Exo+2:400,700|Open+Sans:400,600|PT+Sans:400,700|Roboto:400,500">
        <link rel="stylesheet" href="/lp/css/style4.css">
        
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/bootstrap/4.0.0/js/bootstrap.js"></script>
        <script type="text/javascript" src="/js/core.js"></script>
        <script type="text/javascript" src="/js/clipboard.min.js"></script>
        <script type="text/javascript" src="/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/js/metisMenu.min.js"></script>
        
        <script src="//ulogin.ru/js/ulogin.js"></script>

        <script type="text/javascript" src="/js/jquery.noty.packaged.min.js"></script>
        <script type="text/javascript" src="/js/default.js"></script>
        

<link href='/styles/bootstrap.min.css' rel='stylesheet' type='text/css'>
<link href='/styles/animate.css' rel='stylesheet' type='text/css'>
<link href='/styles/custom.css' rel='stylesheet' type='text/css'>
<link href='/styles/tab.css' rel='stylesheet' type='text/css'>
<link rel="icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="/css/font-awesome.css" />
<meta name="keywords" content="CAEC LTD, CRYPTO ARBITRAGE EDUCATION CLUB LTD, caec7-ltd.com, caec7, caec, инвестиции, инвестиционная платформа"/>
<meta name="description" content="Добро пожаловать в международную компанию CRYPTO ARBITRAGE EDUCATION CLUB LTD"/>



    </head>
    
<body <?php if (isset($_SESSION["uid"])) { echo 'style="    background: linear-gradient(to right, rgba(167,80,37,1) 0%,rgba(248,186,18,1) 50%,rgba(167,80,37,1) 100%)"'; } ?>>


    <?php
    if (isset($_SESSION["uid"])) {
        $uid = intval($_SESSION['uid']);
        $base->Query("SELECT * FROM `" . $pr . "_users` WHERE `id` = '" . $uid . "' LIMIT 1");
        $user_data = $base->FetchArray();
        if ($user_data['avatar'] != null) {
            $avatar = "/".$user_data['avatar'];
        } else {
            $avatar = '/img/noavatar.png';
        }
    }
    ?>

    <?php include 'includes/menu_top.php'; ?>




    <div class="row center">
        <div class="col-sm-12 col-lg-<?=(isset($_SESSION["uid"])) ? "3" : "2"; ?>" <?=(isset($_SESSION["uid"])) ? "style='    background: linear-gradient(to right, rgba(167,80,37,1) 0%,rgba(248,186,18,1) 50%,rgba(167,80,37,1) 100%); padding-left: 0px; padding-right: 5px;'" : "0"; ?> ><?php include 'includes/menu_left.php'; ?></div>
        <div class="col-sm-12 col-lg-8 contentbox"  <?php if (isset($_SESSION["uid"])) { echo 'style="background: linear-gradient(to right, rgba(167,80,37,1) 0%,rgba(248,186,18,1) 50%,rgba(167,80,37,1) 100%);"'; } ?>>








