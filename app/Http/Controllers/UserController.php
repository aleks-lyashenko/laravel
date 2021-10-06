<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create() {
        return view('user.create');
    }

    public function store(Request $request) {

        //валидация данных
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        //сохранение данных в БД - в БД должен быть сохранен хэш пароля, а не он сам
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Флеш-сообщение об успешной регистрации
        session()->flash('success', 'Successful registration');

        //после регистрации пользователь сразу авторизуется на сайте
        Auth::login($user);

        //перенаправление на главную
        return redirect()->home();
    }

    public function loginForm() {
        return view('user.login');
    }

    public function login(Request $request) {
        //валидация данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //аутентификация
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->home();
        }
        //редирект на предыдущую страницу с показом ошибок
        return redirect()->back()->with('error', 'Incorrect login or password');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
