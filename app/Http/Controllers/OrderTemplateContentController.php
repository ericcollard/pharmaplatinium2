<?php

namespace App\Http\Controllers;

use App\Models\OrderTemplate;
use App\Models\OrderTemplateContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class OrderTemplateContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(OrderTemplate $orderTemplate)
    {
        $action = URL::route('orderTemplateContent.store');
        $method = 'POST';
        $orderTemplateContent = new OrderTemplateContent();
        $orderTemplateContent->ordertemplate_id = $orderTemplate->id;
        $orderTemplateContent->discount = $orderTemplate->brand->discount;
        return view('ordertemplatecontents.edit', compact('action','orderTemplateContent', 'method'));
    }

    /**
     * Show the form for insertiong a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(OrderTemplateContent $orderTemplateContent)
    {

        // insert new item juste
        $action = URL::route('orderTemplateContent.store');
        $method = 'POST';
        $newOrderTemplateContent = new OrderTemplateContent();
        $newOrderTemplateContent->ordertemplate_id = $orderTemplateContent->orderTemplate->id;
        $newOrderTemplateContent->discount = $orderTemplateContent->orderTemplate->brand->discount;
        $insert_before = $orderTemplateContent->id;

        return view('ordertemplatecontents.edit',
            [
                'action' => $action,
                'orderTemplateContent' => $newOrderTemplateContent,
                'method' => $method,
                'insert_before' => $insert_before
                ]
        );
    }


    /**
     * Duplicate a resource
     *
     * @return \Illuminate\Http\Response
     */
    public function duplicate(OrderTemplateContent $orderTemplateContent)
    {
        $newOrderTemplateContent =$orderTemplateContent->duplicate();

        return redirect($orderTemplateContent->orderTemplate->path())->with( ['message' => 'Ligne dupliquée', 'alert' => 'success']);
    }

    /**
     * Move a resource
     *
     * @return \Illuminate\Http\Response
     */
    public function moveup(OrderTemplateContent $orderTemplateContent)
    {
        // modifier le champ order
        $current_sort_value = $orderTemplateContent->sort;
        // dd($current_sort_value);
        $previous_item = OrderTemplateContent::where('ordertemplate_id','=',$orderTemplateContent->orderTemplate->id)
            ->where('sort','<',$current_sort_value)
            ->orderby('sort','desc')
            ->firstOrFail();

        $orderTemplateContent->sort = $previous_item->sort;
        $orderTemplateContent->save();
        $previous_item->sort = $current_sort_value;
        $previous_item->save();

        return redirect($orderTemplateContent->orderTemplate->path())->with( ['message' => 'Ligne déplacée vers le haut', 'alert' => 'success']);
    }

    /**
     * Move a resource
     *
     * @return \Illuminate\Http\Response
     */
    public function movedown(OrderTemplateContent $orderTemplateContent)
    {
        // modifier le champ order
        $current_sort_value = $orderTemplateContent->sort;
        // dd($current_sort_value);
        $next_item = OrderTemplateContent::where('ordertemplate_id','=',$orderTemplateContent->orderTemplate->id)
            ->where('sort','>',$current_sort_value)
            ->orderby('sort','asc')
            ->firstOrFail();

        $orderTemplateContent->sort = $next_item->sort;
        $orderTemplateContent->save();
        $next_item->sort = $current_sort_value;
        $next_item->save();

        return redirect($orderTemplateContent->orderTemplate->path())->with( ['message' => 'Ligne déplacée vers le bas', 'alert' => 'success']);
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
                'ean' =>'required',
                'name' =>  'required',
                'price' =>  'required|numeric',
                'discount' => 'required|numeric|between:0,0.999',
                'step_price' => 'nullable|numeric',
                'step_value' => 'nullable|numeric',
                'package_qty' =>  'required|numeric',
            ]
        );


        try {

            $data = $request->all();

            if(!array_key_exists('demi_package', $data))
            {
                $data['demi_package'] = 0;
            }
            if(!array_key_exists('free', $data))
            {
                $data['free'] = 0;
            }
            if(!array_key_exists('multi_delivery', $data))
            {
                $data['multi_delivery'] = 0;
            }

            // gestion de l'ordre des lignes de la commande
            if(array_key_exists('insert_before', $data))
            {
                // insérer = décaler les autres =
                // = aumgenter de 1 le rang du insert_before et de tous les suivants
                // - donner au nouveau le rang du insert_before
                //
                // update order_template_contents set sort = sort + 1 where ordertemplate_id = XXX and sort >= $sort_insert_before

                $sort_insert_before = OrderTemplateContent::find($data['insert_before'])->sort;

                DB::statement(
                    'update order_template_contents set sort = sort + 1 where ordertemplate_id = :id and sort >= :sort',
                    ['id' => $data['ordertemplate_id'],
                       'sort' =>  $sort_insert_before ]
                );
                $data['sort'] = $sort_insert_before;
            }
            else
            {
                // ajouter à la fin = donner un montant Max + 1 à sort
                $max = 0;
                $max = OrderTemplateContent::where('ordertemplate_id','=',$data['ordertemplate_id'])->max('sort');
                $data['sort'] = $max+1;
            }

            $orderTemplateContent = OrderTemplateContent::create($data);



        } catch (\Exception $e) {
            // catch exception when trying to insert invalid reply (spam or missing data)
            abort(403, "Impossible de créer cette nouvelle ligne de commande");
        }

        return redirect($orderTemplateContent->orderTemplate->path())->with( ['message' => 'Ligne créé', 'alert' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderTemplateContent  $orderTemplateContent
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTemplateContent $orderTemplateContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderTemplateContent  $orderTemplateContent
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderTemplateContent $orderTemplateContent)
    {
        $action = URL::route('orderTemplateContent.update',['orderTemplateContent' => $orderTemplateContent]);
        $method = 'PATCH';

        return view('ordertemplatecontents.edit', compact('action', 'method','orderTemplateContent'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderTemplateContent  $orderTemplateContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderTemplateContent $orderTemplateContent)
    {
        $this->validate(request(), [
                'ean' =>'required',
                'name' =>  'required',
                'price' =>  'required|numeric',
                'discount' => 'required|numeric|between:0,0.999',
                'step_price' => 'nullable|numeric',
                'step_value' => 'nullable|numeric',
                'package_qty' =>  'required|numeric',
            ]
        );
        $data = request()->all();

        if(!array_key_exists('demi_package', $data))
        {
            $data['demi_package'] = 0;
        }
        if(!array_key_exists('free', $data))
        {
            $data['free'] = 0;
        }
        if(!array_key_exists('multi_delivery', $data))
        {
            $data['multi_delivery'] = 0;
        }

        $orderTemplateContent->update($data);
        return redirect($orderTemplateContent->orderTemplate->path())->with( ['message' => 'Ligne créé', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderTemplateContent  $orderTemplateContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderTemplateContent $orderTemplateContent)
    {
        $orderTemplateContent->delete();
        return redirect($orderTemplateContent->orderTemplate->path())->with( ['message' => 'Ligne supprimée', 'alert' => 'success']);
    }
}
