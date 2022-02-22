<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ИМЯ САЙТА - Идеальный алгоритм заработка, не имеющий аналогов!</title>
        
        <meta name="keywords" content="заработок в интернет, инвестиции, без вложений, хайп, лучший заработок 2019, где заработать, начни зарабатывать, заработай легко, 1 9 90, бизнес с нуля, бизнес предложения, прибыль, как зарабатывать деньги, матрицы, заработок в ютюбе, лёгкий заработок, где заработать без вложений, заработок в мобильном приложении, сайт платит, заплатить, начни зарабатывать, честный заработок, заработок на буксах, халява">
        <meta name="description" content="Впервые! Полностью автоматизированная система растущего заработка без приглашений!">
 <link rel="stylesheet" href="/staile/style.css" type="text/css" media="all" />

</head>
<body>
    
   <div class="wrapper">
  <div class="headerTopContainer">
    <div class="headerTopInner zoomIn wow">
	  


      </div>   
    
   <div class="hdTop-row3">  
   
	<a class="signup" href="/registration"><i class="fa fa-user-plus"></i> Регистрация</a>
	<a class="login" href="/auth"><i class="fa fa-sign-in"></i> Вход</a>

 </div>  
    

     <nav class="navbar navbar-expand-lg navbar-light">
  <div class="headerInner fadeInLeft wow"><a href="/"><img style="width: 220px;height: 40px;" src="/styles/images/logo.gif"></img></a>
       
 
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="hdTop-row3">           <br /><br />
                        <ul class="navbar-nav ml-4 m-auto">
                            <li class="nav-item active">
                                <a class="signup dropdown-toggle" href="/">Главная </a>
                            </li>

                            
       <li class="nav-item active">
                                <a class="signup dropdown-toggle" href="/rules"> Правила </a>
                            </li>    

       <li class="nav-item active">
                                <a class="signup dropdown-toggle" href="/marketing"> Маркетинг </a>
                            </li>                          

                            <li class="nav-item">
                                <a class="signup" href="/support">Контакты</a>
                            </li>
                        </ul>

     </div>
                </nav>
            </div>
        </header>
        <!-- //header -->    <font color="ffffff"><b> 
<?php
if (isset($_GET['code'])) {
    $login = $func->isMail($_GET['login']);
    $key = $func->getUrl($_GET['key']);
    $code = $func->getUrl($_GET['code']);

    if ($login !== false) {
        $base->Query("SELECT `id`, `login`, `password`, `email`, `code_recovery` FROM `".$pr."_users` WHERE `email` = '".$base->Real($login)."'");
        if ($base->NumRows() == 1) {
            $data_recovery = $base->FetchArray();
            if ($key !== false) {
                if ($code !== false) {
                    $key_base = $func->md5Recovery($data_recovery['code_recovery']);
                    if ($key_base == $key && $data_recovery['code_recovery'] == $code) {
                            
                        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
                        $numChars = strlen($chars);
                        $password = '';
                        for ($i = 0; $i < 8; $i++) {
                          $password .= substr($chars, rand(1, $numChars) - 1, 1);
                        }
                        $pass = $func->md5Pass($password);
                        $base->Query("UPDATE `".$pr."_users` SET `password` = '".$base->Real($pass)."' WHERE `email` = '".$base->Real($login)."'");

                        $mail->RecoverySucces($login, $password);
                        $base->Query("UPDATE `".$pr."_users` SET `code_recovery` = '0' WHERE `email` = '".$base->Real($login)."'");
                        echo '<div class="alert alert-success" role="alert">Новый пароль отправлен на ваш <b>E-mail</b>. Письмо может идти с задержкой до <b>5 минут</b>. Не забудьте проверить папку <b>СПАМ</b>.</div>';
                       
                    } else echo '<div class="alert alert-danger" role="alert">Ошибка! Данная ссылка устарела, либо вы не запрашивали восстановление пароля.</div>';
                } else echo '<div class="alert alert-danger" role="alert">Ошибка! Неверный код восстановления.</div>';
            } else echo '<div class="alert alert-danger" role="alert">Ошибка! Неверный ключ восстановления.</div>';
        } else echo '<div class="alert alert-danger" role="alert">Ошибка! Пользователя м таким E-mail не зарегистрированно в системе.</div>';
    } else echo '<div class="alert alert-danger" role="alert">Ошибка! Введеный E-mail имеет неверный формат.</div>';

    return;
}
?>



