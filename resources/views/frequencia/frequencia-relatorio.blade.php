@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/popper.js/dist/css/bootstrap-datepicker.min.css') }}">
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
        <li class="active">Relatório</li>
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

        <box boxtipo="box-success" boxtitulo="RELATÓRIO DE FREQUÊNCIA">
            @if ($message = Session::get('error'))
                <div class="callout callout-danger">
                    <h4>Erro!</h4>

                    <p>{{$message}}</p>
                </div>
            @endif

            {!! Form::open(['route' => 'frequencia.gerar-relatorio']) !!}
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="">Data:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="data" class="form-control" id="data-frequencia"
                               v-mask='["##/##/####"]' placeholder="Informe a Data " value="">
                    </div>
                    <span class="help-block"></span>
                </div>

                <div class="form-group col-md-6">
                    {!! Form::label('unidade', 'Unidade:') !!}
                    {!! Form::select('unidade', $unidades, '' , ['class' => 'conselho col-md-12 form-control select2', 'id' => 'unidade', 'placeholder'=> '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('cargo', 'Cargo:') !!}
                    {!! Form::select('cargo', $cargos, '', ['class' => 'conselho col-md-12 form-control', 'id' => 'cargo']) !!}
                </div>

                <div class="form-group col-md-6">
                    {!! Form::label('turno', 'Turno:') !!}
                    {!! Form::select('turno', ['DIURNO' => 'DIURNO', 'NOTURNO' => 'NOTURNO'], 0 , ['class' => 'conselho col-md-12 form-control', 'id' => 'turno']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12 text-right">
                    <button type="submit" class="btn btn-primary" id="enviar"><i class="fa fa-check-circle-o"></i> Ok</button>
                </div>
            </div>


            {!! Form::close() !!}

        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>

    <script>

        $(document).ready(function () {


            $('#data-frequencia').datepicker({
                language: 'pt-BR',
                format: "mm/yyyy",
                autoclose: true,
                viewMode: "months",
                minViewMode: "months",
            });
            var turno = $('#turno');
            turno.select2({

                width: '100%'
            });

            var unidade = $('#unidade');
            unidade.select2({
                placeholder: "SELECIONE UMA UNIDADE",
                width: '100%'
            });

            var cargo = $('#cargo');
            cargo.select2({
                placeholder: "SELECIONE UM CARGO",
                width: '100%'
            });

        });

    </script>
@stop

