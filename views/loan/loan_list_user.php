<?php
?>
<h2>Мои взятые книги</h2>

    <div class="book_grid">
        <?php foreach ($loans as $loan): ?>
            <?php $book = $loan->book; // Для удобства вынесем книгу в переменную ?>

            <div class="loan_item">
                <?php if ($book->image): ?>
                    <img src="<?= app()->route->getUrl('/public' . $book->image) ?>"
                         alt="<?= $book->book_name ?>"
                         width="250">
                <?php else: ?>
                    <p>нет фото</p>
                <?php endif; ?>


                <h4><?= $book->book_name ?></h4>

                <p><b>Дата выдачи:</b> <?= $loan->issue_date ?></p>
                <p><b>Вернуть до:</b> <span style="color: red;"><?= $loan->due_date ?></span></p>

                <p><b>Автор: </b>  <?= $book->author->name ?? '' ?> <?= $book->author->lastname ?? 'Неизвестен' ?></p>
                <p><b>Категория: </b> <?= $book->category->name ?? 'Без категории' ?></p>

<!--                <div style="margin-top: 10px; border-top: 1px solid #eee; pt-2">-->
<!--                    <a href="--><?php //= app()->route->getUrl('/book_detail') ?><!--?id=--><?php //= $book->isbn ?><!--">-->
<!--                        Страница книги-->
<!--                    </a>-->
<!--                </div>-->
            </div>
        <?php endforeach; ?>
        <a href="<?= app()->route->getUrl('/book_list') ?>">Назад в каталог</a>
    </div>

<?php if (empty($loans)): ?>
    <p>У вас пока нет активных заявок на книги.</p>
<?php endif; ?>