<?php

namespace App\DataTables;

use App\Models\Perfil;
use App\User;
use Yajra\DataTables\Services\DataTable;

class PerfilDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Perfil $perfil) {
                $rota = route('admin.perfil.excluir-perfil', $perfil->id);
                $rota_edit = route('colaborador.edit', $perfil->id);
                $token = csrf_token();
                return "
                <style>
                    #link-grupo{
                        color: black!important;
                    }
                    .grupo {
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
                                         
                                          
                 
                     
                                <form id=\"form-$perfil->id\" action=\"$rota\" method=\"post\">                         
                                    <input type=\"hidden\" name=\"id\" value=\"$perfil->id\">
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($perfil->id)\" id=\"teste$perfil->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-minus-circle\"></i> Excluir</button>
                                </form>                             
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Perfil $model)
    {
        $model = $model->newQuery()
            ->where('descricao', '!=', 'admin')
            ->get();

        $model = collect($model)->map(function ($item) {
            $item['data_criacao'] = createdbdToBr($item['created_at']);
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
            'descricao' => ['title' => 'DESCRICAO'],
            'data_criacao' => ['title' => 'DATA'],
        ];
    }

    protected function filename()
    {
        return 'Perfis_ ' . date(' YmdHis');
    }
}