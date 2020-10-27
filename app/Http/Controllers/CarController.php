<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

final class CarController
{
    public function create()
    {
        return view('car-create-form');
    }

    public function store()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'make' => 'required|min:3|max:25',
                'model' => 'required|min:1|max:25',
                'year' => 'required|digits:4',
                'vin' => 'required|min:17|max:17',
                'colour' => 'required|min:4|string|max:20',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('car.create')
                ->withErrors($validator->errors());
        }

        $carDataArray = request()->all();

        if (Car::where('vin', $carDataArray['vin'])->first() == null) {
            if ($carDataArray['year'] <= 1980 || $carDataArray['year'] > Carbon::now()->year) {
                return redirect()
                    ->route('car.create')
                    ->with('old car', 'Извините, но мы не возьмёмся ремонтировать Вашу ласточку!');
            }
            $car = new Car();
            $car->user_id = auth()->id();
            $car->make = $carDataArray['make'];
            $car->model = $carDataArray['model'];
            $car->vin = $carDataArray['vin'];
            $car->year = $carDataArray['year'];
            $car->colour = $carDataArray['colour'];
            $car->save();

            return redirect()
                ->route('profile')
                ->with('successful car add', 'Вы успешно добавили автомобиль! Теперь можно создавать заявку!');

        } else return redirect()
            ->route('car.create')
            ->with('duplicate vin', 'Автомобиль с vin-кодом ' . $carDataArray['vin'] . ' уже существует!');
    }
}

