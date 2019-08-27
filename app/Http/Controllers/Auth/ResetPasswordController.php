<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected string $redirectTo = ApplicationController::redirectToAfterLogin;

    public function __construct()
    {
        $this->middleware('guest');
    }
}
