<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

final class AdminMechanicsController
{
    public function index($orderBy = null)
    {
        $today = Carbon::today()->toDateString();
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $bestMechanic = DB::select("SELECT mechanics.email, mechanics.name, SUM(worklists.price) AS sum
                    FROM mechanics
                        INNER JOIN (SELECT * FROM repairs WHERE created_at >= '$startOfMonth' AND created_at <= '$endOfMonth' AND status = 1)
                         AS r ON mechanics.id = r.mechanic_id
                            INNER JOIN worklists ON worklists.id = r.worklist_id
                                GROUP BY mechanics.email
                                    ORDER BY sum DESC
                                        LIMIT 1");

        switch ($orderBy) {
            case null:
                $mechanics = Mechanic::orderBy('created_at', 'desc')->get();
                return view('admin-mechanics', ['mechanics' => $mechanics, 'bestMechanic' => $bestMechanic]);
                break;
            case 'Только_свободные':
                $mechanics = Mechanic::orderBy('created_at', 'desc')->where('status', '=', 0)->get();
                return view('admin-mechanics', ['mechanics' => $mechanics, 'bestMechanic' => $bestMechanic]);
                break;
            case 'Только_занятые':
                $mechanics = Mechanic::orderBy('created_at', 'desc')->where('status', '=', 1)->get();
                return view('admin-mechanics', ['mechanics' => $mechanics, 'bestMechanic' => $bestMechanic]);
                break;
        }
    }

    public function show(Mechanic $mechanic)
    {
        return view('admin-one_mechanic', ['mechanic' => $mechanic]);
    }

    public function destroy(Mechanic $mechanic)
    {
        $mechanic->delete();

        return redirect()->route('admin.mechanics.index');
    }
}

