<h2>Каталог книг</h2>


<?php if (app()->auth::user()->role === 'администратор' || app()->auth::user()->role === 'библиотекарь'):?>
    <a class="book_btn create" href="<?= app()->route->getUrl('/add_book') ?>">Создать книгу</a>
    <br>
    <a class="book_btn create" href="<?= app()->route->getUrl('/add_category') ?>">Создать категорию</a>
    <br>
    <a class="book_btn create" href="<?= app()->route->getUrl('/add_author') ?>">Создать автора</a>
<?php endif; ?>


<div class="book_grid">
    <?php foreach ($books as $book): ?>
        <div class="book-item">

            <?php if ($book->image): ?>
                <img src="<?= app()->route->getUrl('/public') ?><?=$book->image ?>" alt="<?= $book->book_name ?>" width="250">

            <?php else: ?>
                <!--                <img src="/path/to/no-image.png" alt="Нет фото" width="150">-->
                <p>нет фото</p>
            <?php endif; ?>

            <h4><?= $book->book_name ?></h4>
            <p><b>Автор: </b>  <?= $book->author->name ?? '' ?>
                <?= $book->author->lastname ?? 'Неизвестен' ?></p>
            <p><b>Категория: </b> <?= $book->category->name ?? 'Без категории' ?></p>
            <p><b>Цена: </b> <?= $book->price ?> руб.</p>
            <?php if ($book->is_new == 1): ?>
                <span style="color: green; font-weight: bold; text-transform: uppercase; font-size: 0.8em;">
                Новинка!
            </span>
            <?php endif; ?>

            <?php if ($book->status !== 'забронирована'): ?>
                <p>В наличии</p>
            <?php else: ?>
                <p style="color: #dc3545"><strong>Уже занята</strong></p>
            <?php endif; ?>
            <br>

            <a href="<?= app()->route->getUrl('/book_detail') ?>?id=<?= $book->isbn ?>">
                Посмотреть подробнее
            </a>
        </div>
    <?php endforeach; ?>
</div>

<!--INSERT INTO `books`(`isbn`, `book_name`, `author_id`, `year`, `price`, `is_new`, `annotation`, `category_id`, `image`) VALUES (1,'Мастер и Маргарита', 1, 1928, 500, 0,'культовая книга Булгакова', 1,'[value-9]');-->
<!--INSERT INTO `books`(`isbn`, `book_name`, `author_id`, `year`, `price`, `is_new`, `annotation`, `category_id`, `image`) VALUES (2,'Собачье сердце', 1, 1961, 800, 0, 'Острая сатира на большевизм, она была написана в разгар периода НЭПа, когда коммунизм в СССР, на первый взгляд, начал сдавать позиции', 4,'[value-9]');-->
