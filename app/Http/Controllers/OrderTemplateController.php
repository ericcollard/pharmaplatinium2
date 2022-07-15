<?php

namespace App\Http\Controllers;

use App\DataTables\OrderTemplatesDataTable;
use App\Models\Brand;
use App\Models\OrderTemplate;
use App\Models\OrderTemplateContent;
use App\Models\Order;
use App\Models\User;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class OrderTemplateController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(OrderTemplate::class, 'orderTemplate');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderTemplatesDataTable $dataTable)
    {
        if (array_key_exists('from', request()->all()))
        {
            $manager_id = request()->from;
            return $this->listOfOrderTemplate($dataTable,"",$manager_id);
        }
        return $this->listOfOrderTemplate($dataTable);
    }



    public function listOfOrderTemplate(OrderTemplatesDataTable $dataTable, $status="",$manager_id="") // list of order templates
    {
        $listType = "template";
        $dataTable->with('listType', $listType); // pour utiliser le même datatable en 2 versions (template ou user)

        if ($manager_id == "")
        {
            // par défaut, on affiche les modèles du gestionnaire connecté
            if (Auth::check())
            {
                $managerUser = User::where('id', Auth::user()->id)
                    ->firstOrFail();
                $dataTable->with('manager', $managerUser);
            }
        }
        elseif ($manager_id == "all")
        {
            $dataTable->with('manager', null);
        }
        else
        {
            $managerUser = User::where('id', $manager_id)
                ->firstOrFail();
            $dataTable->with('manager', $managerUser);
        }


        if ($status == "" and array_key_exists('status', request()->all()))
        {
            $status = request()->status;
        }
        $dataTable->with('status', $status);

        $managers = User::whereHas('brands')->get();
        $dataTable->with('managers', $managers);
        return $dataTable->render('ordertemplates.index');
    }

    public function listOfDraftOrderTemplate(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrderTemplate($dataTable,"Brouillon");
    }

    public function listOfOpenedOrderTemplate(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrderTemplate($dataTable,"Ouverte");
    }
    public function listOfClosedOrderTemplate(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrderTemplate($dataTable,"Fermée");
    }
    public function listOfDeliveredOrderTemplate(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrderTemplate($dataTable,"Livrée");
    }

    public function listOfAllOrderTemplate(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrderTemplate($dataTable,"","all");
    }



    public function listOfOrder(OrderTemplatesDataTable $dataTable, $status="")
    {
        $listType = "user";
        $dataTable->with('listType', $listType); // pour utiliser le même datatable en 2 versions (template ou user)


        if ($status == "" and array_key_exists('status', request()->all()))
        {
            $status = request()->status;
        }
        $client_id = Auth::user()->id;
        $dataTable->with('client_id', $client_id);
        $dataTable->with('status', $status);

        return $dataTable->render('ordertemplates.list-for-user');
    }

    public function listOfDraftOrder(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrder($dataTable,"Brouillon");
    }

    public function listOfOpenedOrder(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrder($dataTable,"Ouverte");
    }

    public function listOfClosedOrder(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrder($dataTable,"Fermée");
    }

    public function listOfDeliveredOrder(OrderTemplatesDataTable $dataTable)
    {
        return $this->listOfOrder($dataTable,"Livrée");
    }






    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTemplate $orderTemplate)
    {

        return view('ordertemplates.show', ['orderTemplate' => $orderTemplate]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit_for_user(OrderTemplate $orderTemplate)
    {

        if (Auth()->user()->cannot('show_for_user', $orderTemplate)) {
            abort(403);
        }

        // Création des lignes de commande manquantes
        foreach ($orderTemplate->content as $orderTemplateContentItem)
        {
            $orderCnt = $orderTemplateContentItem->orders()->where('user_id',Auth::user()->id)->count();
            if ($orderCnt < 1)
            {
                $newOrder = Order::create([
                    'ordertemplatecontent_id' => $orderTemplateContentItem->id,
                    'user_id' => Auth::user()->id,
                    'qty' => 0.0
                ]);
            }
        }

        // récupération de toutes les lignes de commande
        $orders = Auth::user()->orders()
            ->select('orders.*', 'order_template_contents.*', 'orders.id as order_id')
            ->join('order_template_contents', 'order_template_contents.id', '=', 'orders.ordertemplatecontent_id')
            ->where('order_template_contents.ordertemplate_id','=',$orderTemplate->id)->get();

        return view('ordertemplates.edit-for-user', ['orderTemplate' => $orderTemplate, 'orders' => $orders]);
    }

    /**
     * Remove all lines for one user
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy_for_user(OrderTemplate $orderTemplate)
    {
        $orders = Order::where('user_id','=',auth()->user()->id)
            ->join('order_template_contents', 'order_template_contents.id', '=', 'orders.ordertemplatecontent_id')
            ->where('user_id','=',auth()->user()->id)
            ->where('order_template_contents.ordertemplate_id','=',$orderTemplate->id)
            ->delete();

        return redirect(route('order.index'))->with( ['message' => 'Commande supprimée', 'alert' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function update_for_user(Request $request, OrderTemplate $orderTemplate)
    {
        // construction du tableau de règles de validation
        $data = request()->all();
        $orders_array = [];
        $arr_validation = ['user_id' =>  'required' ];

        foreach ($data as $key => $item)
        {
            if (substr($key,0,1) == "#")
            {
                $keys = explode('/', substr($key,1),);  // order_id/package_qty/ean
                $order_id = $keys[0];
                $colisage = $keys[1];
                $ean = $keys[2];
                $demi = $keys[3];
                $orders_array[] = ['order_id' => $order_id,  'colisage' => $colisage, 'ean'  => $ean, 'qty' => $item];
                if ($demi == 1)
                    $arr_validation[$key] = 'multiple_of:'.$colisage/2;
                else
                    $arr_validation[$key] = 'multiple_of:'.$colisage;
            }
        }

        $this->validate(request(), $arr_validation
        );

        foreach ($orders_array as $key => $order_array)
        {
            $order = Order::find($order_array['order_id']);
            $order->update(['qty'=>$order_array['qty']]);
        }

        return redirect(route('order.edit',['orderTemplate' => $orderTemplate]))->with( ['message' => 'Mise à jour ok', 'alert' => 'success']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderTemplate $orderTemplate)
    {
        $action = URL::route('orderTemplate.update',['orderTemplate' => $orderTemplate]);
        $method = 'PATCH';
        $brands = Brand::all();
        return view('ordertemplates.edit', compact('action', 'method','orderTemplate','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = URL::route('orderTemplate.store');
        $method = 'POST';
        $brands = Brand::all();
        $orderTemplate = new OrderTemplate();
        $orderTemplate->franco = 1000;
        $orderTemplate->status = 'Brouillon';
        $orderTemplate->dead_line = date_add(now(),DateInterval::createFromDateString('1 month'));
        return view('ordertemplates.edit', compact('action','orderTemplate', 'method','brands'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
                'title' =>'required',
                'brand_id' =>  'required',
                'franco' => 'required|numeric',
                'dead_line' =>  'required|date',
                'status' => 'required',
                Rule::in(["Brouillon","Ouverte","Fermée"]),
            ]
        );

        try {

            $data = $request->all();
            $orderTemplate = OrderTemplate::create($data);

        } catch (\Exception $e) {
            // catch exception when trying to insert invalid reply (spam or missing data)
            abort(403, "Impossible de créer ce nouveau modèle de commande");
        }

        return redirect($orderTemplate->path())->with( ['message' => 'Modèle créé', 'alert' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderTemplate $orderTemplate)
    {
        $this->validate(request(), [
                'brand_id' =>  'required',
                'franco' => 'required|numeric',
                'dead_line' =>  'required|date',
                'status' => 'required',
                    Rule::in(["Brouillon","Ouverte","Fermée"]),
               ]
        );

        $data = request()->all();
        if(!array_key_exists('multi_deliveries', $data))
        {
            $data['multi_deliveries'] = 0;
        }

        $orderTemplate->update($data);

        return redirect(route('orderTemplate.show',['orderTemplate' => $orderTemplate]))->with( ['message' => 'Fiche mise à jour', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderTemplate $orderTemplate)
    {
        $orderTemplate->delete();
        return redirect(route('orderTemplate.list'))->with( ['message' => 'Fiche supprimée', 'alert' => 'success']);
    }

    /**
     * Duplicate the specified resource
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function duplicate(OrderTemplate $orderTemplate)
    {
        $orderTemplate->duplicate();
        return redirect(route('orderTemplate.list'))->with( ['message' => 'Commande dupliquée', 'alert' => 'success']);
    }

    /**
     * Print the specified resourceordertemplatecontent_id
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function print(OrderTemplate $orderTemplate)
    {
        return view('ordertemplates.print', compact('orderTemplate'));
    }

    public function print2(OrderTemplate $orderTemplate)
    {
        $orders = DB::table('users')
            ->join('orders','orders.user_id','=','users.id')
            ->join('order_template_contents','order_template_contents.id','=','orders.ordertemplatecontent_id')
            ->where('order_template_contents.ordertemplate_id','=', $orderTemplate->id)
            ->select('users.name as username','orders.qty','order_template_contents.name','order_template_contents.ean','order_template_contents.variant')
        ->get()->groupBy('username');

/*
        foreach($orders as $key=>$order)
        {
            foreach($order as $orderLine)
            {
                dd($orderLine->qty);
            }
            //dd($key, $order);
        }
*/


        return view('ordertemplates.print2', compact('orders','orderTemplate'));
    }
}
