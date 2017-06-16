<?php

namespace App\Http\Controllers;

use App\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class CollectStatController extends Controller
{
    /**
     * Вывод статистики посещений страниц сайта из базы.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statistics = Statistic::all();
        $statistic = Statistic::find(237);

        // Ось X для графика
        $name = array_keys(json_decode($statistic->info, true));

        // Ось Y для графика
        $num = array_values(json_decode($statistic->info, true));

        JavaScriptFacade::put([
            'name' => $name,
            'num' => $num
        ]);

        return view('stat', compact(['statistics']));
    }
}
