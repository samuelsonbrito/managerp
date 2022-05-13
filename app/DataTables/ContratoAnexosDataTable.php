<?php

namespace App\DataTables;

use App\Models\Anexo;
use Yajra\DataTables\Services\DataTable;
use Symfony\Component\Routing\Annotation\Route;

class ContratoAnexosDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Anexo $anexo) {
                $rota = route('contrato.excluir.anexo', $anexo->id);
//                $rota_edit = route('contrato.edit', $anexo->id);
                $rota_show = route('contrato.baixar.anexo', $anexo->id);
                $token = csrf_token();
                return "
                <style>
                    #link-grupo{
                        color: black!important;
                    }
                    .grupo {
                        margin-left: 2px;
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
                                <button href=\"\" data-toggle=\"modal\" class=\"btn btn-xs grupo\" data-target=\"#modal-edit\" data-id=\"$anexo->id\" data-nome=\"$anexo->nome\"><i class=\"fa fa-edit\"></i> Editar</button>                                                                   
                                <li class=\"divider\"></li>                             
                                <a href=\"$rota_show\" id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa  fa-download\"></i> Baixar</button>
                                </a>
                                <li class=\"divider\"></li>                                                
                                <form id=\"form-$anexo->id\" action=\"$rota\" method=\"post\">
                                    <input type=\"hidden\" name=\"_method\" value=\"delete\">   
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($anexo->id)\" id=\"teste$anexo->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-user-times\"></i> Excluir</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Anexo $model)
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
            'nome' => ['title' => 'NOME DO ANEXO'],
            'data_criacao' => ['title' => 'DATA DA CRIAÇÃO'],
        ];


    }

    protected function filename()
    {
        return 'ContratoAnexos_ ' . date(' YmdHis');
    }
}