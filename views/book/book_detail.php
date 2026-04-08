

<div class="book_details">
    <h1 class="book_details_title"><?= $book->book_name ?></h1>
    <?php if ($book->image): ?>
        <img class="book_detail_img" src="/practice_php_up09/public<?= $book->image ?>" alt="<?= $book->book_name ?>" width="450">

    <?php else: ?>
        <!--                <img src="/path/to/no-image.png" alt="Нет фото" width="150">-->
        <p>нет фото</p>
    <?php endif; ?>
    <p><strong>Автор:</strong>
        <?= $book->author->name ?? '' ?> <?= $book->author->lastname ?? 'Не указан' ?>
    </p>

    <p><strong>Категория:</strong>
        <?= $book->category->name ?? 'Без категории' ?>
    </p>

    <p><strong>Год издания:</strong>
        <?= $book->year ?>
    </p>

    <p><strong>Цена:</strong>
        <?= $book->price ?> руб.
    </p>

    <p><strong>Статус:</strong>
        <?= $book->status ?>
    </p>

    <div class="annotation">
        <h3>Аннотация:</h3>
        <p><?= $book->annotation ?></p>
    </div>

    <div class="book_info">
        <p><strong>Об авторе</strong></p>
        <p>Имя:
            <?= $book->author->name ?? '' ?>
        </p>
        <p>Фамилия:
            <?= $book->author->lastnamename ?? '' ?>
        </p>
        <p>Год рождения:
            <?= $book->author->year_of_birth ?? '' ?>
        </p>
        <?php if ($book->author->year_of_death): ?>
            <p>Год смерти:<?= $book->author->year_of_death ?></p>
        <?php endif; ?>
    </div>


<!--    --><?php //if (app()->auth::user()->role === 'читатель'):?>
    <a class="book_btn" href="<?= app()->route->getUrl('/create_loan') ?>?isbn=<?= $book->isbn ?>">
        Забронировать
    </a>
<!--    --><?php //endif; ?>
    <?php if (app()->auth::user()->role === 'администратор' || app()->auth::user()->role === 'библиотекарь'):?>
        <a class="book_btn delete" href="<?= app()->route->getUrl('/delete_book') ?>?id=<?= $book->isbn ?>">Удалить книгу</a>
    <?php endif; ?>
    <br>
    <a href="<?= app()->route->getUrl('/book_list') ?>">Назад в каталог</a>
</div>