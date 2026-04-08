<?php
?>
<h2>Добавление категории</h2>
<form action="<?= app()->route->getUrl('/add_category') ?>" method="POST">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label style="font-size: 14pt ; margin-top: 15px;" for="name"><strong>Название категории:</strong></label>
    <input type="text" name="name" id="name" required placeholder="Например: Фантастика">

    <button style="margin: 7px 5px 7px 5px;     padding: 5px 50px 5px 50px;" type="submit">Добавить категорию</button>
</form>
