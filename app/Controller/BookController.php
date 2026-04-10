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
        $book_name   = $_POST['book_name'] ?? 'Без названия';
        $author_id   = $_POST['author_id'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        $annotation  = $_POST['annotation'] ?? 'Без описания';
        $price  = $_POST['price'] ?? 'Не указана';
        $year  = $_POST['year'] ?? 'Не указан';
        $is_new = $_POST["is_new"] ?? 'Не указано';

        $url = null;
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['cover_image'];
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = time() . '.' . $extension;

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

        $book = new \Model\Book();
        $book->book_name   = $book_name;
        $book->author_id   = $author_id;
        $book->category_id = $category_id;
        $book->annotation  = $annotation;
        $book->image       = $url;
        $book->price       = $price;
        $book->year       = $year;
        $book->is_new       = $is_new;
        $book->status      = 'доступна';


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
            $exists = \Model\Category::where('name', $name)->exists();

            if ($exists) {
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

        if ($name) {
            $exists = \Model\Author::where('name', $name)->exists();

            if ($exists) {
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
