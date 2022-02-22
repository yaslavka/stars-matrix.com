
<div class="content_block">
    <div class="text_title"><span class="fa fa-rub"></span> Купить платформу</div>
    <hr class="hr_green">


    <?php
    if (isset($_GET["matrixbuy"])) {
        require('functions/payment.php');
        switch ($_GET["matrixbuy"]) {
            case 100: $res = Payment_BuyMatrix(1, "RUB", 100, $_SESSION["uid"], "buy"); break;
            case 300: $res = Payment_BuyMatrix(1, "RUB", 300, $_SESSION["uid"], "buy"); break;
            case 500: $res = Payment_BuyMatrix(1, "RUB", 500, $_SESSION["uid"], "buy"); break;
        }
        switch ($res) {
            case "AlreadyExists": echo "Отмена. Платформа уже была куплена"; break;
            case "SumError": echo "Ошибка. Не достаточно средств на балансе"; break;
            case "ok": echo "Успех! Платформа успешно приобретена!"; break;
        }
        echo "<br><br><a href='/orders/rub' class='btn btn-success'>Назад</a>";
    } else {

    ?>

    <section id="portfolio">
        <div id="portfolio3">
            <div class="row center">
                <div class="col-sm-12 col-md-6">
                    <div class="pricing-table" style="text-align: left;" > <!--background-color: #73ae20;-->
                        <div class="type">
                            <h4>Прибыль 25 300 руб.</h4>
                        </div>
                        <div class="price">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h2><span class="dollar">&#8381;</span>100<br><span class="month"></span></h2>
                                </div>
                                <div class="col-sm-8">
                                    <p><font color="ffffff"><b>Вход 100 рублей.<br>Прибыль 25 300 руб.</b></font></p>
                                </div>
                            </div>
                        </div>
                        <ul class="packages">
                            <li><i class="fa fa-check" aria-hidden="true"></i>Автозаполнение матрицы системой</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i>Плюс личные приглашения для ускорения</li>
                              <li><i class="fa fa-check" aria-hidden="true"></i>Реинвесты. Клоны.</li>
                        </ul>
                        <a class="btn button btn-block" href="/orders/rub/100">Купить сейчас</a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="pricing-table" style="text-align: left">
                        <div class="type">
                            <h4>Прибыль 75 900 руб.</h4>
                        </div>
                        <div class="price">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h2><span class="dollar">&#8381;</span>300<br><span class="month"></span></h2>
                                </div>
                                <div class="col-sm-8">
                                    <p><font color="ffffff"><b>Вход 300 рублей.<br>Прибыль 75 900 руб.</b></font></p>
                                </div>
                            </div>
                        </div>
                        <ul class="packages">
                            <li><i class="fa fa-check" aria-hidden="true"></i>Автозаполнение матрицы системой</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i>Плюс личные приглашения для ускорения</li>
                              <li><i class="fa fa-check" aria-hidden="true"></i>Реинвесты. Клоны.</li>
                        </ul>
                        <a class="btn button btn-block" href="/orders/rub/300">Купить сейчас</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="row center">
                <div class="col-sm-12 col-md-6">
                    <div class="pricing-table" style="text-align: left">
                        <div class="type">
                            <h4>Прибыль 126 500 руб.</h4>
                        </div>
                        <div class="price">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h2><span class="dollar">&#8381;</span>500<br><span class="month"></span></h2>
                                </div>
                                <div class="col-sm-8">
                                    <p><font color="ffffff"><b>Вложение 500 рублей.<br>Прибыль 126 500 руб.</b></font></p>
                                </div>
                            </div>
                        </div>
                        <ul class="packages">
                            <li><i class="fa fa-check" aria-hidden="true"></i>Автозаполнение матрицы системой</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i>Плюс личные приглашения для ускорения</li>
                             <li><i class="fa fa-check" aria-hidden="true"></i>Реинвесты. Клоны.</li>
                        </ul>
                        <a class="btn button btn-block" href="/orders/rub/500">Купить сейчас</a>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
    </section>

    <?php
    }
    ?>

<br><br><br /><br><br><br />

</div>
