<?php
?>
<h2>Все заявки пользователей</h2>

<div class="book_grid">
    <?php foreach ($loans as $loan): ?>
        <?php $book = $loan->book; ?>
        <?php $user = $loan->user; ?>

        <div class="loan_item">
            <?php if ($book && $book->image): ?>
                <img src="/practice_php_up09/public<?= $book->image ?>" width="250">
            <?php else: ?>
                <p>Нет фото</p>
            <?php endif; ?>

            <h4>Книга: <?= $book->book_name ?? 'Удалена' ?></h4>
            <p><b>Автор:</b> <?= $book->author->name ?? '' ?> <?= $book->author->lastname ?? '' ?></p>

            <div class="loan_item_info">
                <p><b>Кто забронировал:</b>
                    <?= $user->name ?? 'Неизвестный' ?>
                    <?= $user->lastname ?? '' ?>
                    (ID: <?= $user->id ?? '?' ?>)
                </p>
                <p><b>Дата выдачи:</b> <?= $loan->issue_date ?></p>
                <p><b>Вернуть до:</b> <span style="color: red;"><?= $loan->due_date ?></span></p>
            </div>

            <div style="margin-top: 15px; border-top: 1px solid #eee; padding-top: 10px;">
                <form action="<?= app()->route->getUrl('/delete_loan') ?>" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить заявку и освободить книгу?')">
                    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                    <input type="hidden" name="id" value="<?= $loan->loan_id ?>">

                    <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">
                        Удалить заявку (Вернуть книгу)
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($loans->isEmpty()): ?>
    <p>Список заявок пуст.</p>
<?php endif; ?>

<a href="<?= app()->route->getUrl('/book_list') ?>">Назад в каталог</a>