<?php

namespace Middlewares;

use Src\Request;
use Src\Auth\Auth;

class CheckNotSelfUpdate
{
    public function handle(Request $request)
    {
        $currentUserId = Auth::user()->id;

        $targetUserId = $request->user_id;

        if ($currentUserId == $targetUserId) {
            app()->route->redirect('/error403');
            exit;
        }
    }
}
