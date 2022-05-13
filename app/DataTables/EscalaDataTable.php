<?php

namespace App\DataTables;

use App\Models\Escala;
use Yajra\DataTables\Services\DataTable;
use App\Models\Unidade;

class EscalaDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Escala $escala) {
                $rota_edit = route('escala.editar', $escala->id);
                $rota_show = route('escala.visualizar', $escala->id);
                $rota_destroy = route('escala.excluir');
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
                                                  
                                 <a href=\"$rota_edit\"  id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-edit\"></i> Editar</button>
                                </a>                             
                                <li class=\"divider\"></li>                             
                                 <a href=\"$rota_show\"  id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-file-text-o\"></i> Visualizar</button>
                                </a>       
                              <li class=\"divider\"></li>                
                                <form id=\"form-$escala->id\" action=\"$rota_destroy\" method=\"post\">                         
                                    <input type=\"hidden\" name=\"id\" value=\"$escala->id\">
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($escala->id)\" id=\"teste$escala->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-minus-circle\"></i> Excluir</button>
                                </form>
                            

                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Escala $model)
    {
        $model = $model->newQuery()
            ->leftJoin('unidades', 'unidades.id', '=', 'escalas.unidade_id')
            ->leftJoin('setores', 'setores.id', '=', 'escalas.setor_id')
            ->select('escalas.*', 'unidades.nome as nome_unidade', 'setores.nome as nome_setor')->get();
        $unidade = collect($model)->map(function ($item){
            $item['data_criacao'] = createdbdToBr($item['created_at']);
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
            'periodo' => ['title' => 'PERÍODO'],
            'nome_unidade' => ['title' => 'UNIDADE'],
            'nome_setor' => ['title' => 'SETOR'],
            'turno' => ['title' => 'TURNO'],
            'data_criacao' => ['title' => 'DATA DE CADASTRO'],
        ];
    }

    protected function filename()
    {
        return ' Cargos ' . date(' YmdHis');
    }
}