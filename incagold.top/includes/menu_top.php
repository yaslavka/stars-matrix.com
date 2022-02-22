<?php
if (!isset($_SESSION["uid"])) {
?>

        <div class="row nologin-area">
            <div class="col-sm-12">

<?php
} else {
?>

    <div class="row headerbgline">
        <div class="col-sm-12 col-lg-5 fix_navbar-brand">
            <a href="/profile/contacts"><div style="float: left; margin: 5px 10px 0 -10px; height: 55px; width: 55px; background: url('<?=$avatar?>') no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" class="avadiv"></div></a>


            <a href="/cash/deposit">
            <div class="btn btn-success" title="Основной баланс" style="float: left; margin: 12px 5px 0 5px; font-size: 12px;">Основной баланс
             <span class="badge badge-light" style="font-size: 10px;"><i class="fa fa-rub"></i></span> <?=$user_data['money_rur']; ?>
            </div>
            </a> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
           <a href="/cash/transactions">
            <div class="btn btn-success" title="Резервный баланс" style="float: left; margin: 12px 5px 0 5px; font-size: 12px;">Резервный баланс
               <span class="badge badge-light" style="font-size: 10px;"><i class="fa fa-rub"></i></span> <?=$user_data['reserve_rur']; ?>
            </div>
            </a>

        </div>
             <div class="col-sm-12 col-lg-3 center">
            <a href="/" class="navbar-brand" style="margin-top: -30px;"><img src="/images/logo2.gif"></a>
        </div>
        <div class="col-sm-12 col-lg-4" style="padding-top: 20px; padding-right: 30px; text-align: right;">
            <span class="lgn" style="color: #7ae2a2; font-size: 14px; margin-right: 30px;"><?=$user_data['login']; ?></span> <a href="/logout" class="link">Выйти <i class="fa fa-sign-out"></i></a>
        </div>
    </div>

<?php
}
?>

