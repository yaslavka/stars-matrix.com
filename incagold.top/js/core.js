/* Авторизация */
$(document).ready(function(){
    $(document).on('submit', '#auth', function() {
        showPreloader();
        var data = $(this).serialize();
        
        $.ajax({
            url: "/ajax/auth.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: (function() {
                return function(data) {
                    if (data.status === 'success') {
                        $('.errorLogin').css('display', 'none');
                        $('.successLogin').css('display', '');
                        $('#successLogin').html('Авторизация...');
                        
                        if (data.remember === 'on') {
                            $.cookie('user_hash', data.user_hash, {
                                expires: 30,
                                path: '/'
                            });
                        } else {
                             $.cookie('user_hash', data.user_hash, {
                                expires: 1,
                                path: '/'
                            });
                        }

                        setTimeout(function() {
                            window.location = '/';
                            hidePreloader(); 
                        },1000);
                    } else {
                        $('.errorLogin').css('display', '');
                        if (data.err_pass === 'err_pass') {
                            $('#errorLogin').html('Пароль введен неверно!');
                            hidePreloader(); 
                        }
                        if (data.err_login === 'err_login') {
                            $('#errorLogin').html('Логин введен неверно!');
                            hidePreloader(); 
                        }
                        if (data.err_ban === 'err_ban') {
                            $('#errorLogin').html('Аккаунт заблокирован!');
                            hidePreloader(); 
                        }
                    }
                    
                };
            })()
        });
        return false;
    });
});


$(document).ready(function() { 

    $('#reg .input_reg').focus(function() {
        $(this).removeClass('input_reg_err').addClass('input_reg');
    });
    $('.cmfall').click(function() {
        $(this).removeClass('input_reg_err').addClass('input_reg');
    });

    /*
    $('#reg [type=submit]').attr("disabled", true);
    
    $('#rules_cb').click(function() {
        $('#reg [type=submit]').attr("disabled", !($('#rules_cb').is(":checked")));
    });
    */
    
});

$(document).ready(function(){
    $(document).on('submit', '#reg', function() {
        showPreloader();
        $.post("/ajax/ajax_reg.php", $("#reg").serialize()).done(function(data) {
            $('#reg input').parent().parent().removeClass('error');
            var v = JSON.parse(data);
            if (v.responce == 'ok') {
                $('.btn_reg').css('display', 'none');
                $('.form_reg input').attr('readonly', true);
                $('.cmfall').css('display', 'none');
                $('.errorArea').css('display', 'none');
                $('.successArea').css('display', '');
                //$('#success').html('Поздравляем с регистрацией. Подтвердите регистрацию по почте');
                $('#success').html('Поздравляем с регистрацией. <a href="/" style="color: #ff0000;">Продолжить!</a>');
                if($.cookie("user_hash") == null) {
                    $.cookie('user_hash', 'firstenter', { expires: 1, path: '/' });
                }
            } else {
                $('#reg [type=submit]').removeAttr("disabled");
                $.each(v.responce, function(key, value) {
                    $('.errorArea').css('display', '');
                    if (value == 'nodata') {
                        $('#status').html('Необходимо заполнить обязательные поля!');
                        $('#reg input[name=login]').removeClass('input_reg').addClass('input_reg_err');
                        $('#reg input[name=email]').removeClass('input_reg').addClass('input_reg_err');
                        $('#reg input[name=password]').removeClass('input_reg').addClass('input_reg_err');
                    }
                    if (value == 'login_false') {
                        $('#status').html('Логин должен содержать от 4 до 15 букв и/или цифр английского алфавита!');
                        $('#reg input[name=login]').removeClass('input_reg').addClass('input_reg_err');
                    }
                    if (value == 'login_base') {
                        $('#status').html('Такой логин уже зарегистрирован!');
                        $('#reg input[name=login]').removeClass('input_reg').addClass('input_reg_err');
                    }
                    if (value == 'email_false') {
                        $('#status').html('E-mail имеет неверный формат!');
                        $('#reg input[name=email]').removeClass('input_reg').addClass('input_reg_err');
                    }
                    if (value == 'email_rows') {
                        $('#status').html('Такой e-mail уже зарегистрирован!');
                        $('#reg input[name=email]').removeClass('input_reg').addClass('input_reg_err');
                    }
                    if (value=='pass_false') {
                        $('#status').html('Пароль должен содержать от 6 до 25 букв и цифр английского алфавита!');
                        $('#reg input[name=password]').removeClass('input_reg').addClass('input_reg_err');
                    }
                    if (value=='confirmall_false') {
                        $('#status').html('Подтвердите соглашения');
                        $('.cmfall').removeClass('input_reg').addClass('input_reg_err');
                    }
                });
            }
            hidePreloader(); 
        });
        return false;
    });
});


$(document).ready(function(){
    $(document).on('submit', '#edit_acc', function() {
        showPreloader();
        var data = $(this).serialize();

        $.ajax({
            url: "/ajax/ajax_edit_profile.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: (function() {
                return function(data) {
                    if (data.status === 'success') {
                        $('#edit_acc [type=submit]').attr("disabled", true);
                        setTimeout(function() {
                            $('#edit_acc [type=submit]').removeAttr("disabled");
                        },5000);
                    }
                    noty({
                        layout: 'topRight',
			theme: 'defaultTheme',
			type: data.status,
			text: data.message,
			dismissQueue: true,
			force: true,
			timeout: 3000,
			maxVisible: 8,
			killer: false
                    });
                };
            })()
        });
        hidePreloader(); 
        return false;
    });
});


