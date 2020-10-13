<?php

namespace iksaku\Laravel\Mops\Http\Middleware;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Session\Middleware\AuthenticateSession as BaseAuthenticateSession;

class AuthenticateSession extends BaseAuthenticateSession
{
    protected function guard()
    {
        return app(StatefulGuard::class);
    }
}