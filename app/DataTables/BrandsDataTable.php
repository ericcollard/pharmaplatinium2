<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'brands.action')
            ->editColumn('discount', function ($request) {
                if ($request->discount)
                    return number_format($request->discount*100.0,2).' %';
                else
                    return 'nc.';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Brand $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Brand $model)
    {

        $builder =  $model->newQuery();
        $builder->join('users','users.id','=','brands.manager_id');
        $builder->select('brands.*','users.name as manager')->distinct();
        return $builder;


    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): \Yajra\DataTables\Html\Builder
    {

        // Boutons
        $buttons = [];

        if (Auth::user()->can('create',Brand::class)) {
            $buttons[] = [
                'text' =>'Nouveau',
                'action' => "function (e, dt, button, config) {
                                    window.location = '".route('brand.create')."';
                                }",
                'className' => 'btn btn-success mb-2 me-2',
            ];
        }


        $buttons[] = [
            'extend' => 'reload',
            'text' => 'Rafraichir',
            'className' => 'btn btn-warning mb-2 me-2',
        ];
        $buttons[] = [
            'extend' => 'print',
            'text' => 'Imprimer',
            'className' => 'btn btn-warning mb-2 me-2',
        ];
        $buttons[] = [
            'extend' => 'export',
            'text' => 'Exporter',
            'className' => 'btn btn-warning mb-2 me-2',
        ];



        return $this->builder()
            ->setTableId('brands-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1,'asc')
            ->parameters([
                'language' => [
                    'url' => url('/vendor/datatables/lang/'.config('locale.languages')[session ('locale')][1].'.json'),//<--here
                ],
                'buttons' => $buttons,

            ])
            ;
    }




    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('Référence'),
            Column::make('name')->title('Nom'),
            Column::make('manager')->title('Gestionnaire')->searchable(false),
            Column::make('discount')->title('Remise standard'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Brands_' . date('YmdHis');
    }
}
