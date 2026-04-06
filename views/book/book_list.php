<h2>Каталог книг</h2>

<div class="book-grid">
    <?php foreach ($books as $book): ?>
        <div class="book-item">
            <!-- Используем объектные свойства модели -->
<!--            <img src="--><?php //= $book->image ?><!--" alt="--><?php //= $book->title ?><!--" width="100">-->

            <h4><?= $book->book_name ?></h4>

            <p><b>Автор: </b>  <?= $book->author->name ?? '' ?>
                <?= $book->author->lastname ?? 'Неизвестен' ?></p>
            <p><b>Категория: </b> <?= $book->category->name ?? 'Без категории' ?></p>
            <p><b>Цена: </b> <?= $book->price ?> руб.</p>

            <a href="<?= app()->route->getUrl('/book_detail') ?>?id=<?= $book->isbn ?>">
                Посмотреть подробнее
            </a>
        </div>
    <?php endforeach; ?>
</div>

<!--INSERT INTO `books`(`isbn`, `book_name`, `author_id`, `year`, `price`, `is_new`, `annotation`, `category_id`, `image`) VALUES (1,'Мастер и Маргарита', 1, 1928, 500, 0,'культовая книга Булгакова', 1,'[value-9]');-->
<!--INSERT INTO `books`(`isbn`, `book_name`, `author_id`, `year`, `price`, `is_new`, `annotation`, `category_id`, `image`) VALUES (2,'Собачье сердце', 1, 1961, 800, 0, 'Острая сатира на большевизм, она была написана в разгар периода НЭПа, когда коммунизм в СССР, на первый взгляд, начал сдавать позиции', 4,'[value-9]');-->