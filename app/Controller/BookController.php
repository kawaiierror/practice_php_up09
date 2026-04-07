<?php

namespace Controller;

use Model\Book;
use Model\Category;

use Src\View;
use Src\Request;
use Illuminate\Support\Facades\Storage;



class BookController
{
    public function book_list(): string
    {

        $books = Book::with(['author', 'category'])->get();

        return (new View())->render('book.book_list', [
            'books' => $books,
            'title' => 'Каталог книг'
        ]);
    }
    public function book_detail($request): string
    {
        $id = $request->id ?? $_GET['id'] ?? null;
        if (!$id) {
            return "ID книги не передан";
        }

        $book = \Model\Book::with(['author', 'category'])->find($id);

//        return (new View())->render('book.book_detail', [
//            'books' => $book,
//            'title' => 'Каталог книг'
//        ]);
        return new View('book.book_detail', ['book' => $book]);
    }
    public function create_book(Request $request): string
    {
        $book_name   = $_POST['text'] ?? 'Без названия'; // Проверьте, что в HTML name="text"
        $author_id   = $_POST['author_id'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        $annotation  = $_POST['annotation'] ?? 'Без описания';

        // 2. Валидация: если нет ID автора или категории, БД выдаст ошибку ForeignKey
        if (!$author_id || !$category_id) {
            return "Ошибка: Не переданы ID автора или категории. Проверьте форму.";
        }

        // 3. Логика загрузки файла
        $url = null;
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['cover_image'];
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = time() . '.' . $extension;

            // Путь от контроллера до папки public
            $uploadDir = __DIR__ . '/../../public/uploads/cover_images/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Этот путь запишется в базу данных
                $url = '/uploads/cover_images/' . $fileName;
            }
        }

        // 4. Создание записи в БД
        $book = new \Model\Book();
        $book->book_name   = $book_name;
        $book->author_id   = $author_id;
        $book->category_id = $category_id;
        $book->annotation  = $annotation;
//        $book->year        = date('Y');
        $book->image       = $url;

        // 5. Сохранение
        $book->save();

        // Возвращаем объект книги или редирект
        return $book;

    }
    public function show_create_form(): string
    {
        // Здесь укажите путь к вашему файлу с HTML-формой
        // Например, если файл в /views/book/create.php:
        return new \Src\View('book.add_book');
    }

    public function delete_book(Request $request): void
    {
        $id = $request->id;

        // 1. Находим конкретную книгу по ID
        $book = \Model\Book::find($id);

        // 2. Если книга найдена — удаляем её
        if ($book) {
            $book->delete();
        }

        app()->route->redirect('/book_list'); // Возвращаем на список книг после удаления

    }




//    public function store(Request $request)
//    {
//        $data = $request->all();
//
//        if ($request->hasFile('image')) {
//            $file = $request->file('image');
//            // Генерируем уникальное имя
//            $filename = time() . '_' . $file->getClientOriginalName();
//
//            // Перемещаем в public/images/covers
//            $file->move(public_path('images/covers'), $filename);
//
//            // Записываем имя файла в базу
//            $data['image'] = $filename;
//        }
//
//        \Model\Book::create($data);
//    }
}
