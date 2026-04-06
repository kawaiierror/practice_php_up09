<?php

namespace Controller;

use Model\Book;
use Model\Category;

use Src\View;
use Src\Request;

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

//    public function book_detail($id)
//    {
//        // Ищем книгу по ID из URL
//        $book = Book::with(['author', 'category'])->find($id);
//
//        if (!$book) {
//            // Если книга не найдена, можно вернуть 404 или редирект
//            return abort(404);
//        }
//
//        return view('book.book_detail', compact('book'));
//    }

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
