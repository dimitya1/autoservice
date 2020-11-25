<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\Service;
use App\Models\Tool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use NumberFormatter;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;

final class AdminProfitController
{
    public function index()
    {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $profitThisMonth = Repair::where('status', 1)->whereBetween('updated_at', [$startOfMonth, $endOfMonth])->sum('payment');
        $profitLastMonth = Repair::where('status', 1)->whereBetween('updated_at', [$startOfLastMonth, $endOfLastMonth])->sum('payment');

        $repairsCountThisMonth = Repair::where('status', 1)->whereBetween('updated_at', [$startOfMonth, $endOfMonth])->count('payment');
        $repairsCountLastMonth = Repair::where('status', 1)->whereBetween('updated_at', [$startOfLastMonth, $endOfLastMonth])->count('payment');

        $popularServicesThisMonth = DB::select("select s.name from services s
            join (select * from repairs where repairs.updated_at BETWEEN '$startOfMonth' AND '$endOfMonth' and repairs.status=1) r
                on s.id = r.service_id group by s.name
                    having COUNT(s.name) >= all(select count(repairs.service_id) from repairs
                        where repairs.updated_at BETWEEN '$startOfMonth' AND '$endOfMonth' and repairs.status=1 group by repairs.service_id)");

        $popularServicesLastMonth = DB::select("select s.name from services s
            join (select * from repairs where repairs.updated_at BETWEEN '$startOfLastMonth' AND '$endOfLastMonth' and repairs.status=1) r
                on s.id = r.service_id group by s.name
                    having COUNT(s.name) >= all(select count(repairs.service_id) from repairs
                        where repairs.updated_at BETWEEN '$startOfMonth' AND '$endOfMonth' and repairs.status=1 group by repairs.service_id)");

        return view('admin-profit', ['profitThisMonth' => $profitThisMonth, 'profitLastMonth' => $profitLastMonth,
            'repairsCountThisMonth' => $repairsCountThisMonth, 'repairsCountLastMonth' => $repairsCountLastMonth,
            'popularServicesThisMonth' => $popularServicesThisMonth, 'popularServicesLastMonth' => $popularServicesLastMonth]);
    }
}

