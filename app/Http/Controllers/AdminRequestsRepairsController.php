<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
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

    public function document(\App\Models\Request $request) {
        $requestServices = Service::whereHas('requests', function ($q) use ($request) {
            $q->where('request_id', '=', $request->id);
        })->get();

        $sumToPay = 0;

        foreach ($requestServices as $requestService) {
            $sumToPay += $requestService->price;
        }
        $f = new \NumberFormatter('ru_RU', NumberFormatter::SPELLOUT);

        $totalSumInText = $f->format($sumToPay);

        $month = Carbon::parse($request->updated_at)->translatedFormat('F');
        if ($month === 'март' || $month === 'август')
            $month .= 'а';
        else $month = Str::limit($month, Str::length($month)-1, 'я');

        $arr = $request->services()->get()->toArray();

        $clientInitials = explode(" ", $request->user->name);
        $clientInitials[1] = Str::limit($clientInitials[1], 1, '.');
        $clientInitials[2] = Str::limit($clientInitials[2], 1, '.');
        $clientInitials = implode(" ", $clientInitials);

        $tableDoc = new PhpWord();
        $section = $tableDoc->addSection();
        $table = $section->addTable(array('borderSize' => 12, 'borderColor' => 'black', 'width' => 10000, 'unit' => TblWidth::TWIP));

        $index = 0;

        $table->addRow();
        $table->addCell(300)->addText('№', array('bold' => true));
        $table->addCell(2800)->addText('Наименование робот, услуг', array('bold' => true));
        $table->addCell(400)->addText('Цена', array('bold' => true));
        $table->addCell(400)->addText('НДС', array('bold' => true));
        $table->addCell(400)->addText('Сумма с НДС', array('bold' => true));
        foreach ($requestServices as $requestService) {
            $index++;
            $table->addRow();
            $table->addCell(300)->addText($index);
            $table->addCell(1800)->addText($requestService->name);
            $table->addCell(400)->addText(($requestService->price * 0.8));
            $table->addCell(400)->addText(($requestService->price * 0.2));
            $table->addCell(400)->addText($requestService->price);
        }

        $templateProcessor = new TemplateProcessor('word-template/document.docx');
        $templateProcessor->setValue('id', $request->id);
        $templateProcessor->setValue('day', Carbon::parse($request->updated_at)->day);
        $templateProcessor->setValue('month', $month);
        $templateProcessor->setValue('year', Carbon::parse($request->updated_at)->year);
        $templateProcessor->setValue('client', $request->user->name);
        $templateProcessor->setValue('clientInitials', $clientInitials);
        $templateProcessor->setValue('totalSum', $sumToPay);
        $templateProcessor->setValue('totalSumInText', $totalSumInText);
        $templateProcessor->setValue('totalNDS', ($sumToPay*0.2));
        $templateProcessor->setComplexBlock('table', $table);
        $filename = 'Акт №' . (string)$request->id;
        $templateProcessor->saveAs($filename . '.docx');
        return response()->download($filename . '.docx')->deleteFileAfterSend();
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

