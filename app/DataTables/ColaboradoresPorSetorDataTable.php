<?php

namespace App\DataTables;

use App\Models\Colaborador;
use Yajra\DataTables\Services\DataTable;

class ColaboradoresPorSetorDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Colaborador $colaborador) {
                $rota = route('setor.remover.colaborador', [$colaborador->id, $colaborador->setor_id]);
                return "
                <style>
                    #link-grupo{
                        color: black!important;
                    }
                    .grupo {
                        margin-left: 2px;
                        background-color: transparent !important;
                        border-color: transparent !important;
                    }
                </style>
                <div class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-warning dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">Ações
                        <span class=\"fa fa-caret-down\"></span>
                    </button>
                    <ul class=\"dropdown-menu\">
                       <li>
                            <div class=\"btn-group-vertical\" align=\"center\">
                                              
                                <a href=\"$rota\"  id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-minus-circle\"></i> Remover</button>
                                </a>
                           
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Colaborador $model)
    {
        return $this->dados;
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
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

    protected function getColumns()
    {

        return [
            'action' => ['orderable' => false, 'searchable' => false, 'title' => 'AÇÕES', 'width' => '7%'],
            'nome' => ['title' => 'NOME'],
            'cpf' => ['title' => 'CPF'],
            'data_nascimento' => ['title' => 'DATA DE NASCIMENTO'],
        ];


    }

    protected function filename()
    {
        return 'DependentesAnexos_ ' . date(' YmdHis');
    }
}