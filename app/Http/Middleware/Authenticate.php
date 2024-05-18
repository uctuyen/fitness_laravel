<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        $role = $guards[0];
        if ($role == 'trainer') {
            $toRoute = 'trainer.login';
        } else {
            $toRoute = 'member.login';
        }

        return $request->expectsJson() ? null : route($toRoute);
    }
}
