<?php

namespace App\Http\Controllers;

use App\Http\Middleware\NonAuth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('login', [
            'title' => 'Войти | ' . env('APP_NAME'),
            'pageTitle' => 'Вход',
        ]);
    }

    public function register()
    {
        return Inertia::render('register', [
            'title' => 'Регистрация | ' . env('APP_NAME')
        ]);
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('index');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => ['required', 'max:30'],
            'password' => ['required', 'max:30'],
        ]);

        $attempt = \Auth::attempt([
            'email' => $request->post('email'),
            'password' => $request->post('password')
        ]);

        if (!$attempt) {
            return back()->withErrors(['Неправильная пара логин/пароль']);
        }

        return redirect()->route('dashboard.index');
    }
}
