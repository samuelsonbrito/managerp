<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\Setor;

class SetorDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Setor $setor) {
                $rota_colaboradores = route('setor.colaboradores', $setor->id);
                $rota_destroy = route('setor.destroy', $setor->id);
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
                             <a href=\"$rota_colaboradores\"  id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-plus-square-o\"></i> Gerenciar Colaboradores</button>
                                </a>          
                                       <li class=\"divider\"></li>         
                                 <button href=\"\" data-toggle=\"modal\" class=\"btn btn-xs grupo\" data-target=\"#modal-edit\" data-id=\"$setor->id\" data-nome=\"$setor->nome\" data-unidade=\"$setor->unidade_id\" data-insalubridade=\"$setor->insalubridade\"><i class=\"fa fa-edit\"></i> Editar</button>                              
                                <li class=\"divider\"></li>                             
                            
                                <form id=\"form-$setor->id\" action=\"$rota_destroy\" method=\"post\">
                                    <input type=\"hidden\" name=\"_method\" value=\"delete\">
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($setor->id)\" id=\"teste$setor->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-user-times\"></i> Excluir</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Setor $model)
    {
        $model = $model->newQuery()
            ->leftJoin('unidades', 'unidades.id', '=', 'setores.unidade_id')
            ->select('setores.*', 'unidades.nome as nome_unidade')
            ->get();
        $unidade = collect($model)->map(function ($item){
            $item['data_criacao'] = createdbdToBr($item['updated_at']);
            return $item;
        });

        return $unidade;
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
            'nome' => ['title' => 'NOME', 'width' => '30%'],
            'nome_unidade' => ['title' => 'UNIDADE', 'width' => '30%'],
            'insalubridade' => ['title' => 'INSALUBRIDADE', 'width' => '5%'],
            'data_criacao' => ['title' => 'DATA DE CADASTRO', 'width' => '20%'],
        ];
    }

    protected function filename()
    {
        return 'Setores' . date(' YmdHis');
    }
}