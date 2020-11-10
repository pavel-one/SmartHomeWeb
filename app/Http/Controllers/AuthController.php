<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('login', [
            'title' => 'Войти | ' . env('APP_NAME'),
            'pageTitle' => 'Вход'
        ]);
    }

    public function register()
    {
        return Inertia::render('register', [
            'title' => 'Регистрация | ' . env('APP_NAME')
        ]);
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => ['required', 'max:30', 'integer'],
            'password' => ['required', 'max:30'],
        ]);
        dd($request->all());
    }
}
