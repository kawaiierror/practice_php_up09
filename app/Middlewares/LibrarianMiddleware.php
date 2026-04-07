<?php

namespace Middlewares;

use Src\Request;

class LibrarianMiddleware
{
    public function handle(Request $request)
    {
        if (app()->auth::user()->role !== 'администратор' && app()->auth::user()->role !== 'библиотекарь') {
            app()->route->redirect('/error403');
        }
    }
}