<?php

namespace Middlewares;

use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {
        if (app()->auth::user()->role !== 'администратор') {
            app()->route->redirect('/error403');
        }
    }
}