
<div class="content_block ">
    <div class="text_title"><span class="fa fa-handshake-o"></span> Контактные данные</div>
 

    <div class="row center">
        <div class="col-sm-12 col-lg-6">
            <form method="POST" id="edit_acc">
                <input type="hidden" name="edit" value="acc">
                <input type="hidden" name="uid" value="<?=$uid; ?>">

                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Фамилия</span>
                    </div>
                    <input type="text" name="lastname" value="<?=$user_data['lastname']; ?>" class="form-control" placeholder="Фамилия" aria-label="Фамилия" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Имя</span>
                    </div>
                    <input type="text" name="firstname" value="<?=$user_data['firstname']; ?>" class="form-control" placeholder="Имя" aria-label="Имя" aria-describedby="basic-addon2">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Телефон</span>
                    </div>
                    <input type="text" name="phone" value="<?=$user_data['phone']; ?>" class="form-control" placeholder='Телефон со знаком "+"' aria-label="Телефон" aria-describedby="basic-addon3">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon4">Скайп</span>
                    </div>
                    <input type="text" name="skype" value="<?=$user_data['skype']; ?>" class="form-control" placeholder="Скайп" aria-label="Скайп" aria-describedby="basic-addon4">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon5">Вконтакте</span>
                    </div>
                    <input type="text" name="vk" value="<?=$user_data['vk']; ?>" class="form-control" placeholder="Вконтакте" aria-label="Вконтакте" aria-describedby="basic-addon5">
                </div>
                <div class="input-group mb-1">
                    <button type="submit" class="btn btn-success" style="width: 100%">Сохранить изменения</button>
                </div>

            </form>

            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon6">Логин</span>
                </div>
                <input type="text" value="<?=$user_data['login']; ?>" class="form-control" placeholder="Логин" aria-label="Логин" aria-describedby="basic-addon6" disabled>
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon7">Почта</span>
                </div>
                <input type="text" value="<?=$user_data['email']; ?>" class="form-control" placeholder="Почта" aria-label="Почта" aria-describedby="basic-addon7" disabled>
            </div>
        </div>
       
            </div>
        </div>
    </div>




</div>
<br><br>




