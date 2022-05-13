<?php

namespace App\DataTables;

use App\Models\Dependente;
use Yajra\DataTables\Services\DataTable;

class DependentesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Dependente $dependente) {
                $rota = route('colaborador.excluir.dependente', $dependente->id);
                $token = csrf_token();
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
                                <button href=\"\" data-toggle=\"modal\" class=\"btn btn-xs grupo\" data-target=\"#modal-edit\" data-id=\"$dependente->id\" data-nome=\"$dependente->nome\" data-cpf=\"$dependente->cpf\" data-data=\"$dependente->data_nascimento\"><i class=\"fa fa-edit\"></i> Editar</button>
                                <li class=\"divider\"></li>                                             
                                <form id=\"form-$dependente->id\" action=\"$rota\" method=\"post\">
                                    <input type=\"hidden\" name=\"_method\" value=\"delete\">
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($dependente->id)\" id=\"teste$dependente->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-user-times\"></i> Excluir</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Dependente $model)
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