﻿<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ИМЯ САЙТА - Идеальный алгоритм заработка, не имеющий аналогов!</title>
        
        <meta name="keywords" content="заработок в интернет, инвестиции, без вложений, хайп, лучший заработок 2019, где заработать, начни зарабатывать, заработай легко, 1 9 90, бизнес с нуля, бизнес предложения, прибыль, как зарабатывать деньги, матрицы, заработок в ютюбе, лёгкий заработок, где заработать без вложений, заработок в мобильном приложении, сайт платит, заплатить, начни зарабатывать, честный заработок, заработок на буксах, халява">
        <meta name="description" content="Впервые! Полностью автоматизированная система растущего заработка без приглашений!">
 <link rel="stylesheet" href="/staile/style.css" type="text/css" media="all" />

</head>
<body>
    
 <div class="wrapper">
  <div class="headerTopContainer">

    
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
                                <a class="signup" href="/">Главная </a>
                            </li>

                            
       <li class="nav-item active">
                                <a class="signup" href="/rules"> Правила </a>
                            </li>    

       <li class="nav-item active">
                                <a class="signup" href="/marketing"> Маркетинг </a>
                            </li>  

                            <li class="nav-item">
                                <a class="signup" href="/support">Контакты</a>
                            </li>
        
                        </ul>

     </div>
                </nav>
            </div>
        </header>
        <!-- //header --> 
       
       


<h1>Новости</h1>
<?php
$base->Query("SELECT * FROM `".$pr."_news` ORDER BY `id` DESC");
if ($base->NumRows() > 0) {
    while ($news_data = $base->FetchArray()) {
        ?>
        <div class="news_block">
            <div class="news_title"><font color="ffffff"><b><?=$news_data['title']; ?></div>
            <div class="news_message"><?=$news_data['message']; ?></div>
            <div class="news_footer">
                <div style="float: left; font-weight: bold">С уважением, администратор сервиса.</div>
                <div style="float: right; font-weight: bold"><?=$news_data['date']; ?></div>
                <div class="clear"></div>
            </div>
      
        <?php
    }
} else echo '<div class="alert alert-danger" role="alert"><b>Новостей нет!</b></div>';
?>

</b></font>
    <br><br><br><br>
</div></div></div></div></div></div>
  </div>
   <!--footer -->
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