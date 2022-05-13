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
        Relatório
        <small>Gere Relatórios Colaborador/Setores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Relatório Colaborador/Setores</li>
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

        <box boxtipo="box-success" boxtitulo="RELATÓRIO">
            <div class="row" style="margin-bottom: 1.5rem">
                {{--<div class="col-md-12">--}}
                    {{--<a href="" data-toggle="modal" data-target="#modal-cadastrar" class="btn btn-primary"><i--}}
                                {{--class="fa fa-plus"></i> Cadastrar</a>--}}
                {{--</div>--}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        {!! $dataTable->table(['id' => 'relatorio-colaborador-setores']) !!}
                    </div>
                </div>
            </div>
        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/unidade/unidade.js') }}"></script>
    {!! $dataTable->scripts() !!}


@stop

