
<script type="text/javascript" src="/js/clipboard.min.js"></script>

<div class="content_block">
    <div class="text_title"><span class="fa fa-picture-o"></span> Рекламные материалы</div>
    <hr class="hr_green">


    <label>Ссылка для привлечения партнеров:</label>

    <div class="row mt-4">
        <div class="col-sm-6" style="text-align: right;">
    <input class="input_page" id="input_ref" type="text" style="color: #ffffff; text-align: right; border: 0px; box-shadow: none; background: transparent;" value="https://<?=$_SERVER['HTTP_HOST']; ?>/?r=<?=$user_data['login']?>" readonly>
        </div>
        <div class="col-sm-6" style="text-align: left;">
    <button type="submit" id="btn-clipboard" class="btn btn-success" style="font-size: 12px;" data-clipboard-target="#input_ref">Скопировать ссылку</button>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-sm-6" style="text-align: right;">
            <img src="/img/468x60.gif" width="468" height="60">
        </div>
        <div class="col-sm-6" style="text-align: left;">
            <button type="submit" id="btn-clipboard2" class="btn btn-success" style="font-size: 12px;" data-clipboard-target="#input_ref2">Скопировать код баннера</button>
            <textarea class="input_page" id="input_ref2"  style="color: #ffffff; text-align: left; height: 90px; resize: none; border: 0px; box-shadow: none; background: transparent;" readonly><a href='https://<?=$_SERVER['HTTP_HOST']; ?>/?r=<?=$user_data['login']?>' target='_blank'><img src='https://<?=$_SERVER['HTTP_HOST']; ?>/img/468x60.gif' width='468' height='60'></a> </textarea>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-sm-6" style="text-align: right;">
            <img src="/img/200x300.gif" width="200" height="300">

        </div>
        <div class="col-sm-6" style="text-align: left;">
            <button type="submit" id="btn-clipboard3" class="btn btn-success" style="font-size: 12px;" data-clipboard-target="#input_ref3">Скопировать код баннера</button>
            <textarea class="input_page" id="input_ref3"  style="color: #ffffff; text-align: left; height: 90px; resize: none; border: 0px; box-shadow: none; background: transparent;" readonly><a href='https://<?=$_SERVER['HTTP_HOST']; ?>/?r=<?=$user_data['login']?>' target='_blank'><img src='https://<?=$_SERVER['HTTP_HOST']; ?>/img/200x300.gif' width='200' height='300'></a> </textarea>
        </div>
    </div>




    <div class="row mt-4">
        <div class="col-sm-6" style="text-align: right;">
            <img src="/img/200x200.gif" width="200" height="200">

        </div>
        <div class="col-sm-6" style="text-align: left;">

            <textarea class="input_page" id="input_ref3"  style="color: #ffffff; text-align: left; height: 90px; resize: none; border: 0px; box-shadow: none; background: transparent;" readonly><a href='https://<?=$_SERVER['HTTP_HOST']; ?>/?r=<?=$user_data['login']?>' target='_blank'><img src='https://<?=$_SERVER['HTTP_HOST']; ?>/img/200x200.gif' width='200' height='200'></a> </textarea>
        </div>
    </div>



    <br>
    <br>

    <br>
    <br>




</div>


<script>
    new Clipboard('#btn-clipboard');
    $(document).on('click', '#btn-clipboard', function() {
        alert('Ваша партнерская ссылка скопирована');
    });
    new Clipboard('#btn-clipboard2');
    $(document).on('click', '#btn-clipboard2', function() {
        alert('Код баннера с вашей реф ссылкой скопирован');
    });
    new Clipboard('#btn-clipboard3');
    $(document).on('click', '#btn-clipboard3', function() {
        alert('Код баннера с вашей реф ссылкой скопирован');
    });
    new Clipboard('#btn-clipboard4');
    $(document).on('click', '#btn-clipboard4', function() {
        alert('Код баннера с вашей реф ссылкой скопирован');
    });
</script>