<?php

namespace App\DataTables;

use App\User;
use App\Models\Contrato;
use Yajra\DataTables\Services\DataTable;

class ContratosDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function (Contrato $contrato) {
                $rota = route('contratos.destroy', $contrato->id);
                $rota_anexos = route('contrato.anexos', $contrato->numero);
                $rota_edit = route('contratos.edit',$contrato->id);
                $rota_show = route('contratos.show',$contrato->id);
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
                                <a href=\"$rota_anexos\"  id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-clipboard\"></i> Anexos</button>
                                </a>                   
                                <li class=\"divider\"></li>                             
                                <a href=\"$rota_show\"  id='link-grupo'>
                                    <button class=\"btn btn-xs grupo\"><i class=\"fa fa-file-text-o\"></i> Visualizar</button>
                                </a>
                                <li class=\"divider\"></li>
                                 <form id=\"form-$contrato->id\" action=\"$rota\" method=\"post\">
                                    <input type=\"hidden\" name=\"_method\" value=\"delete\">   
                                    <input type=\"hidden\" name=\"_token\" value=\"$token\">
                                    <button onclick=\"confirmacaoExcluir($contrato->id)\" id=\"teste$contrato->id\" type=\"submit\" class=\"btn btn-xs grupo\"><i class=\"fa fa-user-times\"></i> Excluir</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contrato $model)
    {
        return $model->newQuery()->select('contratos.*')->with('cliente')->get();
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
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
                'order' => [[1, 'desc']]
            ]);
    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
          'action' => ['orderable' => false, 'searchable' => false, 'title' => 'AÇÕES', 'width' => '7%'],
          'numero'=>['title'=>'N° Contrato'],
          'cliente.nome'=>['title'=>'Cliente'],
          'data_inicial'=>['title'=>'Data Inicio'],
          'data_fim'=>['title'=>'Data Fim'],
          'data_assinatura'=>['title'=>'Data Assinatura'],
          'status'=>['title'=>'Contrato Status'],
          'valor_formatado'=>['title'=>'R$ Valor ']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Contratos_' . date('YmdHis');
    }
}
