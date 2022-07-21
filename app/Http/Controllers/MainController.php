<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderTemplate;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function landing()
    {
        return view('landing');
    }


    /**
     * Display a view based on first route param
     *
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function home()
    {
        $dashboard['userCnt'] = User::count();
        $dashboard['brandCnt'] = Brand::count();
        $dashboard['orderTemplateCnt'] = OrderTemplate::count();
        $dashboard['orderCnt'] = DB::select( DB::raw("select count(distinct(order_template_contents.ordertemplate_id)) as cnt from orders
inner join order_template_contents on order_template_contents.id = orders.ordertemplatecontent_id
where user_id = 2") )[0]->cnt;

        // Graphique de publication des commandes
        $chartDatas = OrderTemplate::select([
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') new_date"),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('created_at', [Carbon::now()->subMonth(36), Carbon::now()])
            ->groupBy('new_date')
            ->orderBy('new_date', 'ASC')
            ->get();

        $chartDataByMonth = array();
        foreach($chartDatas as $data) {
            $chartDataByMonth[$data->new_date] = $data->count;
        }

        for($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subMonth($i);
            $dateString = $date->format('Y-m');
            if(!isset($chartDataByMonth[ $dateString ]))
            {
                $chartDataByMonth[ $dateString ] = 0;
            }
        }
        ksort($chartDataByMonth);
        foreach($chartDataByMonth as $dateStr => $value)
        {
            $dashboard['chartDataByMonth']['dates'][] = $dateStr;
            $dashboard['chartDataByMonth']['values'][] = (int)$value;
        }




        return view('index',compact('dashboard'));
    }


    /**
     * Change language
     *
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function language(String $locale): RedirectResponse
    {
        $locale = in_array($locale, config('app.locales')) ? $locale : config('app.fallback_locale');
        session(['locale' => $locale]);
        return back();
    }

}
