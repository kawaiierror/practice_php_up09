<h2>Регистрация нового пользователя</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
    <label>Введите имя <input type="text" name="name" placeholder="имя"></label>
    <label>Введите логин <input type="text" name="login" placeholder="логин"></label>
    <label>Введите фамилию <input type="text" name="lastname" placeholder="фамилия"></label>
    <label>Введите отчество <input type="text" name="patronym" placeholder="отчество"></label>
    <label>Введите адрес <input type="text" name="adress" placeholder="город, улица, дом, квартира"></label>
    <label>Введите номер телефона <input type="text" name="phone" placeholder="+7 (000) 000 00 00"></label>
    <label for="role">Выберите роль</label>
    <select name="role" id="role">
        <option>читатель</option>
        <option>библиотекарь</option>
        <option>администратор</option>
    </select>
    <label>Введите пароль <input type="password" name="password" placeholder="пароль"></label>
    <button class="user_button">Зарегистрироваться</button>
</form>