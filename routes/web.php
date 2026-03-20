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
Route::add('GET', '/profile', [Controller\Site::class, 'profile']); //новая страица