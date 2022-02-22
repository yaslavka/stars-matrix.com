<?php
# Блокировка сессии
if ($auth_check == false) {
Header("Location: /");
return;
}

?>


<div class="content_block">
    <div class="text_title">
        <h1><font color="ffffff">Ошибка при оплате</font> </h1>
    </div>
    <hr class="hr_green">
    Ошибка.

</div>
