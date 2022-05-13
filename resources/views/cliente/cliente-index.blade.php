@extends('adminlte::page')
@section('css')
    {{--<link rel="stylesheet" href="{{ asset('plugins/jquery-confirm2/dist/jquery-confirm.min.css') }}">--}}
@stop
@section('content_header')
    <h1>
        Gerenciamento de Clientes/Fornecedores
        <small>Gerencie os Clientes e Fornecedores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Clientes</li>
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

        <box boxtipo="box-success" boxtitulo="CLIENTES/FORNECEDORES">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-12">
                    <a href="{{ route('cliente.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> Cadastrar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'tabela-clientes']) !!}
                    </div>
                </div>
            </div>
        </box> 
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
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

@stop

