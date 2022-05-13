<?php

namespace App\DataTables;

use App\Models\Cliente;
use Yajra\DataTables\Services\DataTable;

class ClienteDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Cliente $cliente) {
                $rota = route('cliente.destroy', $cliente->id);
                $rota_edit = route('cliente.edit', $cliente->id);
                $rota_show = route('cliente.show', $cliente->id);
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
                    
                    .dropdown-menu{
                        position: absolute!important;
                        will-change: transform!important;
                        top: -15px!important;
                        left: 0px!important;
                        transform: translate3d(-1px, -84px, 0px)!important;
                    }
                                                  
                </style>
                <div class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-warning dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">Ações
                        <span class=\"fa fa-caret-down\"></span>
                    </button>
                    <ul class=\"dropdown-menu\">    
                       <li>
                            <div class=\"btn-group-vertical\" align=\"center\">           
                                <a href=\"$rota_edit\" id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-edit\"></i> Editar</button>
                                </a>
                                <li class=\"divider\"></li>                             
                                <a href=\"$rota_show\"  id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-file-text-o\"></i> Visualizar</button>
                                </a>
                                <li class=\"divider\"></li>
                                <form id=\"form-$cliente->id\" action=\"$rota\" method=\"post\">
                                    <input type=\"hidden\" name=\"_method\" value=\"delete\">   
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($cliente->id)\" id=\"teste$cliente->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-user-times\"></i> Excluir</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Cliente $model)
    {
        $model = $model->newQuery()
            ->select('clientes.*')
            ->get();

        $model = collect($model)->map(function ($item) {
            $item['cpf_cnpj'] = formatarCnpjCpf($item['cpf_cnpj']);
            if($item['tipo_pessoa'] == 'F') {
                $item['tipo_pessoa'] = 'PESSOA FÍSICA';
            } else {
                $item['tipo_pessoa'] = 'PESSOA JURÍDICA';
            }

            return $item;
        });

        return $model;
    }

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

    protected function getColumns()
    {
        return [
            'action' => ['orderable' => false, 'searchable' => false, 'title' => 'AÇÕES', 'width' => '7%'],
            'nome' => ['title' => 'NOME'],
            'tipo_pessoa' => ['title' => 'TIPO PESSOA'],
            'cpf_cnpj' => ['title' => 'CPF/CNPJ'],
            'telefone' => ['title' => 'TELEFONE'],
            'papel' => ['title' => 'TIPO'],
        ];
    }

    protected function filename()
    {
        return ' Colaboradores_ ' . date(' YmdHis');
    }
}