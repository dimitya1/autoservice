<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

final class AuthController
{
    public function profile() {
        $authUser = User::find(auth()->id());

        $repairsCount = $authUser->repairs->count();
        $doneRepairsCount = $authUser->repairs->where('status', '=', 1)->count();

        return view('profile', [
            'authUser' => $authUser,
            'repairsCount' => $repairsCount,
            'doneRepairsCount' => $doneRepairsCount
        ]);
    }


    public function login()
    {
        return view('login-form');
    }


    public function loginCheck()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'email' => 'required|min:9|max:45|email',
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors());
        }

        $credentials = [
            'email' => request()->get('email'),
            'password' => request()->get('password'),
        ];

        $remember = request()->get('remember') === 'on';

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email or password' => 'Неверный пароль или E-Mail!']);
        }

        return redirect()
            ->route('home')
            ->with('successful login', 'Вы успешно вошли в систему!');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()
            ->route('home');
    }


    public function register()
    {
        return view('register-form');
    }


    public function registerCheck()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:4|max:75',
                'email' => 'required|min:9|max:45|email',
                'mobile' => 'required|min:13|max:13',
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'max:45',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
                'password_confirmation' => 'required|same:password',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator->errors());
        }

        $userDataArray = request()->all();

        if (User::where('email', $userDataArray['email'])->first() == null) {
            $user = new User();
            $user->name = $userDataArray['name'];
            $user->email = $userDataArray['email'];
            $user->mobile_phone = $userDataArray['mobile'];
            $user->password = Hash::make($userDataArray['password']);
            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
            $user->save();

            Auth::login($user);

            return redirect()
                ->route('home')
                ->with('successful register', 'Вы успешно зарегистрировались! Теперь добавьте Ваш автомобиль!');

        } else return redirect()
            ->route('register')
            ->with('duplicate email', 'Пользователь с e-mail ' . $userDataArray['email'] . ' уже существует!');
    }
}

