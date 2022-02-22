<?php
if (isset($_SESSION["uid"])) {
?>



<div class="row center">
        <div class="col-sm-12">

        </div>
    </div>

<div class="row" style="text-align: left; margin-bottom: 200px;">
    <div class="col-sm-12">
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul id="menu_social">


                    <li><a href="/"><span class="sidebar-nav-item-icon fa fa-home"></span><span class="sidebar-nav-item-icon"></span>Главная</a></li>

                    <li class="sub">
                        <a href="profile">
                            <span class="sidebar-nav-item-icon fa fa-user-o"></span><span class="sidebar-nav-item">Профиль</span>
                        </a>
                        <ul>
                            <li><a href="/profile/contacts"><span class="sidebar-nav-item-icon fa fa-id-card-o"></span>Контактные данные</a></li>

                            <li><a href="/profile/pass"><span class="sidebar-nav-item-icon fa fa-key"></span>Смена пароля</a></li>
                        </ul>
                    </li>

                    <li class="sub">
                        <a href="cash">
                            <span class="sidebar-nav-item-icon fa fa-money"></span><span class="sidebar-nav-item">Финансы</span>
                        </a>
                        <ul>
                            <li><a href="/cash/deposit"><span class="sidebar-nav-item-icon fa fa-arrow-circle-down"></span>Пополнение счета</a></li>
                            <li><a href="/cash/withdrawal"><span class="sidebar-nav-item-icon fa fa-arrow-circle-up"></span>Вывод средств</a></li>
                            <li><a href="/cash/transactions"><span class="sidebar-nav-item-icon fa fa-list"></span>Транзакции</a></li>
                        </ul>
                    </li>

                    <li class="sub">
                        <a href="orders">
                            <span class="sidebar-nav-item-icon fa fa-th-list"></span><span class="sidebar-nav-item">Платформы</span>
                        </a>
                        <ul>
                            <li><a href="/orders/rub"><span class="sidebar-nav-item-icon fa fa-rub"></span>GOLD</a></li>

                        </ul>
                    </li>

                    <li class="sub">
                        <a href="myorders">
                            <span class="sidebar-nav-item-icon fa fa-th-large"></span><span class="sidebar-nav-item">Мои платформы</span>
                        </a>
                        <ul>
                            <li><a href="/myorders/rub"><span class="sidebar-nav-item-icon fa fa-rub"></span>GOLD</a></li>

                        </ul>
                    </li>

                    <li class="sub">
                        <a href="partners">
                            <span class="sidebar-nav-item-icon fa fa-users"></span><span class="sidebar-nav-item">Партнеры</span>
                        </a>
                        <ul>

                            <li><a href="/partners/my"><span class="sidebar-nav-item-icon fa fa-users"></span>Мои партнеры</a></li>
                            <li><a href="/partners/tools"><span class="sidebar-nav-item-icon fa fa-picture-o"></span>Рекламные материалы</a></li>
                        </ul>
                    </li>

                    <li class="sub">
                        <a href="info">
                            <span class="sidebar-nav-item-icon fa fa-info-circle"></span><span class="sidebar-nav-item">Информация</span>
                        </a>
                        <ul>
                            <li><a href="/news"><span class="sidebar-nav-item-icon fa fa-comment"></span>Новости</a></li>
                            <li><a href="/support"><span class="sidebar-nav-item-icon fa fa-graduation-cap"></span>Контакты</a></li>
                            <li><a href="/marketing"><span class="sidebar-nav-item-icon fa fa-comments-o"></span>Маркетинг</a></li>
                        </ul>
                    </li>


                </ul>
            </nav>
        </aside>
    </div>
</div>

<?php
} else {


}
?>