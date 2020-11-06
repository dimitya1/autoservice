<?php

namespace App\Http\Controllers;

use App\Models\User;

final class AdminUsersController
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin-users', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('admin-one_user', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}

