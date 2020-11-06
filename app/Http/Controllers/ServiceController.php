<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Mechanic;
use App\Models\Repair;
use App\Models\Request;
use App\Models\Worklist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

final class ServiceController
{
    public function index($category = null)
    {
        $category = str_replace('_', ' ', $category);
        $worklists = DB::table('worklists')->where('category', '=', $category)->get();

        $buttons = [
            'Выхлопная_система' => 'btn btn-secondary',
            'Двигатель' => 'btn btn-secondary',
            'Дополнительно' => 'btn btn-secondary',
            'Подвеска' => 'btn btn-secondary',
            'Рулевое_управление' => 'btn btn-secondary',
            'Сервисное_ТО' => 'btn btn-secondary',
            'Сцепление' => 'btn btn-secondary',
            'Тормозная_система' => 'btn btn-secondary',
            'Трансмиссия' => 'btn btn-secondary',
            'Шиномонтаж' => 'btn btn-secondary',
            'Электрика' => 'btn btn-secondary',
        ];

        $buttonsNormal = array();

        foreach (array_keys($buttons) as $button) {
            $buttonsNormal[] = str_replace('_', ' ', $button);
        }

        switch ($category) {
            case 'Выхлопная система':
                $buttons['Выхлопная_система'] = 'btn btn-secondary active';
                break;
            case 'Двигатель':
                $buttons['Двигатель'] = 'btn btn-secondary active';
                break;
            case 'Дополнительно':
                $buttons['Дополнительно'] = 'btn btn-secondary active';
                break;
            case 'Подвеска':
                $buttons['Подвеска'] = 'btn btn-secondary active';
                break;
            case 'Рулевое управление':
                $buttons['Рулевое_управление'] = 'btn btn-secondary active';
                break;
            case 'Сервисное ТО':
                $buttons['Сервисное_ТО'] = 'btn btn-secondary active';
                break;
            case 'Сцепление':
                $buttons['Сцепление'] = 'btn btn-secondary active';
                break;
            case 'Тормозная система':
                $buttons['Тормозная_система'] = 'btn btn-secondary active';
                break;
            case 'Трансмиссия':
                $buttons['Трансмиссия'] = 'btn btn-secondary active';
                break;
            case 'Шиномонтаж':
                $buttons['Шиномонтаж'] = 'btn btn-secondary active';
                break;
            case 'Электрика':
                $buttons['Электрика'] = 'btn btn-secondary active';
                break;
        }

        return view('services', ['worklists' => $worklists, 'buttons' => $buttons, 'buttonsNormal' => $buttonsNormal]);
    }

    public function create()
    {
        if (auth()->user()->cars->count() === 0) {
            return view('car-create-form')->withErrors(['no cars' => 'Для начала добавьте Ваш автомобиль!']);
        }

        $cars = auth()->user()->cars->all();

        $categories = Worklist::all()->pluck('category')->unique()->toArray();

        return view('request-form', ['cars' => $cars, 'categories' => $categories ]);
    }

    public function store()
    {
        if (\request()->get('car') === 'Выберите автомобиль') {
            return redirect()->route('request.create')->withErrors(['no car selected' => 'Проверьте, выбрали ли Вы автомобиль']);
        }

        $works = request()->keys();

        if ($works[2] === null || $works[2] === 'description') {
            return redirect()->route('request.create')->withErrors(['no worklist selected' => 'Проверьте, выбрали ли Вы работы по автомобилю']);
        }

        $carData = explode(" ", \request()->get('car'));;

        $car = Car::all()->where('make', $carData[0])->where('model', $carData[1])
            ->where('year', $carData[2])->where('user_id', auth()->id())->first();

        $request = new Request();
        $request->user_id = auth()->id();
        $request->car_id = $car->id;
        $request->status = 0;
        $request->description = \request()->get('description');
        $request->date = Carbon::now()->addDays(rand(1, 3))->setHour(8)->minute(0)->second(0);
        $request->save();

        unset($works[0]);
        unset($works[1]);

        $normalWorks = array();

        foreach ($works as $work) {
            $normalWorks[] = str_replace('_', ' ', $work);
        }

        foreach (Worklist::all() as $worklist) {
            if (in_array($worklist->name, $normalWorks)) {
                $worklist->requests()->attach($request->id);
            }
        }

        $mechanicsWithoutWork = Mechanic::all()->where('status', 0);

        $randomMechanicWithoutWork = $mechanicsWithoutWork->random();

        $requestWorklists = Worklist::whereHas('requests', function ($q) use ($request) {
            $q->where('request_id', '=', $request->id);
        })->get();

        $sumToPay = 0;

        foreach ($requestWorklists as $requestWorklist) {
            $sumToPay = $sumToPay + $requestWorklist->price;
            $repair = new Repair();
            $repair->request_id = $request->id;
            $repair->worklist_id = $requestWorklist->id;
            $repair->mechanic_id = $randomMechanicWithoutWork->pluck('id') ?? Mechanic::all()->pluck('id')->random();
            $repair->status = 0;
            $repair->save();
        }

        $randomMechanicWithoutWork->status = 1;

        return redirect()->route('profile')->with(
            ['created request' => 'Заявка успешно добавлена. Приезжайте к нам с ' .
                Carbon::parse($request->date)->format("d.m с h:i") . ' Примерная стоимость услуг - ' .  $sumToPay . 'грн.']);
    }
}

