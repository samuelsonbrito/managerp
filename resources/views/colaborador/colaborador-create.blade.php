@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <style>
        .btn.disabled,
        .btn[disabled],
        fieldset[disabled] .btn {
            pointer-events: none;
            cursor: not-allowed;
            filter: alpha(opacity=65);
            -webkit-box-shadow: none;
            box-shadow: none;
            opacity: .65;
        }
        input{
            text-transform:uppercase;
        }

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .setup-panel > .stepwizard-step > a {
            display: block;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
          padding: 15px 15px 15px;
            margin: 0;
            border-radius: 0;
            color: #2e353c;
        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 100%;
            height: 60px;
            border-right: 0px;
            text-align: left;
            line-height: 1.428571429;
            border: #0d6aad;
            color: black;
        }

        .btn-default {
            color: #0d3349;
        }

        /* Add this attribute to the element that needs a tooltip */
        [data-tooltip] {
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        /* Hide the tooltip content by default */
        [data-tooltip]:before,
        [data-tooltip]:after {
            visibility: hidden;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
            opacity: 0;
            pointer-events: none;
        }

        /* Position tooltip above the element */
        [data-tooltip]:before {
            position: absolute;
            bottom: 150%;
            left: 50%;
            margin-bottom: 5px;
            margin-left: -80px;
            padding: 7px;
            width: 160px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            background-color: #000;
            background-color: hsla(0, 0%, 20%, 0.9);
            color: #fff;
            content: attr(data-tooltip);
            text-align: center;
            font-size: 14px;
            line-height: 1.2;
        }

        /* Triangle hack to make tooltip look like a speech bubble */
        [data-tooltip]:after {
            position: absolute;
            bottom: 150%;
            left: 50%;
            margin-left: -5px;
            width: 0;
            border-top: 5px solid #000;
            border-top: 5px solid hsla(0, 0%, 20%, 0.9);
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
            content: " ";
            font-size: 0;
            line-height: 0;
        }

        /* Show tooltip content on hover */
        [data-tooltip]:hover:before,
        [data-tooltip]:hover:after {
            visibility: visible;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
            filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
            opacity: 1;
        }

    </style>
@stop
@section('content_header')
    <h1>
        Gerenciamento Admissional
        <small>Gerencie os Colaboradores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('colaborador.index')}}">Colaboradores</a></li>
        @if(\Route::getCurrentRoute()->getName() == 'colaborador.edit')
            <li class="active">Editar Colaborador</li>
        @else
            <li class="active">Cadastrar Colaborador</li>
        @endif
    </ol>
@stop

@section('content')
    <div id="app">
        @if(\Route::getCurrentRoute()->getName() == 'colaborador.edit')
            <box boxtipo="box-success" boxtitulo="EDITAR COLABORADOR">
        @else
            <box boxtipo="box-success" boxtitulo="CADASTRAR COLABORADOR">
        @endif

            <div class="table-responsive">
                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step row">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1 - Informações Pessoais</a>
                        </div>
                        <div class="stepwizard-step row">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" id="btn-nav-top" disabled="disabled">2 -
                                Informações Familiar</a>
                        </div>
                        <div class="stepwizard-step row">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3 -
                                Processo Admissional</a>
                        </div>
                        <div class="stepwizard-step row">
                            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4 -
                                Documentos</a>
                        </div>
                        @if(\Route::getCurrentRoute()->getName() != 'colaborador.edit')
                            <div class="stepwizard-step row">
                                <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5 - Posto
                                    de Trabalho</a>
                            </div>
                        @endif
                        <div class="stepwizard-step row">
                            <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6 -
                                Concluir Cadastro</a>
                        </div>
                    </div>
                </div>
            </div>

            <formulario
                    validate="true"
                    redirect="true"
                    rota-redirect="{{route('colaborador.index')}}"
                    enc-type="multipart/form-data"
                    id-form="form-exemple"
                    icon-botao='fa fa-save'
                    cor-botao="primary"
                    acao="{{route('colaborador.store')}}"
                    metodo="post"
                    nome-botao="Salvar"
                    id-botao="btn-salvar"
                    style-botao="display:none;"
                    nome-botao-desabilitado="Cadastrando">
                {{csrf_field()}}

                <div class="setup-content" id="step-1">
                    <div class="col-md-12">
                        @include('colaborador.includes.formulario-dados-pessoais')
                    </div>
                    <div class="col-md-12 text-right" style="background: #f2f3f4; padding: 2rem;">
                        <button class="btn btn-primary nextBtn" type="button">Próximo</button>
                    </div>
                </div>

                <div class="setup-content" id="step-2">
                    <div class="col-md-12">
                        @include('colaborador.includes.formulario-informacoes-familiar')
                    </div>
                    <div class="col-md-12 text-right" style="background: #f2f3f4; padding: 2rem;">
                        <button class="btn btn-primary nextBtn" type="button">Próximo</button>
                    </div>
                </div>

                <div class="setup-content" id="step-3">
                    <div class="col-md-12">
                        @include('colaborador.includes.formulario-dados-admissional')
                    </div>
                    <div class="col-md-12 text-right" style="background: #f2f3f4; padding: 2rem;">
                        <button class="btn btn-primary nextBtn" type="button">Próximo</button>
                    </div>
                </div>

                <div class="setup-content" id="step-4">
                    <div class="col-md-12">
                        @include('colaborador.includes.formulario-documentos')
                    </div>
                    <div class="col-md-12 text-right" style="background: #f2f3f4; padding: 2rem;">
                        <button class="btn btn-primary nextBtn" type="button">Próximo</button>
                    </div>
                </div>
                @if(\Route::getCurrentRoute()->getName() != 'colaborador.edit')
                    <div class="setup-content" id="step-5">
                        <div class="col-md-12">
                            @include('colaborador.includes.formulario-posto-trabalho')
                        </div>
                        <div class="col-md-12 text-right" style="background: #f2f3f4; padding: 2rem;">
                            <button class="btn btn-primary nextBtn" type="button">Próximo</button>
                        </div>
                    </div>
                @endif

                @if(\Route::getCurrentRoute()->getName() == 'colaborador.edit')
                <div class="setup-content" id="step-6">
                        <div class="col-md-8 col-md-offset-2 text-center">
                            <h3></h3>
                            <i class="fa fa-edit text-primary" style="font-size: 22rem"></i>
                            <h3>Concluído! Clique em Finalizar para Concluir as Alterações.</h3>
                        </div>
                        <div class="col-md-12 text-right" style="background: #f2f3f4; padding: 2rem;">
                            <button type="button" class="btn btn-primary" onclick="click2()" hidden="hidden"><i class="fa fa-edit"></i> Finalizar</button>
                        </div>
    
                    </div>
                @else
                    <div class="setup-content" id="step-6">
                        <div class="col-md-8 col-md-offset-2 text-center">
                            <h3></h3>
                            <i class="fa fa-check-circle-o text-green" style="font-size: 22rem"></i>
                            <h3>Concluído! Clique em Finalizar para Concluir o Cadastro.</h3>
                        </div>
                        <div class="col-md-12 text-right" style="background: #f2f3f4; padding: 2rem;">
                            <button type="button" class="btn btn-primary" onclick="click2()" hidden="hidden">
                                    <i class="fa fa-save"></i> Finalizar!</button>
                   
                        </div>
    
                    </div>
                
                @endif

            </formulario>
        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('js/via-cep/colaborador-via-cep.js') }}"></script>
    <script src="{{ asset('js/colaborador/create.js') }}"></script>
    <script src="{{ asset('js/colaborador/posto.js') }}"></script>
@stop

