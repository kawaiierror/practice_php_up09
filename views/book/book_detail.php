<h1><?= $book->book_name ?></h1>

<div class="book-details">
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
        <h3>Аннотация</h3>
        <p><?= $book->annotation ?></p>
    </div>

    <br>
    <a href="<?= app()->route->getUrl('/book_list') ?>">Назад в каталог</a>
    <?php if (app()->auth::user()->role === 'администратор' || app()->auth::user()->role === 'библиотекарь'):?>
        <a class="delete_btn" href="<?= app()->route->getUrl('/delete_book') ?>?id=<?= $book->isbn ?>">Удалить книгу</a>
    <?php endif; ?>
</div>