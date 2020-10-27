<?php

namespace App\Http\Controllers;

use App\Models\Worklist;
use Illuminate\Support\Facades\DB;

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
}

