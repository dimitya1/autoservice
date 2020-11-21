<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Mechanic;
use App\Models\Repair;
use App\Models\Request;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

final class ServiceController
{
    public function index($category = null)
    {
        $categories = DB::table('services')->select('category')->distinct()->get();
        $categoryNormal = str_replace('_', ' ', $category);
        $services = DB::table('services')->where('category', '=', $categoryNormal)->get();

        $categoriesWithButtons = array();
        foreach ($categories as $category) {
            if ($category->category == $categoryNormal) {
                $categoriesWithButtons[$category->category] = 'btn btn-secondary active';
            } else {
                $categoriesWithButtons[$category->category] = "btn btn-secondary";
            }
        }

        return view('services', ['services' => $services, 'categoriesWithButtons' => $categoriesWithButtons]);
    }

    public function create()
    {
        if (auth()->user()->cars->count() === 0) {
            return view('car-create-form')->withErrors(['no cars' => 'Для начала добавьте Ваш автомобиль!']);
        }

        $cars = Car::where('user_id', auth()->id())->where('deleted_at', NULL)->get();

        $categories = Service::all()->pluck('category')->unique()->toArray();

        return view('request-form', ['cars' => $cars, 'categories' => $categories ]);
    }

    public function store()
    {
        if (\request()->get('car') === 'Выберите автомобиль') {
            return redirect()->route('request.create')->withErrors(['no car selected' => 'Проверьте, выбрали ли Вы автомобиль']);
        }

        $works = request()->keys();

        if ($works[2] === null || $works[2] === 'description') {
            return redirect()->route('request.create')->withErrors(['no service selected' => 'Проверьте, выбрали ли Вы необходимые услуги']);
        }

        $carData = explode(" ", \request()->get('car'));;

        $car = Car::all()->where('vin', end($carData))
            ->where('user_id', auth()->id())->first();

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

        foreach (Service::all() as $service) {
            if (in_array($service->name, $normalWorks)) {
                $service->requests()->attach($request->id);
            }
        }

        $mechanicsWithoutWork = Mechanic::all()->where('status', 0);

        $randomMechanicWithoutWork = $mechanicsWithoutWork->random();

        $requestServices = Service::whereHas('requests', function ($q) use ($request) {
            $q->where('request_id', '=', $request->id);
        })->get();

        $sumToPay = 0;

        foreach ($requestServices as $requestService) {
            $sumToPay = $sumToPay + $requestService->price;
            $repair = new Repair();
            $repair->request_id = $request->id;
            $repair->service_id = $requestService->id;
            $repair->mechanic_id = $randomMechanicWithoutWork->id ?? Mechanic::all()->pluck('id')->random();
            $repair->status = 0;
            $repair->save();
        }

        $randomMechanicWithoutWork->status = 1;
        $randomMechanicWithoutWork->save();

        return redirect()->route('profile')->with(
            ['created request' => 'Заявка успешно добавлена. Приезжайте к нам с ' .
                Carbon::parse($request->date)->format("d.m с h:i") . ' Примерная стоимость услуг - от ' .  $sumToPay . 'грн.']);
    }
}

