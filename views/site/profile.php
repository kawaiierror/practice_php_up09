<h2>Профиль</h2>
<h3 class="profile_field">Логин: <?= app()->auth::user()->login ?></h3>
<h3 class="profile_field">Имя: <?= app()->auth::user()->name ?></h3>
<h3 class="profile_field">Фамилия: <?= app()->auth::user()->lastname ?></h3>
<h3 class="profile_field">Очество: <?= app()->auth::user()->name ?></h3>
<h3 class="profile_field">Адрес: <?= app()->auth::user()->adress ?></h3>
<h3 class="profile_field">Телефон: <?= app()->auth::user()->phone ?></h3>
<h3 class="profile_field">Роль: <?= app()->auth::user()->role ?></h3>
