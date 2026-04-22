<h2>Регистрация нового пользователя</h2>
<form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <?php if (isset($errors)): ?>
        <div style=" color: red; margin-bottom: 20px;">
            <ul style="margin: 0;">
                <?php foreach ($errors as $fieldErrors): ?>
                    <?php foreach ($fieldErrors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <label>Введите имя <input type="text" name="name" placeholder="имя"></label>
    <label>Введите логин <input type="text" name="login" placeholder="логин"></label>
    <label>Введите фамилию <input type="text" name="lastname" placeholder="фамилия"></label>
    <label>Введите отчество <input type="text" name="patronym" placeholder="отчество"></label>
    <label>Введите адрес <input type="text" name="adress" placeholder="город, улица, дом, квартира"></label>
    <label>Введите номер телефона <input type="text" name="phone" placeholder="+7 (000) 000 00 00"></label>
    <label>Введите пароль <input type="password" name="password" placeholder="пароль"></label>
    <button class="user_button">Зарегистрироваться</button>
</form>