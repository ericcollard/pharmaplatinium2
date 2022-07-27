<?php

namespace App\Http\Controllers;

use App\Models\OrderTemplate;
use App\Models\OrderTemplateContent;
use Illuminate\Http\Request;
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
                'discount' => 'required|numeric',
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
                'discount' => 'required|numeric',
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
