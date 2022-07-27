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
use Illuminate\Support\Facades\Auth;
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

        if (Auth::check())
        {
            $dashboard['orderCnt'] = DB::select( DB::raw("select count(distinct(order_template_contents.ordertemplate_id)) as cnt from orders
inner join order_template_contents on order_template_contents.id = orders.ordertemplatecontent_id
where user_id = ".Auth::user()->id) )[0]->cnt;
        }
        else
        {
            $dashboard['orderCnt'] = 0;
        }


        // Graphique de publication des commandes
        $chartDatas = OrderTemplate::select([
            DB::raw("DATE_FORMAT(dead_line, '%Y-%m') new_date"),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('dead_line', [Carbon::now()->subMonth(36), Carbon::now()])
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

        // graphique des valeurs de commande

        $chartDatas = DB::select( DB::raw("

        select  DATE_FORMAT(order_templates.dead_line, '%Y-%m') as  new_date, sum(tmp_table.content_value) as cumul  from

(select order_template_contents.id,
CASE
    WHEN not isnull(order_template_contents.step_price) and sum(orders.qty) >= order_template_contents.step_value THEN order_template_contents.step_price *sum(orders.qty)
    ELSE order_template_contents.price *sum(orders.qty)
END as content_value
from orders
inner join order_template_contents on orders.ordertemplatecontent_id = order_template_contents.id
group by order_template_contents.id) as tmp_table

inner join order_template_contents on tmp_table.id = order_template_contents.id
inner join order_templates on order_template_contents.ordertemplate_id = order_templates.id
group by new_date
order by new_date


        ") );


        $chartValueByMonth = array();
        foreach($chartDatas as $data) {
            $chartValueByMonth[$data->new_date] = $data->cumul;
        }
        for($i = 0; $i < 36; $i++) {
            $date = Carbon::now()->subMonth($i);
            $dateString = $date->format('Y-m');
            if(!isset($chartValueByMonth[ $dateString ]))
            {
                $chartValueByMonth[ $dateString ] = 0;
            }
        }
        ksort($chartValueByMonth);
        foreach($chartValueByMonth as $dateStr => $value)
        {
            $dashboard['chartValueByMonth']['dates'][] = $dateStr;
            $dashboard['chartValueByMonth']['values'][] = (int)$value;
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
