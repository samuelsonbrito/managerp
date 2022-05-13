@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <style>
        input{
            text-transform:uppercase;
        }
    </style>
@stop
@section('content_header')
    <h1>
        Gerenciamento de Dependentes
        <small>Gerencie os Colaboradores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('colaborador.index')}}"></a>Colaboradores</li>
        <li class="active">Dependente(s)</li>
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

        <box boxtipo="box-success" boxtitulo="DEPENDENTE(S)">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-12">
                    <a href="" data-toggle="modal" data-target="#modal-cadastrar" class="btn btn-primary"><i
                                class="fa fa-plus"></i> Cadastrar Dependente</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'tabela-dependentes']) !!}
                    </div>
                </div>
            </div>
        </box>
        @include('colaborador.includes.modal-cadastrar-dependente')
        @include('colaborador.includes.modal-editar-dependente')
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script src="{{ asset('js/colaborador/dependente.js') }}"></script>


    {!! $dataTable->scripts() !!}
    <script>
        function confirmacaoExcluir(id) {
            event.preventDefault();
            swal({
                title: "Excluir Anexo!",
                text: "Você tem certeza que deseja excluir este Dependente?",
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
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                autoclose: true
            });

            $('#dataNascimentoEditar').datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                autoclose: true
            });



    </script>

@stop

