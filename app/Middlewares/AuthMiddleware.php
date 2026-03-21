<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AuthMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь не авторизован, то редирект на страницу входа
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }
        elseif (app()->auth::check() && app()->auth::user()->role === 'администратор') {
            app()->route->redirect('/');
        }
    }
}