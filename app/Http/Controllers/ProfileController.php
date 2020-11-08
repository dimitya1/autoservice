<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

final class ProfileController
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

    public function edit()
    {
        $authUser = User::find(auth()->id());

        return view('profile-edit-form', ['authUser' => $authUser]);
    }

    public function update()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:4|max:75',
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
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('profile.edit')
                ->withErrors($validator->errors());
        }

        $authUser = User::find(auth()->id());

        if (Hash::check(request()->get('password'), $authUser->password)) {
            if ($authUser->name == request()->get('name')
                && $authUser->mobile_phone == request()->get('mobile')) {
                return redirect()
                    ->route('profile')
                    ->with('nothing to update', 'Нечего обновлять!');
            }
            $authUser->name = request()->get('name');
            $authUser->mobile_phone = request()->get('mobile');
            $authUser->save();
        } else {
            return redirect()
                ->route('profile.edit')
                ->with('password does not match', 'Введённый пароль неверный!');
        }

        return redirect()
            ->route('profile')
            ->with('successful profile edit', 'Данные профиля были успешно обновлены!');
    }
}

