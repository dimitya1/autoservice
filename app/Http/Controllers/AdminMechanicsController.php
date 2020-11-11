<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

final class AdminMechanicsController
{
    public function index($orderBy = null)
    {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $bestMechanicLastMonth = DB::select("SELECT mechanics.email, mechanics.name, SUM(worklists.price) AS sum
                    FROM mechanics
                        INNER JOIN (SELECT * FROM repairs WHERE created_at BETWEEN '$startOfLastMonth' AND '$endOfLastMonth' AND status = 1)
                         AS r ON mechanics.id = r.mechanic_id
                            INNER JOIN worklists ON worklists.id = r.worklist_id
                                GROUP BY mechanics.email
                                    ORDER BY sum DESC
                                        LIMIT 1");

        $bestMechanic = DB::select("SELECT mechanics.email, mechanics.name, SUM(worklists.price) AS sum
                    FROM mechanics
                        INNER JOIN (SELECT * FROM repairs WHERE created_at BETWEEN '$startOfMonth' AND '$endOfMonth' AND status = 1)
                         AS r ON mechanics.id = r.mechanic_id
                            INNER JOIN worklists ON worklists.id = r.worklist_id
                                GROUP BY mechanics.email
                                    ORDER BY sum DESC
                                        LIMIT 1");

        switch ($orderBy) {
            case null:
                $mechanics = Mechanic::orderBy('created_at', 'desc')->get();
                break;
            case 'Только_свободные':
                $mechanics = Mechanic::orderBy('created_at', 'desc')->where('status', '=', 0)->get();
                break;
            case 'Только_занятые':
                $mechanics = Mechanic::orderBy('created_at', 'desc')->where('status', '=', 1)->get();
                break;
        }
        return view('admin-mechanics', ['mechanics' => $mechanics, 'bestMechanic' => $bestMechanic, 'bestMechanicLastMonth' => $bestMechanicLastMonth]);
    }

    public function create()
    {
        return view('admin-mechanics-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:4|max:75',
                'email' => 'required|min:9|max:45|email',
                'mobile' => 'required|min:13|max:13',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('admin.mechanics.create')
                ->withErrors($validator->errors());
        }

        $mechanicDataArray = request()->all();

        if (Mechanic::where('email', $mechanicDataArray['email'])->first() == null) {
            $mechanic = new Mechanic();
            $mechanic->name = $mechanicDataArray['name'];
            $mechanic->email = $mechanicDataArray['email'];
            $mechanic->mobile_phone = $mechanicDataArray['mobile'];
            $mechanic->status = 0;
            $mechanic->save();
            return redirect()
                ->route('admin.mechanics.index')
                ->with('successful mechanic create', 'Вы успешно добавили нового работника!');

        } else return redirect()
            ->route('admin.mechanics.create')
            ->with('duplicate email', 'Работник с e-mail ' . $mechanicDataArray['email'] . ' уже существует!');
    }

    public function show(Mechanic $mechanic)
    {
        return view('admin-one_mechanic', ['mechanic' => $mechanic]);
    }

    public function destroy(Mechanic $mechanic)
    {
        $mechanic->delete();

        return redirect()->route('admin.mechanics.index')
            ->with('successful mechanic delete', 'Вы успешно удалили работника!');
    }

    public function edit(Mechanic $mechanic)
    {
        return view('admin-edit-mechanic', ['mechanic' => $mechanic]);
    }

    public function update(Request $request, Mechanic $mechanic)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:7|max:75',
                'email' => 'required|min:9|max:45|email',
                'mobile' => 'required|min:13|max:13',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('admin.mechanics.edit', ['mechanic' => $mechanic])
                ->withErrors($validator->errors());
        }

        if (Mechanic::where('email', request()->get('email'))->first() == null || $mechanic->email === request()->get('email')) {
            $mechanic->name = request()->get('name');
            $mechanic->email = request()->get('email');
            $mechanic->mobile_phone = request()->get('mobile');
            $mechanic->save();

            return redirect()
                ->route('admin.mechanics.index')->with('successful mechanic update', 'Данные работника успешно обновлены!');
        } else return redirect()
            ->route('admin.mechanics.index')
            ->with('duplicate email', 'Механик с e-mail ' . request()->get('email') . ' уже существует!');
    }
}

