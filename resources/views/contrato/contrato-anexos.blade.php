@extends('adminlte::page')
@section('css')
    <style>
        input{
            text-transform:uppercase;
        }
    </style>
@stop
@section('content_header')
    <h1>
        Gerenciamento de Contratos
        <small>Gerencie os Anexos do Contrato</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('contratos.index')}}">Contratos</a></li>
        <li class="active">Anexos</li>
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

        <box boxtipo="box-success" boxtitulo="ANEXOS DO CONTRATO N°: {{$numero_contrato}}">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-12">
                    <a href="" data-toggle="modal" data-target="#modal-cadastrar-anexo" class="btn btn-primary"><i
                                class="fa fa-plus"></i> Cadastrar Novo Anexo</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'contrato-anexos']) !!}
                    </div>
                </div>
            </div>
        </box>
        @include('contrato.includes.modal-editar-anexo')
        @include('contrato.includes.modal-cadastrar-anexo')
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('js/contrato/anexo.js') }}"></script>


    {!! $dataTable->scripts() !!}

    <script>
        $('#dependentesSelect').select2({
            placeholder: "SELECIONE O DEPENDENTE OU COLABORADOR",
            width: '100%',
        });


        function confirmacaoExcluir(id) {

            event.preventDefault();
            swal({
                title: "Excluir Anexo!",
                text: "Você tem certeza que deseja excluir este Anexo?",
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

@stop

