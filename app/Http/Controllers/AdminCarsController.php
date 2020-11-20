<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

final class AdminCarsController
{
    public function index($orderBy = null)
    {
        switch ($orderBy) {
            case null:
                $cars = Car::orderByDesc('created_at')->with('user')->get();
                break;
            case 'По_марке':
                $cars = Car::orderByDesc('make')->orderByDesc('created_at')->with('user')->get();
                break;
            case 'По_году_выпуска_(сначала_новые)':
                $cars = Car::orderByDesc('year')->orderByDesc('created_at')->with('user')->get();
                break;
            case 'По_году_выпуска_(сначала_старые)':
                $cars = Car::orderBy('year')->orderByDesc('created_at')->with('user')->get();
                break;
            case 'По_году_выпуска_(только_2000+)':
                $cars = Car::orderBy('year')->where('year', 'like', '2___')->with('user')->get();
                break;
            case 'По_году_выпуска_(только_1980+)':
                $cars = Car::orderBy('year')->where('year', 'like', '1___')->with('user')->get();
                break;
        }
        return view('admin-cars', ['cars' => $cars, 'orderBy' => $orderBy]);
    }

    public function create()
    {
        return view('admin-cars-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'email' => 'required|min:9|max:45|email',
                'make' => 'required|min:3|max:25',
                'model' => 'required|min:1|max:25',
                'year' => 'required|digits:4',
                'vin' => 'required|min:17|max:17',
                'colour' => 'required|min:4|string|max:20',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('admin.cars.create')
                ->withErrors($validator->errors());
        }

        $carDataArray = request()->all();

        $user = User::where('email', '=', $carDataArray['email'])->first();
        if ($user == null) {
            return redirect()
                ->route('admin.cars.create')
                ->with('user not found', 'Пользователь с данным email не найден!');
        }

        if ($carDataArray['year'] <= 1980 || $carDataArray['year'] > Carbon::now()->year) {
            return redirect()
                ->route('admin.cars.create')
                ->with('old car', 'Извините, но мы не возьмёмся ремонтировать Вашу ласточку!');
        }

        if (Car::where('vin', $carDataArray['vin'])->first() == null) {
            $car = new Car();
            $car->user_id = $user->id;
            $car->make = $carDataArray['make'];
            $car->model = $carDataArray['model'];
            $car->year = (int)$carDataArray['year'];
            $car->vin = $carDataArray['vin'];
            $car->colour = $carDataArray['colour'];
            $car->save();
            return redirect()
                ->route('admin.cars.index')
                ->with('successful car create', 'Вы успешно добавили автомобиль и привязали его к кленту!');

        } else return redirect()
            ->route('admin.cars.create')
            ->with('duplicate vin', 'Автомобиль с vin-кодом ' . $carDataArray['vin'] . ' уже существует!');
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('successful car delete', 'Вы успешно удалили автомобиль!');
    }
}

