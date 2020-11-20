<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

final class AdminUsersController
{
    public function create()
    {
        return view('admin-users-create');
    }

    public function store(Request $request)
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
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('admin.users.create')
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
            return redirect()
                ->route('admin.users.index')
                ->with('successful user create', 'Вы успешно добавили нового клиента!');

        } else return redirect()
            ->route('admin.users.create')
            ->with('duplicate email', 'Пользователь с e-mail ' . $userDataArray['email'] . ' уже существует!');
    }

    public function index()
    {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $newUsersCount = DB::table('users')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $newUsersLastMonthCount = DB::table('users')->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin-users', ['users' => $users, 'newUsersCount' => $newUsersCount, 'newUsersLastMonthCount' => $newUsersLastMonthCount]);
    }

    public function show(User $user)
    {
        return view('admin-one_user', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('successful user delete', 'Вы успешно удалили пользователя!');
    }
}

