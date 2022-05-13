@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/izitoast/dist/css/iziToast.min.css') }}">
    <style>
        input {
            text-transform: uppercase;
        }
    </style>
@stop
@section('content_header')
    <h1>
        Escalas
        <small>Edite Plantões da Escala Mensal</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('escala.consultar-escala')}}"> Escalas</a></li>
        <li class="active">Editar Escala</li>
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

        <box boxtipo="box-success" boxtitulo="ESCALA MENSAL">
            <div class="row" style="margin-bottom: 1.5rem">
                <div class="col-md-1">


                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Imprimir
                            <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('imprimir.escala', @$escala->id)}}" target='_blank'>Escalas da Unidade/Setor</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('escala.imprimir-alimentacao', @$escala->id)}}" target='_blank'>Relação para Ticket Alimentação</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('escala.imprimir-frequencia-manual', @$escala->id)}}" target='_blank'>Frequencia Manual</a></li>
                        </ul>
                    </div>

                </div>
            </div>
            <escala-e escala="{{$escala}}" unidade="{{json_encode($escala->unidade)}}" setor="{{$escala->setor}}"
                    cargo="{{$escala->cargo}}" colaboradores="{{$colaboradores}}" licencas="{{json_encode($dias_licencas)}}" dias_edit="{{json_encode($dias)}}" feriados="{{json_encode($feriados)}}"></escala-e>


        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('assets/plugins/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/escala/escala.js') }}"></script>

    <script>
        function confirmacaoExcluir(id) {
            event.preventDefault();
            swal({
                title: "Excluir Cargo!",
                text: "Você tem certeza que deseja excluir este Cargo?",
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

