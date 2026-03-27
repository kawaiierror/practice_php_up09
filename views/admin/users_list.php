<?php
?>
<h2>Список пользователей</h2>

<table border="1" class="users_list_table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
        <th>Адрес</th>
        <th>Телефон</th>
        <th>Логин</th>
        <th>Роль</th>
        <th>Сменить роль</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->name ?></td>
            <td><?= $user->lastname ?></td>
            <td><?= $user->patronym ?></td>
            <td><?= $user->adress ?></td>
            <td><?= $user->phone ?></td>
            <td><?= $user->login ?></td>
            <td><?= $user->role ?></td>
            <td>
                <form action="<?= app()->route->getUrl('/update_role') ?>" method="POST" class="form_update">
                    <input type="hidden" name="user_id" value="<?= $user->id ?>">

                    <select name="role">
                        <option value="библиотекарь" <?= $user->role == 'библиотекарь' ? 'selected' : '' ?>>библиотекарь</option>
                        <option value="читатель" <?= $user->role == 'читатель' ? 'selected' : '' ?>>читатель</option>
                    </select>

                    <button class="change_role_button" type="submit">Ок</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>