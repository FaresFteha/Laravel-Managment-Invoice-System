<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function selectionAuth(){
        return view('auth.selection');
     }

    public function index()
    {

        $count_all = Payment::count();
        $count_invoices1 = Payment::where('status', 'مدفوع')->count();
        $count_invoices2 = Payment::where('status', 'غير مدفوعة')->count();
        $count_invoices3 = Payment::where('status', 'مدفوع جزئياً')->count();

        if ($count_invoices2 == 0) {
            $nspainvoices2 = 0;
        } else {
            $nspainvoices2 = $count_invoices2 / $count_all * 100;
        }

        if ($count_invoices1 == 0) {
            $nspainvoices1 = 0;
        } else {
            $nspainvoices1 = $count_invoices1 / $count_all * 100;
        }

        if ($count_invoices3 == 0) {
            $nspainvoices3 = 0;
        } else {
            $nspainvoices3 = $count_invoices3 / $count_all * 100;
        }


        $chartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'hoverBackgroundColor' => ['#FF6384', '#8aa354', '#ffa860'],
                    'data' => [$nspainvoices2, $nspainvoices1, $nspainvoices3]
                ]
            ])
            ->options([]);


        $bar_chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 300, 'height' => 200])
            ->labels(["نسبة الفواتير"])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$nspainvoices2]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$nspainvoices1]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$nspainvoices3]
                ],
            ])
            ->options([]);

        return view('page.backend.index', compact('chartjs', 'bar_chartjs'));
    }

    public  function showseeting()
    {
        $collection = \App\Models\Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('layouts.backend.master', $setting);
    }
}
