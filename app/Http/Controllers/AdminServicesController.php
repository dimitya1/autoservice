<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
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
        $categories = DB::table('services')->where('deleted_at', null)->select('category')->distinct()->get();
        $categoryNormal = str_replace('_', ' ', $category);
        $services = Service::where('category', '=', $categoryNormal)->get();

        if ($category == null) {
            $notUsedServices = DB::table('services')
                ->whereNotIn('id', DB::table('request_service')->groupBy('service_id')->pluck('service_id'))
                ->get();
        } else {
            $notUsedServices = DB::table('services')
                ->where('category', '=', $categoryNormal)
                ->whereNotIn('id', DB::table('request_service')->groupBy('service_id')->pluck('service_id'))
                ->get();
        }

        $categoriesWithButtons = array();
        foreach ($categories as $category) {
            if ($category->category == $categoryNormal) {
                $categoriesWithButtons[$category->category] = 'btn btn-secondary active';
            } else {
                $categoriesWithButtons[$category->category] = "btn btn-secondary";
            }
        }

        $experiencedMechanic = DB::select("SELECT mechanic_id, COUNT(mechanic_id) as 'count' FROM repairs JOIN (SELECT * FROM services WHERE category = '$categoryNormal') as `s`
            ON repairs.service_id = s.id
                GROUP BY mechanic_id, category order by count DESC LIMIT 1");

        if (count($experiencedMechanic) === 1) {
            $mechanicModel = Mechanic::find($experiencedMechanic[0]->mechanic_id);
        }

        return view('admin-services', ['services' => $services, 'categoriesWithButtons' => $categoriesWithButtons,
            'experiencedMechanic' => $experiencedMechanic, 'mechanicModel' => $mechanicModel ?? null,
            'notUsedServices' => $notUsedServices ?? null]);
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
                'price' => 'required|digits_between:2,6',
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
                'price' => 'required|digits_between:2,6',
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
