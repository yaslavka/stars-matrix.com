<div class="auth_block">
        <form id="auth">
            <div id="errorLogin" class="errorLogin" style="display: none"></div>
            <div id="successLogin" class="successLogin" style="display: none"></div>

            <div class="login_icon"><div id="login"></div></div>
            <input class="login_input" name="login" type="text" id="prependedInput" placeholder="Логин или e-mail">

            <div class="login_icon"><div id="password"></div></div>
            <input class="login_input" name="password" type="password" id="prependedInput" placeholder="Пароль">

            <div class="login_checkbox"><input type="checkbox" id="inlineCheckbox" name="remember"><span>Запомнить</span></div>

            <input type="hidden" name="auth" value="1">
            <input type="submit" class="btn_login" value="Войти">
        </form>
        <div style="padding-top: 8px; padding-right: 18px; float: right"><a class="link" style="font-size: 12px" href="/recovery">Забыли пароль?</a></div>
    </div>