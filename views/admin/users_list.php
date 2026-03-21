<?php
?>
<h2>Список пользователей</h2>

<table border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>фамилия</th>
        <th>отчество</th>
        <th>адрес</th>
        <th>телефон</th>
        <th>адрес</th>
        <th>логин</th>
        <th>роль</th>
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
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>