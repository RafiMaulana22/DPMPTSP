<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest as Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function register()
    {
        return view('auth.register-fix');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
