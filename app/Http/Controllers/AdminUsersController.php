<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class AdminUsersController
{
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

        return redirect()->route('admin.users.index');
    }
}

