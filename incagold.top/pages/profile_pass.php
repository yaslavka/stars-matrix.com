
<div class="content_block">
    <div class="text_title"><span class="fa fa-lock"></span> Смена пароля</div>
    <hr class="hr_green">

    <form method="POST" id="edit_pass">
        <input type="hidden" name="edit" value="pass">
        <input type="hidden" name="uid" value="<?=$_SESSION['uid']; ?>">

        <div style="width: 300px; margin: 0 auto">
            <div style="width: 100%; margin-bottom: 10px">
                <label>Старый пароль</label>
                <input type="password" name="old_pass" maxlength="25" class="input_page" value="">
            </div>
            <div style="width: 100%; margin-bottom: 10px">
                <label>Новый пароль</label>
                <input type="password" name="new_pass" maxlength="25" class="input_page" value="">
            </div>
            <div style="width: 100%; margin-bottom: 10px">
                <label>Повторите новый пароль</label>
                <input type="password" name="new_repass" maxlength="25" class="input_page" value="">
            </div>
            <div style="text-align: center; padding: 15px 0px">
                <button type="submit" class="btn btn-success" style="width: 100%">Сохранить изменения</button>
            </div>
        </div>
    </form>
</div>