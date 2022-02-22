<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$title;?> | CAEC LTD</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Oswald:300,400" rel="stylesheet">
<!-- font-family: 'Montserrat', sans-serif;
	font-family: 'Oswald', sans-serif; -->
<link href='/styles/bootstrap.min.css' rel='stylesheet' type='text/css'>
<link href='/styles/animate.css' rel='stylesheet' type='text/css'>
<link href='/styles/custom.css' rel='stylesheet' type='text/css'>
<link href='/styles/tab.css' rel='stylesheet' type='text/css'>

<link rel="icon" href="/favicon.ico">
<script src='/styles/jquery.js' type='text/javascript'></script>
<script src="/styles/wow.js"></script>
<script src="/styles/wow.min.js"></script>
<script type="text/javascript" src="/styles/bootstrap.min.js"></script>
<script src='/styles/setting2.js' type='text/javascript'></script>
<script src='/styles/tab.js' type='text/javascript'></script>
<link rel="stylesheet" type="text/css" href="/css/font-awesome.css" />
<meta name="keywords" content="CAEC LTD, CRYPTO ARBITRAGE EDUCATION CLUB LTD, caec7-ltd.com, caec7, caec, инвестиции, инвестиционная платформа"/>
<meta name="description" content="Добро пожаловать в международную компанию CRYPTO ARBITRAGE EDUCATION CLUB LTD"/>
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
        <!-- //header -->     
    <?php
    $base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$referer_id."' LIMIT 1");
    $user_data = $base->FetchArray();
    if ($user_data['avatar'] != null) {
        $avatar = $user_data['avatar'];
    } else {
        $avatar = '/img/noavatar.png';
    }
    ?>
 <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
 <br /> <b>
    <div class="col-sm-12 col-lg-3"></div>
    <div class="col-sm-12 col-lg-6" style="padding: 0px;">

        <form class="form_reg" id="reg">
            <div class="form_group">
                <label class="form_label">ЛОГИН</label>
                <input type='text' style='display: none'>
                <input name="login" type="text" class="reg_input" autocomplete="off" value=""> <?php /*auto<?=rand(1000,99999);?>*/?>
            </div>
            <div class="form_group">
                <label class="form_label">E-MAIL</label>
                <input type='text' style='display: none'>
                <input name="email" type="text" class="reg_input" autocomplete="off" value="">
            </div>
            <div class="form_group">
                <label class="form_label">ПАРОЛЬ</label>
                <input type='password' style='display: none'>
                <input name="password" type="password" class="reg_input" autocomplete="off" value="">
            </div>
            <div class="form_group cmfall">
                <input type="checkbox" id="exampleCheck1" name="confirmall"> <span class="regspan">С <a href="/rules" target="_blank">ПРАВИЛАМИ</a> ОЗНАКОМЛЕН</span>
            </div>
            
          <input type="hidden" name="auth" value="1">
                <input type="submit" class="btn_reg" value="ЗАРЕГИСТРИРОВАТЬСЯ">   
            
        </form>
        

        
        <div id="status" class="errorArea" style="display: none;"></div>
        <div id="success" class="successArea" style="display: none;"></div>


 <div class="col-sm-12 col-lg-3">
        <?php
            $base->Query("SELECT `login`, `avatar`, `firstname`, `lastname`, `skype`, `vk`, `phone` FROM `".$pr."_users` WHERE `login` = '".$referer_login."'");
            if ($base->NumRows() > 0) {
            $d_rerr = $base->FetchArray();
            ?>
            <table class="table table-bordered acc-s-user" style="width: 100%; background: #fff; font-size: 14px;">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"><i class="fa fa-user-circle"></i> ВАШ НАСТАВНИК</th>

                </tr>
                </thead>
                <tbody class="table-sm">
                <tr> <td>
                        <div class="avatar" style="margin: 17px;">
                            <div style="background: url('<?=$d_rerr["avatar"]?>') no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" class="avadiv"></div>
                        </div>
                    </td> </tr>
                <tr> <td><?=$d_rerr["login"]?></td> </tr>
                <tr> <td><?=$d_rerr["lastname"]?> <?=$d_rerr["firstname"]?></td> </tr>
                <?php if ($d_rerr["skype"] != "") { ?><tr> <td>скайп: <?=$d_rerr["skype"]?></td> </tr> <?php } ?>
                <tr> <td><a href="<?=$d_rerr["vk"]?>" target="_blank"><?=$d_rerr["vk"]?></td> </tr>
                <tr> <td><?=$d_rerr["phone"]?></td> </tr>
                </tbody>
            </table>
            <?php
        }
        ?>
    </div>
</div>
</div></div></div></div>

    </div> 
    </div>

<br /> <br />    <center>        
<div id="linkslot_261435"><script src="https://linkslot.ru/bancode.php?id=261435" async></script></div>
</p>
<iframe data-aa="1241703" src="//ad.a-ads.com/1241703?size=468x60" scrolling="no" style="width:468px; height:60px; border:0px; padding:0; overflow:hidden" allowtransparency="true"></iframe>
 </center> <br /> <br /> <br />   


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