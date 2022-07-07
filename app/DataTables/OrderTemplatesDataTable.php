<?php

namespace App\DataTables;

use App\Models\OrderTemplate;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderTemplatesDataTable extends DataTable
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
            ->addColumn('action', 'ordertemplates.action')
            ->editColumn('created_at', function ($request) {
                if ($request->created_at)
                    return $request->created_at->formatLocalized('%d %B %Y'); //'%d %B %Y %H:%M'  %c
                else
                    return 'Aucune';
            })
            ->editColumn('dead_line', function ($request) {
                if ($request->dead_line)
                    return $request->dead_line->formatLocalized('%d %B %Y'); //'%d %B %Y %H:%M'  %c
                else
                    return 'Aucune';
            });
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderTemplate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderTemplate $model)
    {

        $builder =  $model->newQuery();
        $builder->join('brands', 'brands.id', '=', 'order_templates.brand_id');
        $builder->select('order_templates.*','brands.name as labo');

        return $builder;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        // Boutons
        $buttons = [];

        if (Auth::user()->can('create',OrderTemplate::class)) {
            $buttons[] = [
                'text' =>'Nouveau',
                'action' => "function (e, dt, button, config) {
                                    window.location = '".route('orderTemplate.create')."';
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
            ->setTableId('ordertemplates-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(4,'desc')
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

            Column::make('id'),
            Column::make('labo','labo')->title('Laboratoire'),
            Column::make('title')->title('Titre'),
            Column::make('created_at')->title('Création'),
            Column::make('dead_line')->title('Date de cloture'),
            //Column::make('brand_id')->title('Laboratoire'),
            Column::make('status')->title('Statut'),
            Column::computed('action')->title('Action')
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
        return 'OrderTemplates_' . date('YmdHis');
    }
}
