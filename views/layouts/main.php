<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pirvp MVC</title>
<!--   ↓ ВОТ ЭТО ОСТАВЬ ↓-->
    <link rel="stylesheet" href="<?= app()->route->getUrl('/css/main.css') ?>">
<!--    ↑ ВОТ ЭТО ОСТАВЬ ↑-->

<!--    <style>-->
<!--        a {-->
<!--            text-decoration: none;-->
<!--        }-->
<!--    </style>-->
</head>
<body>
<header>
    <nav>
        <a class="header_nav_link" href="<?= app()->route->getUrl('/') ?>">Главная</a>
        <?php
        if (!app()->auth::check()):
            ?>
            <a class="header_nav_link" href="<?= app()->route->getUrl('/login') ?>">Вход</a>
            <a class="header_nav_link" href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
        <?php
        else:
            ?>
            <a class="header_nav_link" href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
            <a class="header_nav_link" href="<?= app()->route->getUrl('/profile') ?>">Профиль</a>

        <?php
        endif;
        ?>
        <?php if (app()->auth->check()): ?>
            <?php if (app()->auth::user()->role === 'администратор'):?>
                <a class="header_nav_link" href="<?= app()->route->getUrl('/users_list') ?>">Управление пользователями</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>