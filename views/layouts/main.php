<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pirvp MVC</title>
    <link rel="stylesheet" href="../../public/css/main.css"">
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

            <a class="header_nav_link" href="<?= app()->route->getUrl('/users_list') ?>">Управление пользователями</a>
        <?php
        endif;
        ?>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>