<?php

namespace App\Http\Controllers;

final class AdminController
{
    public function __invoke()
    {
        return view('admin-panel');
    }
}

