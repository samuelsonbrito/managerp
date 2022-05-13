@extends('adminlte::page')
@section('css')
    <style>


        * {
            margin: 0;
            box-sizing: border-box;
        }

        html {
            /*padding-top: 10px;*/
            /*background: #e6e6e6;*/
            /*text-align: center;*/
        }

        body {
            /*width: 790px;*/
            font-family: 'Droid', 'Helvetica';
            /*padding: 30px 40px;*/
            /*text-align: left;*/
            /*margin-left: -26px ;*/
            background-color: #FFF;
        }

        .page_break { page-break-before: always; }

        #conteudo-tabela {
            /*width: 730px;*/
            border-collapse: collapse;
            margin: auto;
        }
        #cabecalho {
            /*width: 730px;*/
            margin: auto;
            margin-bottom: 70px;
        }
        table{
            font-size: 12px;
            margin-bottom: 30px;
        }

        th, td {
            padding: 8px 14px 8px 14px;

        }
        #dependentes {
            padding: 8px 14px 8px 14px;
            border: 1px solid #e0e0e0;
        }

        .text-center {
            text-align: center;
        }
        #tr-conteudo{
            background: #91cbe8;
        }

        img {
            max-width: 100%;
        }


        .bloco {
            width: 100%;
            border: 5px 5px 5px 5px #888;
            border-radius: 5px;
        }


    </style>

@stop
@section('content_header')
    <h1>
        Gerenciamento de Clientes/Fornecedores
        <small>Gerencie os Clientes e Fornecedores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('cliente.index')}}"></i> Clientes</a></li>
        <li class="active">Visualizar</li>
    </ol>
@stop

@section('content')
    @inject('horarios','App\Services\HorarioTrabalhoService')
    @inject('intervalo','App\Services\IntervaloService')
    <div id="app">

        @if (session('msg'))
            <confirm
                    title="{{ session('titulo') }}"
                    text="{{ session('msg') }}"
                    icon="{{ session('icon') }}"
            ></confirm>
        @endif
        <box boxtipo="box-success" boxtitulo="CLIENTE/FORNECEDOR">
            <div class="container bloco ">
                {{--<div class="row" style="margin-bottom: 1.5rem">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<a href="{{route('imprimir.colaborador', $colaborador->id)}}"  target='_blank' class="btn btn-primary"><i--}}
                                    {{--class="fa fa-print"></i> Imprimir</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <tbody>
                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>INFORMAÇÕES BÁSICAS</strong></label>
                            </td>
                        </tr>

                        <!-- Bloco Identificação -->

                        <tr>
                            <td colspan="3"><strong>Nome:</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{ $cliente->nome }}</td>
                            <td colspan="2"><strong>Tipo Pessoa:</strong>&nbsp;&nbsp;{{ $cliente->tipo_pessoa == 'F' ? 'PESSOA FÍSICA' : 'PESSOA JURÍDICA' }}</td>
                            <td colspan="3"><strong>CPF/CNPJ:</strong>&nbsp;&nbsp;{{ formatarCnpjCpf($cliente->cpf_cnpj) }}
                            </td>
                            <td colspan="2"><strong>Telefone:</strong>&nbsp;&nbsp;{{ $cliente->telefone }}</td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>Tipo:</strong>&nbsp;&nbsp;{{ $cliente->papel }}</td>
                            <td colspan="8"><strong>Nome Fantasia:</strong>&nbsp;&nbsp;{{ $cliente->nome_fantasia }}</td>
                        </tr>
                    </tbody>
                </table>
                </div>

            </div>
        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
@stop

