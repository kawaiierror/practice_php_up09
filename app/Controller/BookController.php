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
}
