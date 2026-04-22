<?php

namespace Controller;

use Model\Book;
use Src\Request;
use Src\View;


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

        return new View('book.book_detail', ['book' => $book]);
    }
    public function create_book(Request $request): void //void
    {
        $book_name   = $_POST['book_name'] ?? 'Без названия';
        $author_id   = $_POST['author_id'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        $annotation  = $_POST['annotation'] ?? 'Без описания';
        $year  = $_POST['year'] ?? 'Не указан';
        $is_new = $_POST["is_new"] ?? 'Не указано';

        $textValidator = new \MyValidator\BookValidator();
        $yearValidator = new \MyValidator\YearValidator();
        $imageValidator = new \MyValidator\ImageValidator();

        if (!$book_name || !$textValidator->handle($book_name)) {
            $errors[] = 'Название: ' . $textValidator->getMessage();
        }

        if ($year && !$yearValidator->handle($year)) {
            $errors[] = 'Год: ' . $yearValidator->getMessage();
        }

        $url = null;
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            if (!$imageValidator->handle($_FILES['cover_image'])) {
                $errors[] = 'Обложка: ' . $imageValidator->getMessage();
            }

            $file = $_FILES['cover_image'];
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = time() . '.' . $extension;

            $uploadDir = __DIR__ . '/../../public/uploads/cover_images/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $url = '/uploads/cover_images/' . $fileName;
            }
        }

        $book = new \Model\Book();
        $book->book_name   = $book_name;
        $book->author_id   = $author_id;
        $book->category_id = $category_id;
        $book->annotation  = $annotation;
        $book->image       = $url;
        $book->year       = $year;
        $book->is_new       = $is_new;
        $book->status      = 'доступна';

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            app()->route->redirect('/add_book');
            return;
        }

        $book->save();

        app()->route->redirect('/book_list');

    }
    public function show_create_form(): string
    {
        $authors = \Model\Author::all();
        $categories = \Model\Category::all();

        return new \Src\View('book.add_book', [
            'authors' => $authors,
            'categories' => $categories
        ]);
    }

    public function delete_book(Request $request): void
    {
        $id = $request->id;

        $book = \Model\Book::find($id);

        if ($book) {
            $book->delete();
        }

        app()->route->redirect('/book_list'); // редирект на список книг после удаления

    }

    public function show_category_form(): string
    {
        return new \Src\View('book.add_category');
    }
    public function create_category(Request $request): void
    {
        $name = $_POST['name'] ?? null;

        if ($name) {
            $cyrillicValidator = new \MyValidator\CyrillicValidator();
            if (!$cyrillicValidator->handle($name)) {
                $_SESSION['error'] = $cyrillicValidator->getMessage();
                app()->route->redirect('/add_category');
                return;
            }

            $exists = \Model\Category::where('name', $name)->exists();

            if ($exists) {
                $_SESSION['error'] = 'Такая категория уже существует!';
                app()->route->redirect('/add_category');
                return;
            }

            $category = new \Model\Category();
            $category->name = $name;
            $category->save();
        }

        app()->route->redirect('/book_list');
    }

    public function show_author_form(): string
    {
        return new \Src\View('book.add_author');
    }
    public function create_author(Request $request): void
    {
        $name = $_POST['name'] ?? null;
        $lastname = $_POST['lastname'] ?? null;
        $year_of_birth = $_POST['year_of_birth'] ?? null;
        $year_of_death = $_POST['year_of_death'] ?? null;

        $errors = [];

        if ($request->method === 'POST') {
            $cyrillic = new \MyValidator\CyrillicValidator();
            $yearValid = new \MyValidator\YearValidator();

            if (!$cyrillic->handle($name)) {
                $errors[] = 'Имя должно содержать только кириллицу, пробелы и дефисы';
            }
            if (!$cyrillic->handle($lastname)) {
                $errors[] = 'Фамилия должна содержать только кириллицу, пробелы и дефисы';
            }

            if (!$yearValid->handle($year_of_birth)) {
                $errors[] = 'Год рождения должен содержать только цифры (до 4 цифр)';
            }
            if ($year_of_death && !$yearValid->handle($year_of_death)) {
                $errors[] = 'Год смерти должен содержать только цифры (до 4-цифр)';
            }

            if ($year_of_death && $year_of_birth && $year_of_death < $year_of_birth) {
                $errors[] = 'Год смерти не может быть раньше года рождения';
            }

            if (empty($errors)) {
                $exists = \Model\Author::where([
                    'name' => $name,
                    'lastname' => $lastname,
                    'year_of_birth' => $year_of_birth,
                    'year_of_death' => $year_of_death,
                ])->exists();

                if ($exists) {
                    $errors[] = 'Такой автор уже существует в базе данных';
                }
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                app()->route->redirect('/add_author');
                return;
            }

            $author = new \Model\Author();
            $author->name = $name;
            $author->lastname = $lastname;
            $author->year_of_birth = $year_of_birth;
            $author->year_of_death = $year_of_death;

            $author->save();
        }

        app()->route->redirect('/book_list');
    }
}
