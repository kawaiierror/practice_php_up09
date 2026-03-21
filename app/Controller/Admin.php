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
    public function update_role(Request $request)
    {
        $userId = $request->user_id;
        $newRole = $request->role;

        $user = User::where('id', $userId)->first();

        if ($user) {
            $user->role = $newRole;
            $user->save();
        }

        app()->route->redirect('/users_list');
    }

}