<div class="row" style="margin-top: 50px">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">


        <div class="block_recovery">
            <h1>Восстановление пароля</h1>
<br><font color="ffffff"><b>
            Введите ваш E-mail и нажмите кнопку "Восстановить". На вашу почту будет отправлена ссылка для подтверждения сброса
            пароля, после перехода по которой вам будет отправлен новый пароль.<br><br>
</b></font> 
            <form class="form_reg" id="recovery">
                <div class="form_group">
                    <label class="form_label">E-mail</label>
                    <input name="email" type="text"  class="reg_input">
                </div>
                <div class="form_group">
                    <p style="text-align: center"><button type="submit" class="btn_login">Восстановить</button></p>
                </div>
            </form>
        </div>
        <div id="status" class="errorArea" style="display: none"></div>
        <div id="success" class="successArea" style="display: none"></div>

    </div>
    <div class="col-sm-2"></div>
</div>






<script>
    $(document).ready(function(){
        $(document).on('submit', '#recovery', function() {
            showPreloader();
            var data = $(this).serialize();
        
            $.ajax({
                url: "/ajax/ajax_recovery.php",
                type: "POST",
                dataType: "json",
                data: data,
                success: (function() {
                    return function(data) {
                        if (data.status === 'success') {
                            $('.errorArea').css('display', 'none');
                            $('.successArea').css('display', '');
                            $('#success').html(data.message);
                            $('#recovery [type=submit]').attr("disabled", true);
                        } else {
                            $('.errorArea').css('display', '');
                            $('#status').html(data.message);
                        }
                    };
                })()
            });
            hidePreloader(); 
            return false;
        });
    });
</script>



  <br><br><br><br>
</div></div></div>
</div></div></div>


    <!--footer -->
    <footer>
        <section class="footer footer_1its py-5">
            <div class="container py-md-4">

                <div class="row footer-top mb-md-5 mb-4">
                    <div class="col-lg-4 col-md-6 footer-grid_section_1its" data-aos="fade-right">
                        <div class="footer-title-w3ls">
                            <h3>Контакты 
Для Связи</h3>
                        </div>
                        <div class="footer-text">
                            <p>Техподдержка:<br />
inca.gold@yandex.ru</p>
<p>МЫ В СОЦ. СЕТЕХ:<br />
</p>
                      <ul class="social_section_1info" data-aos="fade-up">
  <li class="mb-2 twitter"><a href="https://vk.com/public186259399"><i class="fa fa-vk mr-1"></i>ВКонтакте</a></li>                          
                        <li class="mb-2 facebook"><a href="#"><i class="fa fa-facebook mr-1"></i>facebook</a></li>
                        <li class="mb-2 twitter"><a href="#"><i class="fa fa-Telegram mr-1"></i>Telegram</a></li>

                    </ul>
  
                        </div>
                    </div>
                    &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
                    &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
                    &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
                    <div class="col-lg-4 col-md-6 mt-md-0 mt-4 footer-grid_section_1its">
                        <div class="footer-title-w3ls">
                            <h3>МЕНЮ</h3>
                        </div>
                        <div class="row">
                      
                            <ul class="col-6 links">
                                <li><a href="/faq">ЧАСТЫЕ ВОПРОСЫ </a></li>
                                <li><a href="/marketing">МАРКЕТИНГ </a></li>
                                <li><a href="/rules">ПРАВИЛА </a></li>
                                <li><a href="/support">КОНТАКТЫ </a></li>
                         
                            </ul>
                        </div>
                    </div>
                <br /><br />    <br /><br />       <br /><br />    <br /><br />       <br /><br />    <br /><br />
                <div class="footer-grid_section text-center">
                    <div class="footer-title-w3ls mb-3" data-aos="fade-up">
                        <a href="/" class="text-uppercase"><i class="fa fa-ravelry" aria-hidden="true"></i> INCA GOLD</a>
                    </div>
                    <div class="footer-text">
                        <p data-aos="fade-up">Регистрируясь в проекте, Вы принимаете все правила участия и соглашения. В случае возникновения каких либо вопросов, Вы можете связаться с нами по контактным данным</p>
                    </div>

                </div>

            </div>
        </section>
    </footer>
    <!-- //footer -->


</body>
</html>