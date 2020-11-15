<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

final class AdminServicesController
{
    public function index($category = null)
    {
        $category = str_replace('_', ' ', $category);
        $services = Service::where('category', '=', $category)->get();

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

        return view('admin-services', ['services' => $services, 'buttons' => $buttons, 'buttonsNormal' => $buttonsNormal]);
    }

    public function create()
    {
        return view('admin-services-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name2' => 'required|min:3|max:55',
                'category' => 'required|min:2|max:55',
                'price' => 'required|digits_between:3,6',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('admin.services.create')
                ->withErrors($validator->errors());
        }

        $serviceDataArray = request()->all();

        $service = new Service();
        $service->name = $serviceDataArray['name2'];
        $service->category = $serviceDataArray['category'];
        $service->price = (int)$serviceDataArray['price'];
        $service->save();
        return redirect()
            ->route('admin.services.index')
            ->with('successful service create', 'Вы успешно добавили новую услугу!');
    }

    public function destroy(Service $service)
    {
        $service->requests()->detach();
        $service->delete();

        return back()
            ->with('successful service delete', 'Вы успешно удалили услугу из списка!');
    }

    public function edit(Service $service)
    {
        return view('admin-edit-service', ['service' => $service]);
    }

    public function update(Service $service)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name2' => 'required|min:3|max:55',
                'category' => 'required|min:2|max:55',
                'price' => 'required|digits_between:3,6',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('admin.services.edit', ['service' => $service])
                ->withErrors($validator->errors());
        }

        $serviceDataArray = request()->all();
        $service->name = $serviceDataArray['name2'];
        $service->category = $serviceDataArray['category'];
        $service->price = (int)$serviceDataArray['price'];
        $service->save();
        return redirect()
            ->route('admin.services.index')
            ->with('successful service update', 'Данные успешно обновлены!');
    }
}
