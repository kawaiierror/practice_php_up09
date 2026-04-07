<?php


namespace Controller;

use Model\Book;
use Model\Category;

use Src\View;
use Src\Request;
use Illuminate\Support\Facades\Storage;


class LoanController {
    public function loan_message(): string
    {
        return new View('loan.loan_message');
    }
}