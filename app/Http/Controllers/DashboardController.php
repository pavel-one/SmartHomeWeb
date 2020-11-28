<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('dashboard-index', [
            'title' => 'Личный кабинет'
        ]);
    }

    public function token(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        while (true) {
            $token = Str::random(10);
            if (!User::whereToken($token)->count()) {
                $user->update(['token' => $token]);
                return back();
            }
        }
    }

    public function profile()
    {
        return Inertia::render('profile', [
            'title' => 'Мой профиль'
        ]);
    }

    public function delete(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        \Auth::logout();
        $user->delete();
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $findEmail = User::where('email', '=', $request->post('email'))
            ->where('id', '!=', $user->id)
            ->count();

        if ($findEmail) {
            return back()->withErrors(['email' => ['Такой email уже занят']]);
        }

        $updateData = [
            'name' => $request->post('name'),
            'email' => $request->post('email'),
        ];

        if ($password = $request->post('password')) {
            $updateData['password'] = \Hash::make($password);
        }

        if (!$user->update($updateData)) {
            return back()->withErrors(['Ошибка сохранения профиля']);
        }

        if ($password) {
            \Auth::logout();
            return redirect()->route('auth.index')->withErrors(['Необходимо еще раз авторизоваться']);
        }

        return back();
    }
}
