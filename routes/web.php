<?php

use Src\Route;

//Route::add('go', [Controller\Site::class, 'index']);
//Route::add('hello', [Controller\Site::class, 'hello']);
//Route::add('signup', [Controller\Site::class, 'signup']);
//Route::add('login', [Controller\Site::class, 'login']);
//Route::add('logout', [Controller\Site::class, 'logout']);

Route::add('GET', '/', [Controller\Site::class, 'hello']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])->middleware('auth');
Route::add('GET', '/profile', [Controller\Site::class, 'profile'])->middleware('auth');
Route::add(['GET', 'POST'], '/users_list', [Controller\Admin::class, 'users_list'])->middleware('admin');
Route::add('GET', '/error403', [Controller\Error::class, 'error403']);
Route::add('POST', '/update_role', [Controller\Admin::class, 'update_role'])->middleware('admin', 'checkNotSelfUpdate');
