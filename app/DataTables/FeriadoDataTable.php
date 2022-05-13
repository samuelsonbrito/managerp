<?php

namespace App\DataTables;

use App\Models\Feriado;
use Yajra\DataTables\Services\DataTable;
use App\Models\Unidade;

class FeriadoDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Feriado $feriado) {

                $rota_destroy = route('feriado.destroy', $feriado->id);
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
                                
                                            
                            
                                <form id=\"form-$feriado->id\" action=\"$rota_destroy\" method=\"post\">
                                    <input type=\"hidden\" name=\"_method\" value=\"delete\">
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($feriado->id)\" id=\"teste$feriado->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-user-times\"></i> Excluir</button>
                                </form>
                       
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Feriado $model)
    {
        $model = $model->newQuery()
            ->get();
        $unidade = collect($model)->map(function ($item){
            $item['data'] = bdToBr($item['data']);
            $item['repetir_anualmente'] = $item['repetir_anualmente'] == '1' ? 'SIM' : 'NÃO';
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
            'descricao' => ['title' => 'NOME'],
            'data' => ['title' => 'DATA'],
            'tipo' => ['title' => 'TIPO'],
            'repetir_anualmente' => ['title' => 'REPETIR ANUALMENTE'],

        ];
    }

    protected function filename()
    {
        return ' Cargos ' . date(' YmdHis');
    }
}