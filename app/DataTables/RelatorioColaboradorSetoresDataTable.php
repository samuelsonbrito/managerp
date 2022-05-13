<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use Symfony\Component\Routing\Annotation\Route;
use App\Models\Colaborador;

class RelatorioColaboradorSetoresDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Colaborador $colaborador) {

                $rota_relatorio = route('imprimir.relatorio.colaborador.setores', $colaborador->id);

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
                       
                                              
                                <a href=\"$rota_relatorio\"  id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-file-text-o\"></i> Gerar Relatório</button>
                                </a>
                             
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    public function query(Colaborador $model)
    {
        $model = $model->newQuery()
            ->leftJoin('documentos', 'documentos.colaborador_id', '=', 'colaboradores.id')
            ->leftJoin('colaboradores_conselhos_profissionais as ccp', 'ccp.colaborador_id', '=', 'colaboradores.id')
            ->leftJoin('conselhos_profissionais as cp', 'cp.id', '=', 'ccp.conselho_id')
            ->select('colaboradores.*', 'documentos.cpf as cpf', 'documentos.rg as rg', 'cp.nome as nome_conselho')->get();

        $model = collect($model)->map(function ($item) {
            $item['cpf'] = formatarCnpjCpf($item['cpf']);
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
            'cpf' => ['title' => 'CPF'],
            'rg' => ['title' => 'RG'],
            'nome_conselho' => ['title' => 'CONSELHO PROFISSIONAL'],
        ];
    }

    protected function filename()
    {
        return ' Colaboradores_ ' . date(' YmdHis');
    }
}