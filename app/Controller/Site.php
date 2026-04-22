<?php

namespace Controller;

use Model\Post;
use Model\User;

use Src\Auth\Auth;
use Src\View;
use Src\Request;

use Src\Validator\Validator;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'Hello,']);
    }
    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required'],
                'lastname' => ['required'],
                'patronym' => [],
                'adress' => ['required'],
                'phone' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if ($validator->fails()) {
                return new View('site.signup', ['errors' => $validator->errors()]);
            }

            // Проверка кириллицы
            $cyrillic = new \Validators\CyrillicValidator();
            $errors = [];

            if (!$cyrillic->handle($request->name)) $errors['name'][] = 'Имя должно быть на кириллице';
            if (!$cyrillic->handle($request->lastname)) $errors['lastname'][] = 'Фамилия должна быть на кириллице';
            if ($request->patronym && !$cyrillic->handle($request->patronym)) $errors['patronym'][] = 'Отчество должно быть на кириллице';

            if (!empty($errors)) {
                return new View('site.signup', ['errors' => $errors]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup');
    }
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }

    public function profile(): string
    {
        return new View('site.profile');
    }


//    public function profile(): string
//    {
//        return new View('site.profile', ['message' => 'Hello,']);
//    }
}
