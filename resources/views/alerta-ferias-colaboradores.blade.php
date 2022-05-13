@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/wizard/style.css') }}">
@stop
@section('content_header')
    <h1>
        Colaboradores
        <small>Alerta de Férias</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('home')}}">Dashboard</a></li>
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

        <box boxtipo="box-success" boxtitulo="Alerta de Férias a Partir de 18 Meses da Admissão">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-12">
                    <a href="{{ route('imprimir.alerta.ferias') }}" target='_blank' class="btn btn-primary"><i
                                class="fa fa-file-text-o"></i> Gerar Relátorio</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    {!! $dataTable->scripts() !!}
@stop

