@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <style>
        input {
            text-transform: uppercase;
        }
    </style>
@stop
@section('content_header')
    <h1>
        Gerenciamento de Licenças
        <small>Gerencie os Colaboradores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('colaborador.index')}}"></a>Colaboradores</li>
        <li class="active">Licenças</li>
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

        <box boxtipo="box-success" boxtitulo="LICENÇAS">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-12">
                    <a href="" data-toggle="modal" data-target="#modal-cadastrar" class="btn btn-primary"><i
                                class="fa fa-plus"></i> Cadastrar Licença</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'tabela-licencas']) !!}
                    </div>
                </div>
            </div>
        </box>
        @include('colaborador.includes.modal-cadastrar-licenca')
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    {{--<script src="{{ asset('js/colaborador/licenca.js') }}"></script>--}}


    {!! $dataTable->scripts() !!}
    <script>
        function confirmacaoExcluir(id) {
            event.preventDefault();
            swal({
                title: "Excluir Licença!",
                text: "Você tem certeza que deseja excluir esta Licença?",
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


        $('#inicio').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            autoclose: true
        });

        $('#fim').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            autoclose: true
        });

        $('.select2').select2();

        $('#tipo').select2({
            width: '100%',
        }).trigger('change');

    </script>

@stop

