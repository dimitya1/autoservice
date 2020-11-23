<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Service;
use function GuzzleHttp\Promise\all;

final class RepairController
{
    public function index()
    {
        if (auth()->user()->cars->count() === 0) {
            return view('car-create-form')->withErrors(['no cars' => 'Для начала добавьте Ваш автомобиль!']);
        }
        if (auth()->user()->requests->count() === 0) {
            $cars = Car::where('user_id', auth()->id())->where('deleted_at', NULL)->get();

            $categories = Service::all()->pluck('category')->unique()->toArray();

            return view('request-form', ['cars' => $cars, 'categories' => $categories])
                ->withErrors(['no requests' => 'Для начала создайте заявку!']);
        }
        return view('user-repairs', ['repairs' => auth()->user()->repairs->sortByDesc('created_at')->all()]);
    }
}

