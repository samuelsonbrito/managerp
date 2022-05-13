<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use Symfony\Component\Routing\Annotation\Route;
use App\Models\Colaborador;

class ColaboradorDashboardDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query);
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
        if(\Route::getCurrentRoute()->getName() == 'alerta.ferias.colaboradores'){
            return [
                'nome' => ['title' => 'NOME'],
                'cargo_descricao' => ['title' => 'CARGO'],
                'data_admissao' => ['title' => 'DATA DA ADMISSÃO'],
            ];
        } else {
            return [
                //'action' => ['orderable' => false, 'searchable' => false, 'title' => 'AÇÕES', 'width' => '7%'],
                'nome_colaborador' => ['title' => 'NOME'],
                'numero_conselho' => ['title' => 'NÚMERO DO CONSELHO'],
                'nome' => ['title' => 'NOME DO CONSELHO'],
                'data_validade' => ['title' => ' VENCIMENTO'],
                // 'rg' => ['title' => 'RG'],
                //   'nome_conselho' => ['title' => 'CONSELHO PROFISSIONAL'],
                //  'grau_instrucao' => ['title' => 'GRAU DE INSTRUÇÃO'],
                //  'estado_civil' => ['title' => 'ESTADO CIVIL']
            ];
        }

    }

    protected function filename()
    {
        return ' ColaboradoresConselhos_ ' . date(' YmdHis');
    }
}