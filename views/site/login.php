<h2>Авторизация</h2>
<h3 class="message_errors"><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

        <label>Введите логин <input type="text" name="login" placeholder="логин"></label>
        <label>Введите пароль <input type="password" name="password" placeholder="пароль"></label>
        <button class="user_button">Войти</button>
    </form>
<?php endif;