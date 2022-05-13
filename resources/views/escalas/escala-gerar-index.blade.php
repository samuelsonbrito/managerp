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
        Escalas
        <small>Cadastre e Monte Escala Mensal Por Unidade</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('escala.consultar-escala')}}"> Escalas</a></li>
        <li class="active">Montar Escala</li>
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

        <box boxtipo="box-success" boxtitulo="ESCALAS MENSAIS">
            @if ($message = Session::get('error'))
                <div class="callout callout-danger">
                    <h4>Erro!</h4>

                    <p>{{$message}}</p>
                </div>
            @endif

            {!! Form::open(['route' => 'escala.cadastrar-escala']) !!}
                    <div class="row">

                        <div class="form-group col-md-4">
                            {!! Form::label('mes', 'Mês/Ano:') !!}
                            {!! Form::select('mes', $meses_disponiveis, '', ['class' => 'conselho col-md-12 form-control select2', 'id' => 'mes']) !!}
                        </div>

                        <div class="form-group col-md-4">
                            {!! Form::label('unidade', 'Unidade:') !!}
                            {!! Form::select('unidade', $unidades, '' , ['class' => 'conselho col-md-12 form-control select2', 'id' => 'unidade', 'placeholder'=> '']) !!}
                        </div>

                        <div class="form-group col-md-4">
                            {!! Form::label('setor', 'Setor:') !!}
                            {!! Form::select('setor', [], null, ['class' => 'conselho col-md-12 form-control select2', 'id' => 'setor', 'placeholder'=> '']) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('cargo', 'Cargo:') !!}
                            {!! Form::select('cargo', $cargos, '', ['class' => 'conselho col-md-12 form-control', 'id' => 'cargo']) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('turno', 'Turno:') !!}
                            {!! Form::select('turno', ['DIURNO' => 'DIURNO', 'NOTURNO' => 'NOTURNO'], 0 , ['class' => 'conselho col-md-12 form-control', 'id' => 'turno']) !!}
                        </div>
                        <div class="form-group col-md-12 text-right">
                            <button type="submit" class="btn btn-primary" id="enviar" disabled><i class="fa fa-calendar"></i> Montar Escala</button>
                        </div>
                    </div>

            {!! Form::close() !!}

        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
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

