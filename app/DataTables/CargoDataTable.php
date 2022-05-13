<?php

namespace App\DataTables;

use App\Models\Cargo;
use Yajra\DataTables\Services\DataTable;

class CargoDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Cargo $cargo) {
//                $rota_show = route('colaborador.show', $unidade->id);
                $rota_destroy = route('cargo.destroy', $cargo->id);
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
                                 <button href=\"\" data-toggle=\"modal\" class=\"btn btn-xs grupo\" data-target=\"#modal-edit\" data-id=\"$cargo->id\" data-descricao=\"$cargo->descricao\"><i class=\"fa fa-edit\"></i> Editar</button>                              
                                <li class=\"divider\"></li>                             
                            
                                <form id=\"form-$cargo->id\" action=\"$rota_destroy\" method=\"post\">
                                    <input type=\"hidden\" name=\"_method\" value=\"delete\">
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($cargo->id)\" id=\"teste$cargo->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-user-times\"></i> Excluir</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Cargo $model)
    {
        $model = $model->newQuery()
            ->select('cargos.*')->get();
        $cargo = collect($model)->map(function ($item){
            $item['data_criacao'] = createdbdToBr($item['created_at']);
            return $item;
        });

        return $cargo;
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
            'descricao' => ['title' => 'NOME', 'width' => '50%'],
            'data_criacao' => ['title' => 'DATA DE CADASTRO'],
        ];
    }

    protected function filename()
    {
        return ' Cargos ' . date(' YmdHis');
    }
}