<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

final class AdminToolsController
{
    public function index()
    {
        return view('admin-tools', ['tools' => Tool::orderBy('updated_at', 'desc')->get()]);
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

    public function show(Tool $tool)
    {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $totalUsedQuantityLastMonth = DB::table('tools')
            ->where('tools.id', '=', $tool->id)
            ->whereBetween('repair_tool.updated_at', [$startOfLastMonth, $endOfLastMonth])
            ->join('repair_tool', 'tools.id', '=', 'tool_id')
            ->join('repairs', 'repair_tool.repair_id', '=', 'repairs.id')->sum('repair_tool.used_quantity');

        $totalUsedQuantityThisMonth = DB::table('tools')
            ->where('tools.id', '=', $tool->id)
            ->whereBetween('repair_tool.updated_at', [$startOfMonth, $endOfMonth])
            ->join('repair_tool', 'tools.id', '=', 'tool_id')
            ->join('repairs', 'repair_tool.repair_id', '=', 'repairs.id')->sum('repair_tool.used_quantity');
//        foreach ($tool->repairs as $toolRepair) {
//            var_dump('1');
//            $totalUsedQuantity = $totalUsedQuantity + $toolRepair->pivot->used_quantity;
//        }
//        var_dump($totalUsedQuantity);
        return view('admin-one_tool', ['tool' => $tool,
            'totalUsedQuantityThisMonth' => $totalUsedQuantityThisMonth,
            'totalUsedQuantityLastMonth' => $totalUsedQuantityLastMonth
        ]);
    }

    public function destroy(Tool $tool)
    {
        $tool->delete();

        return redirect()->route('admin.tools.index')
            ->with('successful tool delete', 'Вы успешно удалили позицию!');
    }

    public function edit(Tool $tool)
    {
        return view('admin-edit-tool', ['tool' => $tool]);
    }

    public function update(Request $request, Tool $tool)
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
            return redirect()->route('admin.tools.edit', ['tool' => $tool])
                ->withErrors($validator->errors());
        }

        $tool->name = request()->get('name2');
        $tool->description = request()->get('description');
        $tool->quantity = (int)request()->get('quantity') ?? 1;
        $tool->save();

        return redirect()
            ->route('admin.tools.index')->with('successful tool update', 'Данные успешно обновлены!');
    }
}

