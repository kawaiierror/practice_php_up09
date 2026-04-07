<?php
?>
<h2>Добавление книги</h2>
<form action="<?= app()->route->getUrl('/add_book') ?>" method="POST" enctype="multipart/form-data">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

    <input type="text" name="book_name" placeholder="Название книги" required>

    <label>Автор:</label>
    <select name="author_id" required>
        <option value="">Выберите автора</option>
        <?php foreach ($authors as $author): ?>
            <option value="<?= $author->author_id ?>">
                <?= $author->name ?> <?= $author->lastname ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label>Категория:</label>
    <select name="category_id" required>
        <option value="">Выберите категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category->category_id ?>">
                <?= $category->name ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="text" name="annotation" placeholder="Описание" required>
    <input type="number" name="price" placeholder="Цена" required>
    <input type="number" name="year" placeholder="Год издания" required>
    <select name="is_new" required>
        <option value="0">Не новинка</option>
        <option value="1">Новинка</option>
    </select>

    <input type="file" name="cover_image">
    <button class="create_book_btn" type="submit">Создать</button>
</form>