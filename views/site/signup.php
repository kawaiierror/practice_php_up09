<h2>Регистрация нового пользователя</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
    <label>Введите имя <input type="text" name="name" placeholder="имя"></label>
    <label>Введите логин <input type="text" name="login" placeholder="логин"></label>
    <label>Введите пароль <input type="password" name="password" placeholder="пароль"></label>
    <button>Зарегистрироваться</button>
</form>