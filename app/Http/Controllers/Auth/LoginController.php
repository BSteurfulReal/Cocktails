<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = ApplicationController::redirectToAfterLogin;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
