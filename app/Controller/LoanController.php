<?php


namespace Controller;

use Model\Book;
use Model\Category;

use Model\Loan;
use Src\View;
use Src\Request;
use Illuminate\Support\Facades\Storage;


class LoanController {
    public function loan_message(): string
    {
        return new View('loan.loan_message');
    }
    public function create_loan(Request $request): string
    {
        // 1. Получаем ISBN из GET-параметра (из ссылки)
        $isbn = $_GET['isbn'] ?? null;

        // 2. Получаем ID текущего авторизованного пользователя
        $user_id = app()->auth::user()->id ?? null;

        if (!$isbn || !$user_id) {
            return "Ошибка: Книга не выбрана или вы не авторизованы.";
        }

        // 3. Рассчитываем даты
        $issue_date = date('Y-m-d'); // Сегодня
        $due_date = date('Y-m-d', strtotime('+30 days')); // Сегодня + 30 дней

        // 4. Создаем запись в таблице loans
        $loan = new Loan();
        $loan->isbn = $isbn;
        $loan->user_id = $user_id;
        $loan->issue_date = $issue_date;
        $loan->due_date = $due_date;

        $book = Book::find($request->isbn);
        if ($book) {
            $book->update(['status' => 'забронирована']);
        }

        if ($loan->save()) {
            // Вместо редиректа возвращаем страницу с сообщением
            // 'loan.loan_message' — это путь к файлу views/loan/loan_message.php
            return new \Src\View('loan.loan_message', ['loan' => $loan]);
        }

        return "Произошла ошибка при бронировании книги.";
    }
    public function loan_list_user(Request $request): string
    {
        $user = app()->auth::user();
        $loans = $user->loans()->with(['book.author', 'book.category'])->get();
        $loans = $user->loans()->with('book')->get();

        return new \Src\View('loan.loan_list_user', compact('loans'));
    }

//    public function all_loans(): \Src\View
//    {
//        $loans = \Model\Loan::with(['book.author', 'user'])->get();
//
//        return new \Src\View('loan.loan_list_all', compact('loans'));
//    }
//    public function all_loans(Request $request)
//    {
//        return "Привет, я работаю!";
//    }
    public function loan_list_all(Request $request): string
    {
        $loans = \Model\Loan::with(['book.author', 'user'])->get();

        // Исправляем имя шаблона на loan_list_all
        return new \Src\View('loan.loan_list_all', ['loans' => $loans]);
    }
    public function delete_loan(Request $request)
    {
        $loan_id = $request->id;
        $loan = \Model\Loan::find($loan_id);

        if ($loan) {
            // 1. Находим книгу через связь и меняем статус
            $book = $loan->book;
            if ($book) {
                $book->update(['status' => 'доступна']);
            }

            // 2. Удаляем саму заявку
            $loan->delete();
        }

        app()->route->redirect('/loan_list_all');
    }
}