<?php

namespace App\DataTables;

use App\Models\OrderTemplate;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderTemplatesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $datatable = datatables()
            ->eloquent($query)
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

        if ($this->listType == "user")
        {
            $datatable->addColumn('action', 'ordertemplates.action-for-user');
        }
        else
        {
            $datatable->addColumn('action', 'ordertemplates.action');
        }
        return $datatable;
    }


    /**
     * Get query source of dataTable.
     *
     */
    public function query(OrderTemplate $model): Builder
    {

        $builder =  $model->newQuery();
        if ($this->manager)
            $builder->join('brands','brands.id','=','order_templates.brand_id')->where('brands.manager_id',$this->manager->id);
        if ($this->client_id)
            $builder->join('order_template_contents','order_template_contents.ordertemplate_id','=','order_templates.id')
                ->join('orders','order_template_contents.id','=','orders.ordertemplatecontent_id')
                ->where('orders.user_id','=',$this->client_id)
                ->select('order_templates.*')->distinct();
        if ($this->status)
            $builder->where('status','=',$this->status);

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

        if (! Auth::guest() and $this->listType == "template") {
            if (Auth::user()->can('create', OrderTemplate::class)) {
                $buttons[] = [
                    'text' => 'Nouveau',
                    'action' => "function (e, dt, button, config) {
                                    window.location = '" . route('orderTemplate.create') . "';
                                }",
                    'className' => 'btn btn-success mb-2 me-2',
                ];
            }
        }

        $localRoute = route('orderTemplate.index'); //route sans marque
        $managersButtons  = [];
        if ($this->managers) {
            foreach ($this->managers as $manager) {
                $managersButtons[] = [
                    [
                        'text' => '<i class="fa fa-eye"></i> ' . $manager->name,
                        'action' => "function (e, dt, button, config) {
                                            window.location = '" . $localRoute . "' + '?from=" . $manager->id . "';
                                        }"

                    ],
                ];
            }
        }

        if ($this->listType == "template")
        {
            if ($this->manager)
            {
                $buttons[] = [
                    'text' =>'Supprimer le filtre de Gestionnaire',
                    'action' => "function (e, dt, button, config) {
                                        window.location = '". route('orderTemplate.allOrderTemplates')."';
                                    }",
                    'className' => 'btn btn-info mb-2 me-2',
                ];
            }
            else
            {
                $buttons[] = [
                    "extend"=> 'collection',
                    "text"=> 'Filtrer par Gestionnaire',
                    'className' => 'btn btn-info mb-2 me-2',
                    "buttons" =>
                        [
                            $managersButtons
                        ]
                ];
            }
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

        // Paramètres optionnels à transmettre à la view
        $custom_paramaters = [];
        $custom_paramaters['basis_route'] = $localRoute;
        if ($this->manager)
            $custom_paramaters['manager_name'] = $this->manager->name;
        else
            $custom_paramaters['manager_name'] = "";
        if ($this->client_id)
        {
            $client_name = User::find($this->client_id)->name;
            $custom_paramaters['client_name'] = $client_name;
        }
        else
            $custom_paramaters['client_name'] = "";
        if ($this->status)
            $custom_paramaters['status_name'] = $this->status;
        else
            $custom_paramaters['status_name'] = "";


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
                'custom_paramaters' => $custom_paramaters

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

            Column::make('id')->title('Ref'),
            Column::make('brand.name')->title('Laboratoire'),
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
