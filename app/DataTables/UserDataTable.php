<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query results from query() method
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (User $user) {
                return "<div class=\"input-group-btn\">
                  <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">Ações
                    <span class=\"fa fa-caret-down\"></span></button>
                  <ul class=\"dropdown-menu\">
                    <li><a href=\"#\"><i class='fa fa-check-square-o'></i>Visulizar Checklist</a></li>
                     <li class=\"divider\"></li>
                    <li><a href=\"#\"><i class='fa fa-file-text-o'></i>Visulizar Formulário</a></li>

                     <li class=\"divider\"></li>
                    <li><a href=\"#\"><i class='fa fa-edit'></i>Editar</a></li>
                    <li class=\"divider\"></li>
                    <li><a href=\"#\"><i class='fa fa-user-times'></i>Excluir</a></li>
                  </ul>
                </div>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->select();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
        //->addAction(['title' => 'AÇÕES', 'width' => '8% '])
            ->minifiedAjax()
            ->parameters([
                'language' => [
                    'lengthMenu' => 'Exibir _MENU_ registros por página',
                    'info' => 'Mostrando de _START_ até _END_ de _TOTAL_ registros',
                    'infoEmpty' => 'Mostrando 0 até 0 de 0 registros',
                    'emptyTable' => 'Mostrando 0 até 0 de 0 registros',
                    'infoFiltered' => '(Filtrados de _MAX_ registros)',
                    'zeroRecords' => 'Nenhum registro encontrado',
                    'search' => '<i class="fa fa-search"></i>',
                    'paginate' => [
                        'previous' => 'Anterior',
                        'next' => 'Próxima',
                        'last' => 'Último',
                        'first' => 'Primeiro',
                    ],
                    'sProcessing' => 'Processando...',
                ],
                'order' => [[1, 'asc']]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'action' => ['orderable' => false, 'searchable' => false, 'title' => 'AÇÕES', 'width' => '7%'],
            'name' => ['title' => 'NOME'],
            'email' => ['title' => 'EMAIL'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}