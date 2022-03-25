<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'users.action',1)
            ->editColumn('created_at', function ($request) {
                return $request->created_at->formatLocalized('%c'); //'%d %B %Y %H:%M'
            })
            ->editColumn('updated_at', function ($request) {
                return $request->created_at->formatLocalized('%c');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return Builder
     */
    public function query(User $model): Builder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->parameters([
                        'language' => [
                            'url' => url('/vendor/datatables/lang/'.config('locale.languages')[session ('locale')][1].'.json'),//<--here
                        ],
                        'buttons' => [
                            [
                                'extend' => 'reload',
                                'text' => 'Rafraichir',
                                'className' => 'btn btn-success mb-2 me-2',
                            ],
                            [
                                'extend' => 'print',
                                'text' => 'Imprimer',
                                'className' => 'btn btn-warning mb-2 me-2',
                            ],
                            [
                                'extend' => 'export',
                                'text' => 'Exporter',
                                'className' => 'btn btn-warning mb-2 me-2',
                            ],
                        ],

                        ])
        ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title(__('Name')),
            Column::make('email')->title(__('Email')),
            Column::make('created_at')->title(__('Created at')),
            Column::make('updated_at')->title(__('Updated at')),
            Column::computed('action')->title(__('Action'))
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
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
