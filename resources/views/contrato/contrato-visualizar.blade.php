@extends('adminlte::page')
@section('css')
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
        }
        .page_break { page-break-before: always; }

        #conteudo-tabela {
            border-collapse: collapse;
            margin: auto;
        }

        #cabecalho {
            margin: auto;
            margin-bottom: 70px;
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

        .bloco {
            width: 100%;
            border: 5px 5px 5px 5px #888;
            border-radius: 5px;
        }

    </style>

@stop
@section('content_header')
    <h1>
        Gerenciamento de Contratos
        <small>Gerencie os Contratos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('contratos.index')}}"></i> Contratos</a></li>
        <li class="active">Visualizar</li>
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
        <box boxtipo="box-success" boxtitulo="CONTRATO - NÚMERO: {{ @$dados['contrato']->numero }}">
            <div class="container bloco ">
                {{-- <div class="row" style="margin-bottom: 1.5rem">
                    <div class="col-md-12">
                        <a href="{{route('imprimir.colaborador', @$colaborador->id)}}"  target='_blank' class="btn btn-primary"><i
                                    class="fa fa-print"></i> Imprimir</a>
                    </div>
                </div> --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed" style="font-size: 15px;">
                        <tbody>
                            <tr bgcolor="#C0E7E1">
                                <td colspan="12" class="text-center"><label for=""><strong>INFORMAÇÕES DO CONTRATO</strong></label>
                                </td>
                            </tr>
                          
                            <tr>
                                <td colspan="6"><strong>CLIENTE:</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{ @$dados['contrato']->cliente->nome}}</td>
                                <td colspan="3"><strong>VALOR:</strong>&nbsp;&nbsp;R$ {{ number_format(@$dados['contrato']->valor,2,",",".") }}</td>
                                <td colspan="3"><strong>STATUS:</strong>&nbsp;&nbsp;{{ @$dados['contrato']->status }}</td>
                            </tr>

                            <tr>
                                <td colspan="3"><strong>NÚMERO DO CONTRATO:</strong>&nbsp;&nbsp;{{ @$dados['contrato']->numero}}</td>
                                <td colspan="3"><strong>DATA INÍCIO:</strong>&nbsp;&nbsp;{{ @$dados['contrato']->data_inicial}}</td>
                                <td colspan="3"><strong>DATA FIM:</strong>&nbsp;&nbsp;{{ @$dados['contrato']->data_fim }}</td>
                                <td colspan="3"><strong>DATA DA ASSINATURA :</strong>&nbsp;&nbsp;{{ @$dados['contrato']->data_assinatura }}</td>
                            
                            </tr>
                    
                       
                        @if(!empty(@$dados['contrato']->unidades))
                            <tr>
                                <td colspan="12" class="text-center" style="background: #d9e0e7"><label for=""><strong>UNIDADES</strong></label></td>
                            </tr>
                        @endif

                        @foreach(@$dados['contrato']->unidades as $unidade)
                            <tr>
                                <td colspan="12"><strong>NOME: </strong>&nbsp;&nbsp;{{ @$unidade->nome}}</td>
                               
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                </div>

            </div>
        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
@stop

