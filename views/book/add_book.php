<?php
?>
<h2>Добавление книги</h2>
<form action="/practice_php_up09/add_book" method="POST" enctype="multipart/form-data">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

    <input type="text" name="book_name" placeholder="Название книги" required>

    <!-- Выбор автора (в реальном проекте здесь должен быть цикл по авторам из БД) -->
    <select name="author_id" required>
        <option value="">Выберите автора</option>
        <option value="1">Автор №1</option>
    </select>

    <!-- Выбор категории -->
    <select name="category_id" required>
        <option value="">Выберите категорию</option>
        <option value="1">Категория №1</option>
    </select>

    <input type="text" name="annotation" placeholder="Описание" required>

    <input type="file" name="cover_image">
    <button type="submit">Создать</button>
</form>