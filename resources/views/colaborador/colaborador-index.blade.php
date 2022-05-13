@extends('adminlte::page')
@section('css')

@stop
@section('content_header')
    <h1>
        Gerenciamento Admissional
        <small>Gerencie os Colaboradores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Colaboradores</li>
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

        <box boxtipo="box-success" boxtitulo="COLABORADORES">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-12">
                    <a href="{{ route('colaborador.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> Cadastrar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'tabela-usuarios']) !!}
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
                title: "Excluir Colaborador!",
                text: "Você tem certeza que deseja excluir este Colaborador?",
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

