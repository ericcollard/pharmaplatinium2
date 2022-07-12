<?php

namespace App\Http\Controllers;

use App\DataTables\OrderTemplatesDataTable;
use App\Models\OrderTemplate;
use App\Models\OrderTemplateContent;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderTemplatesDataTable $dataTable) // list of order templates
    {
        $listType = "template";
        $dataTable->with('listType', $listType); // pour utiliser le même datatable en 2 versions (template ou user)


        $manager = "";
        if(array_key_exists('from', request()->all()))
        {
            $manager_id = request()->from;
            $managerUser = User::where('id', $manager_id)
                ->firstOrFail();
            $dataTable->with('manager', $managerUser);
        }


        $managers = User::whereHas('brands')->get();
        $dataTable->with('managers', $managers);
        return $dataTable->render('ordertemplates.index');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
                $orders_array[] = ['order_id' => $order_id,  'colisage' => $colisage, 'ean'  => $ean, 'qty' => $item];
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderTemplate $orderTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderTemplate  $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy_for_user(OrderTemplate $orderTemplate)
    {
        //
    }


}
