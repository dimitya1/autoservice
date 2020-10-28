<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Promise\all;

final class RepairController
{
    public function index()
    {
        return view('user-repairs', ['repairs' => auth()->user()->repairs->sortByDesc('created_at')->all()]);
    }
}

