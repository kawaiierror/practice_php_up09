<?php

use Src\Route;


Route::add('GET', '/', [Controller\Site::class, 'hello']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])->middleware('auth');
Route::add('GET', '/profile', [Controller\Site::class, 'profile'])->middleware('auth');
Route::add(['GET', 'POST'], '/users_list', [Controller\Admin::class, 'users_list'])->middleware('admin');
Route::add('GET', '/error403', [Controller\Error::class, 'error403']);
Route::add('POST', '/update_role', [Controller\Admin::class, 'update_role'])->middleware('admin', 'checkNotSelfUpdate');

Route::add('GET', '/book_list', [Controller\BookController::class, 'book_list'])->middleware('auth');
Route::add('GET', '/book_detail', [Controller\BookController::class, 'book_detail'])->middleware('auth');

Route::add('GET', '/add_book', [Controller\BookController::class, 'show_create_form'])->middleware('librarian');
Route::add('POST', '/add_book', [Controller\BookController::class, 'create_book'])->middleware('librarian');
Route::add('GET', '/delete_book', [Controller\BookController::class, 'delete_book'])->middleware('librarian');

Route::add('GET', '/create_loan', [Controller\LoanController::class, 'create_loan']);
Route::add('GET','/loan_list_user', [Controller\LoanController::class, 'loan_list_user'])->middleware('auth');
Route::add('GET','/loan_list_all', [Controller\LoanController::class, 'loan_list_all']);
