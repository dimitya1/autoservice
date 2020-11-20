<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\Tool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

final class AdminRequestsRepairsController
{
    public function index()
    {
        $requests = \App\Models\Request::with('user')->with('car')->with('repairs')->with('services')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin-requests', ['requests' => $requests]);
    }

    public function create()
    {
        return view('admin-tools-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name2' => 'required|min:3|max:75',
                'description' => 'max:280',
                'quantity' => 'max:4',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('admin.tools.create')
                ->withErrors($validator->errors());
        }

        $toolDataArray = request()->all();

        $tool = new Tool();
        $tool->name = $toolDataArray['name2'];
        $tool->description = $toolDataArray['description'];
        $tool->quantity = (int)$toolDataArray['quantity'] ?? 1;
        $tool->save();
        return redirect()
            ->route('admin.tools.index')
            ->with('successful tool create', 'Вы успешно добавили новую позицию!');
    }

    public function edit(Repair $repair)
    {
        return view('admin-finish-repair', ['repair' => $repair]);
    }

    public function update(Request $request, Repair $repair)
    {
        $repair->status = 1;
        if (request()->get('result')) {
            $repair->result = request()->get('result');
        }
        $repair->save();
        $statusFlag = false;
        foreach ($repair->request->repairs as $repair) {
            if ($repair->status === 0) {
                $statusFlag = true;
            }
        }
        if ($statusFlag) {
            return redirect()
                ->route('admin.requests.index')->with('successful repair finish', 'Работа закрыта, данные обновлены!');
        } else {
            $repair->request->status = 1;
            $repair->request->save();
            return redirect()
                ->route('admin.requests.index')->with('successful request finish', 'Заявка полностью закрыта, данные обновлены!');
        }
    }
}

