@extends('adminlte::page')
@section('css')
    <style>
        .select2-container .select2-search,
        .select2-container .select2-search__field {
            width: 100% !important;
        }
    </style>
@stop
@section('content_header')
    <h1>
        Controle de Acesso dos Perfís
        <small>Permissão de Acesso aos Módulos do Sistema</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Controle de Acesso</li>
    </ol>
@stop

@section('content')
    <div id="app">

        @if (session('msg'))
            <confirm
                    title="{{ session('titulo') }}"
                    text="{{ session('msg') }}"
                    icon="{{ session('icon') }}"
            ></confirm>
        @endif

        <box boxtipo="box-success" boxtitulo="CONTROLE DE ACESSO">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-12">
                    <a href="" data-toggle="modal" data-target="#modal-cadastrar" class="btn btn-primary"><i
                                class="fa fa-plus"></i> Adicionar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'tabela-perfis']) !!}
                    </div>
                </div>
            </div>
        </box>
        @include('admin.includes.modal-adicionar-modulos-perfil')
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>

    {!! $dataTable->scripts() !!}
    <script>
        function confirmacaoExcluir(id) {
            event.preventDefault();
            swal({
                title: "Excluir!",
                text: "Você tem certeza que deseja excluir?",
                icon: "warning",
                buttons: ["Cancelar", "Excluir"],
                dangerMode: true,
            }).then((response) => {
                if (response) {
                    document.getElementById("form-" + id).submit();
                }
            });

        }
    </script>
    <script>
        $('#modal-cadastrar').on('show.bs.modal', function (event){
            $('#perfil').select2({
                placeholder: "SELECIONE O PERFIL",
                width: '100%',
            });
            // $('#cliente_contrato').select2({
            //     placeholder:"SELECIONE UM CLIENTE",
            //     width:'100%',
            // });
            //
            // $('#data_inicial').datepicker({
            //     format: 'dd/mm/yyyy',
            //     language:'pt-BR',
            //     startDate: '-5d'
            // });
            // $('#data_final').datepicker({
            //     format: 'dd/mm/yyyy',
            //     language:'pt-BR',
            //     startDate: '-1d'
            // });
            // $('#data_assinatura').datepicker({
            //     format: 'dd/mm/yyyy',
            //     language:'pt-BR',
            //     startDate: '-5d'
            // });
            //
            // $(document).ready(function(){
            //     $('#valor').maskMoney({
            //         showSymbol:true,
            //         symbol:"R$",
            //         decimal:",",
            //         thousands:"."});
            // });


            unidades_ids = {{@$dados['contrato']->unidades ? @$dados['contrato']->unidades->pluck('id') : null}}
            console.log(typeof unidades_ids)
            if (typeof unidades_ids === undefined) {
                $('#modulos').select2({
                    placeholder: function(){
                        $(this).data('placeholder');
                    },
                    multiple: true,
                    width:'100%',
                });
            } else {
                $('#modulos').select2({
                    placeholder: function(){
                        $(this).data('placeholder');
                    },
                    multiple: true,
                    width:'100%',
                }).val(unidades_ids).trigger("change");
            }




        });

    </script>

@stop