$(document).ready(function(){
    $(document).on('submit', '#edit_delivery', function() {
        showPreloader();
        var data = $(this).serialize();

        $.ajax({
            url: "/ajax/ajax_edit_profile.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: (function() {
                return function(data) {
                    if (data.status === 'success') {
                        $('#edit_delivery [type=submit]').attr("disabled", true);
                        setTimeout(function() {
                            $('#edit_delivery [type=submit]').removeAttr("disabled");
                        },5000);
                    }
                    noty({
                        layout: 'topRight',
			theme: 'defaultTheme',
			type: data.status,
			text: data.message,
			dismissQueue: true,
			force: true,
			timeout: 3000,
			maxVisible: 8,
			killer: false
                    });
                };
            })()
        });
        hidePreloader();
        return false;
    });
});

$(document).ready(function(){
    $(document).on('submit', '#edit_pass', function() {
        showPreloader();
        var data = $(this).serialize();
        
        $.ajax({
            url: "/ajax/ajax_edit_profile.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: (function() {
                return function(data) {
                    if (data.status === 'success') {
                        $('#edit_pass [type=submit]').attr("disabled", true);
                        setTimeout(function() {
                            $('#edit_pass [type=submit]').removeAttr("disabled");
                        },5000);
                    }
                    noty({
                        layout: 'topRight',
			theme: 'defaultTheme',
			type: data.status,
			text: data.message,
			dismissQueue: true,
			force: true,
			timeout: 3000,
			maxVisible: 8,
			killer: false
                    });
                };
            })()
        });
        hidePreloader(); 
        return false;
    });
});


$(document).ready(function(){
    $(document).on('submit', '#convert_money', function() {
        showPreloader();
        var data = $(this).serialize();

        $.ajax({
            url: "/ajax/ajax_convert_money.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: (function() {
                return function(data) {
                    if (data.status === 'success') {
                        $('#convert_money [type=submit]').attr("disabled", true);
                        setTimeout(function() {
                            $('#convert_money [type=submit]').removeAttr("disabled");
                            window.location = '/withdrawal';
                        },5000);
                    }
                    noty({
                        layout: 'topRight',
                        theme: 'defaultTheme',
                        type: data.status,
                        text: data.message,
                        dismissQueue: true,
                        force: true,
                        timeout: 4500,
                        maxVisible: 8,
                        killer: false
                    });
                };
            })()
        });
        hidePreloader();
        return false;
    });
});


$(document).ready(function(){
    $(document).on('submit', '#withdrawal_money', function() {
        showPreloader();
        var data = $(this).serialize();

        $.ajax({
            url: "/ajax/ajax_convert_money.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: (function() {
                return function(data) {
                    if (data.status === 'success') {
                        $('#withdrawal_money [type=submit]').attr("disabled", true);
                        setTimeout(function() {
                            $('#withdrawal_money [type=submit]').removeAttr("disabled");
                            window.location = '/cash/withdrawal';
                        },5000);
                    }
                    noty({
                        layout: 'topRight',
                        theme: 'defaultTheme',
                        type: data.status,
                        text: data.message,
                        dismissQueue: true,
                        force: true,
                        timeout: 4500,
                        maxVisible: 8,
                        killer: false
                    });
                };
            })()
        });
        hidePreloader();
        return false;
    });
});

$(document).ready(function(){
    $(document).on('submit', '#send_money', function() {
        showPreloader();
        var data = $(this).serialize();

        $.ajax({
            url: "/ajax/ajax_convert_money.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: (function() {
                return function(data) {
                    if (data.status === 'success') {
                        $('#send_money [type=submit]').attr("disabled", true);
                        setTimeout(function() {
                            $('#send_money [type=submit]').removeAttr("disabled");
                            window.location = '/cash/send';
                        },5000);
                    }
                    noty({
                        layout: 'topRight',
                        theme: 'defaultTheme',
                        type: data.status,
                        text: data.message,
                        dismissQueue: true,
                        force: true,
                        timeout: 4500,
                        maxVisible: 8,
                        killer: false
                    });
                };
            })()
        });
        hidePreloader();
        return false;
    });
});

$(document).ready(function(){
    $(document).on('submit', '#gifts_buy', function() {
        showPreloader();
        var data = $(this).serialize();

        $.ajax({
            url: "/ajax/ajax_gifts.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: (function() {
                return function(data) {
                    if (data.status === 'success') {
                        $('#gifts_buy [type=submit]').attr("disabled", true);
                        setTimeout(function() {
                            $('#gifts_buy [type=submit]').removeAttr("disabled");
                            window.location = '/gifts';
                        },5000);
                    }
                    noty({
                        layout: 'topRight',
                        theme: 'defaultTheme',
                        type: data.status,
                        text: data.message,
                        dismissQueue: true,
                        force: true,
                        timeout: 4500,
                        maxVisible: 8,
                        killer: false
                    });
                };
            })()
        });
        hidePreloader();
        return false;
    });
});


function showTaskLoader() {
    $('#ajax_task').fadeIn(200);
}

function hideTaskLoader() {
    $('#ajax_task').fadeOut(200);
}


function showPreloader() {
    $('#Ajax').fadeIn(200);
}

function hidePreloader() {
    $('#Ajax').fadeOut(200);
}

function GenRand() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i=0; i < 10; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
}



$(function() {
    function maskPhone() {
        var country = $('#country option:selected').val();
        switch (country) {
            case "ru": $("#phone").mask("+7(999) 999-99-99"); break;
            case "ua": $("#phone").mask("+380(99) 999-99-99"); break;
            case "by": $("#phone").mask("+375(999) 999-99-99"); break;
        }
    }
    maskPhone(); $('#country').change(function() { maskPhone(); });
});



