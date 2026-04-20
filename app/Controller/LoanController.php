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
        $isbn = $_GET['isbn'] ?? null;

        $user_id = app()->auth::user()->id ?? null;

        if (!$isbn || !$user_id) {
            return "Ошибка: Книга не выбрана или вы не авторизованы.";
        }

        $issue_date = date('Y-m-d'); // Сегодня
        $due_date = date('Y-m-d', strtotime('+30 days')); // Сегодня + 30 дней

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

    public function loan_list_all(Request $request): string
    {
        $loans = \Model\Loan::with(['book.author', 'user'])->get();

        return new \Src\View('loan.loan_list_all', ['loans' => $loans]);
    }
    public function delete_loan(Request $request)
    {
        $loan_id = $request->id;
        $loan = \Model\Loan::find($loan_id);

        if ($loan) {
            $book = $loan->book;
            if ($book) {
                $book->update(['status' => 'доступна']);
            }

            $loan->delete();
        }

        app()->route->redirect('/loan_list_all');
    }
}