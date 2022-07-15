<?php

namespace App\Http\Controllers;

use App\DataTables\BrandsDataTable;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class BrandController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Brand::class, 'brand');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BrandsDataTable $dataTable)
    {
        return $dataTable->render('brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        $action = URL::route('brand.store');
        $method = 'POST';

        $users = User::all();

        $brand = new Brand();
        return view('brands.edit', compact('action','brand', 'method','users'));
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
                'name' =>  'required',
                'discount' =>  'required|numeric|between:0.0,0.99',
            ]
        );

        try {

            $data = $request->all();
            $brand = Brand::create($data);

        } catch (\Exception $e) {
            // catch exception when trying to insert invalid reply (spam or missing data)
            abort(403, "Impossible de créer ce nouveau laboratoire");
        }

        return redirect($brand->path())->with( ['message' => 'Laboratoire créé', 'alert' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brands.show', ['brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $action = URL::route('brand.update',['brand' => $brand]);
        $method = 'PATCH';
        $users = User::all();

        return view('brands.edit', compact('action', 'method','brand','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate(request(), [
                'name' =>  'required',
                'discount' =>  'required|numeric|between:0.0,0.99',
            ]
        );

        $data = request()->all();

        $brand->update($data);

        return redirect(route('brand.show',['brand' => $brand]))->with( ['message' => 'Fiche laboratoire mise à jour', 'alert' => 'success']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect(route('brand.list'))->with( ['message' => 'Fiche laboratoire supprimée', 'alert' => 'success']);
    }
}
