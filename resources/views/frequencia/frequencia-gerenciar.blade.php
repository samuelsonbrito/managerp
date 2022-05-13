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
        Frequências
        <small>Gerencie as Frequências por Unidade</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('frequencia.index')}}">Frequencias</a></li>
        <li class="active">Gerenciar</li>
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

        <box boxtipo="box-success" boxtitulo="FREQUÊNCIAS - UNIDADE: {{$nome_unidade}} - TURNO: {{$turno}} - DATA: {{$data}} ">
            {{--<div class="row" style="margin-bottom: 1.5rem">--}}
                {{--<div class="col-md-12">--}}
                    {{--<a href="" data-toggle="modal" data-target="#modal-cadastrar" class="btn btn-primary"><i--}}
                                {{--class="fa fa-plus"></i> Alterar Frequência</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'tabela-frequencias']) !!}
                    </div>
                </div>
            </div>
        </box>
        @include('frequencia.includes.frequencia-modal-alterar')
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('js/frequencia/frequencia.js') }}"></script>
    {!! $dataTable->scripts() !!}

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


        $('#data_feriado').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            autoclose: true
        });

        $('#tipo').select2({
            width: '100%',
        }).trigger('change');

        $('#repetir_anualmente').select2({
            width: '100%',
        }).trigger('change');

    </script>

    <script>
        function confirmacaoExcluir(id) {
            event.preventDefault();
            swal({
                title: "Excluir Feriado!",
                text: "Você tem certeza que deseja excluir este Feriado?",
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

