<?php

namespace App\Http\Controllers;

final class ContactsController
{
    public function __invoke()
    {
        return view('contacts');
    }
}

