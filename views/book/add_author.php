<?php
?>
<?php
?>
<h2>Добавление автора</h2>
<form action="<?= app()->route->getUrl('/add_author') ?>" method="POST">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label style="font-size: 14pt ; margin-top: 15px;" for="name"><strong>Имя:</strong></label>
    <input type="text" name="name" required placeholder="Иван">
    <label style="font-size: 14pt ; margin-top: 15px;" for="lastname"><strong>Фамилия:</strong></label>
    <input type="text" name="lastname" required placeholder="Иванов">
    <label style="font-size: 14pt ; margin-top: 15px;" for="year_of_birth"><strong>Год рождения:</strong></label>
    <input type="number" name="year_of_birth" required>
    <label style="font-size: 14pt ; margin-top: 15px;" for="year_of_death"><strong>Год смерти:</strong></label>
    <input type="number" name="year_of_death" placeholder="При наличии">

    <button style="margin: 7px 5px 7px 5px;     padding: 5px 50px 5px 50px;" type="submit">Добавить автора</button>
</form>

