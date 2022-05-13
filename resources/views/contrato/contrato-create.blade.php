@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/popper.js/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/wizard/style.css') }}">
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
            opacity: 1;
        }

    </style>
@stop
@section('content_header')
    <h1>
        Gerenciamento de Contratos
        <small>Gerencie os contratos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('contratos.index')}}">Contratos</a></li>
        @if(\Route::getCurrentRoute()->getName() == 'contratos.edit')
            <li class="active">Editar Contrator</li>
        @else
            <li class="active">Cadastrar Contrato</li>
        @endif
    </ol>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Atenção!</h4>
       Antes de cadastrar um novo contrato, verifique se o cliente já está cadastrado , caso não é necessário cadastrar  o novo Cliente
    </div>
        @stop
@section('content')
    <div id="app">
        @if(\Route::getCurrentRoute()->getName() == 'contrato.edit')
            <box boxtipo="box-success" boxtitulo="EDITAR CONTRATO">
        @else
            <box boxtipo="box-success" boxtitulo="CADASTRAR CONTRATO">
        @endif

            <formulario
                    validate="true"
                    redirect="true"
                    rota-redirect="{{route('contratos.index')}}"
                    enc-type="multipart/form-data"
                    id-form="form-exemple"
                    icon-botao='fa fa-save'
                    cor-botao="primary"
                    acao="{{route('contratos.store')}}"
                    metodo="post"
                    nome-botao="Salvar"
                    id-botao="btn-salvar"
                    nome-botao-desabilitado="Cadastrando">
                {{csrf_field()}}

                    <div class="col-md-12">
                        @include('contrato.includes.formulario-dados-contrato')
                        @include('contrato.includes.modal-cadastrar-anexo')
                        @include('contrato.includes.model-editar-anexo')
                    </div>
                 
            </formulario>
        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.js') }}"></script>
    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script src="{{ asset('js/contrato/create.js') }}"></script>
    <script>

        unidades_ids = {{@$dados['contrato']->unidades ? @$dados['contrato']->unidades->pluck('id') : null}} 
        console.log(typeof unidades_ids)
        if (typeof unidades_ids === undefined) {
            $('#unidades_contrato').select2({
                placeholder: function(){
                    $(this).data('placeholder');
                },
                multiple: true,
                width:'100%',
            });
        } else {
            $('#unidades_contrato').select2({
                placeholder: function(){
                    $(this).data('placeholder');
                },
                multiple: true,
                width:'100%',
            }).val(unidades_ids).trigger("change"); 
        }
       

    </script>
@stop

