<?php

namespace Controller;

use Model\Post;
use Model\User;

use Src\Auth\Auth;
use Src\View;
use Src\Request;

class Admin
{
    public function users_list(Request $request): string
    {
        $users = User::all();
        return (new View())->render('admin.users_list', ['users' => $users]);
    }
}
