@extends('adminlte::page')
@section('css')
    <style>


        .btn#b-escala {
            padding: 6px 1px !important;
            font-size: 10px !important;
        }

        /*table {*/
            /*font-size: 10px;*/
            /*margin-bottom: 30px;*/
        /*}*/

        /*th, td {*/
            /*padding: 8px 14px 8px 14px;*/

        /*}*/

        #dependentes {
            padding: 8px 14px 8px 14px;
            border: 1px solid #e0e0e0;
        }

        .text-center {
            text-align: center;
        }

        #tr-conteudo {
            background: #91cbe8;
        }

        .bloco {


            width: 100%;

            border: 5px 5px 5px 5px #888;
            border-radius: 5px;

        }


        .cabecalho {
            background: #11785e;
            color: whitesmoke;
        }

        .profissionais {
            background: #EAF7F5;
            /*color: whitesmoke;*/
        }

        .selecionado {
            background: #178D7B;
            color: whitesmoke;
        }

        .licenca {
            background: #db5461;
            color: whitesmoke;
        }


        *:focus {
            outline: none !important;
        }

        .input-group-btn .btn {
            width: 100%;
        }

        :not(:first-child):not(:last-child).input-group-btn.button-checkbox .btn {
            border-radius: 0px;
        }

        .teste {
            background: #639FAB;
            color: white;
            font-weight: normal;
        }

        .legend {
            left: 80px;
            top: 10px;
            padding: 5px;

        }

        .legend h4 {
            margin: 0 0 10px;
            text-transform: uppercase;
            font-family: sans-serif;
            text-align: center;
        }

        .legend ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .legend li {
            padding-bottom: 5px;
        }

        .legend span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 6px;
        }

        .escala-botao {
            font-size: 0.8rem;
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
        <li class="active"><a href="{{route('frequencia.index')}}">Frequencias</a></li>
        <li class="active">Relatório</li>
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

        <box boxtipo="box-success" boxtitulo="FREQUENCIA DE {{@$dados['0']->nome_unidade}} EM {{@$dados['0']->periodo}}">
            <div class="container bloco ">
                @if (@$dados != null)
                <div class="row" style="margin-bottom: 1.5rem">
                    <div class="col-md-12">
                        <a href="{{route('frequencia.imprimir-relatorio', [
                        "data" => @$dados->data,
                        "unidade" => @$dados['0']->unidade_id,
                        "turno" => @$dados->turno,
                        "cargo" => @$dados['0']->cargo_id
                        ])}}" target='_blank' class="btn btn-primary"><i
                                    class="fa fa-print"></i> Imprimir</a>
                    </div>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed" style="font-size: 10px;">
                        <tbody>
                        <tr bgcolor="#C0E7E1">
                            <td colspan="17" class="text-center"><label for=""><strong>FREQUÊNCIAS</strong></label>
                            </td>
                        </tr>

                        @if (@$dados != null)

                            <tr bgcolor="#ecf0f5">
                                <td colspan="17" class="text-center"><strong>PLE: </strong>Plantão Escala &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>P: </strong>Presenças &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>F: </strong>Faltas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                                | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>PA: </strong>Plantões Avulsos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>PEX: </strong>Plantões Extras &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>SR: </strong>Sem Reposição &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ER: </strong>Extras Realizados (Acum) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TRP: </strong>Total de Plantões Realizados &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <th colspan="8" class="text-center">TOTAIS</th>
                                <th colspan="1" class="text-center">{{@$dados->totais['ple']}}</th>
                                <th colspan="1" class="text-center">{{@$dados->totais['p']}}</th>
                                <th colspan="1" class="text-center">{{@$dados->totais['f']}}</th>
                                <th colspan="1" class="text-center">{{@$dados->totais['pa']}}</th>
                                <th colspan="1" class="text-center">{{@$dados->totais['pex']}}</th>
                                <th colspan="1" class="text-center">{{@$dados->totais['sr']}}</th>
                                <th colspan="1" class="text-center">{{@$dados->totais['er']}}</th>
                                <th colspan="1" class="text-center">{{@$dados->totais['tpr']}}</th>
                                <th colspan="2" class="text-center"></th>
                            </tr>
                            <tr>
                                <th colspan="1" class="text-center">MATRÍCULA</th>
                                <th colspan="2" class="text-center">NOME DO COLABORADOR</th>
                                <th colspan="2" class="text-center">SETOR</th>
                                <th colspan="2" class="text-center">NÚMERO CONSELHO</th>
                                <th colspan="1" class="text-center">TURNO</th>
                                <th colspan="1" class="text-center">PLE</th>
                                <th colspan="1" class="text-center">P</th>
                                <th colspan="1" class="text-center">F</th>
                                <th colspan="1" class="text-center">PA</th>
                                <th colspan="1" class="text-center">PEX</th>
                                <th colspan="1" class="text-center">SR</th>
                                <th colspan="1" class="text-center">ER</th>
                                <th colspan="1" class="text-center">TPR</th>
                                <th colspan="2" class="text-center">OBS</th>
                            </tr>
                            @foreach($dados as $dado)
                                <tr>
                                    <td colspan="1">{{ $dado->matricula_colaborador }}</td>
                                    <td colspan="2">{{ $dado->nome_colaborador }}</td>
                                    <td colspan="2">{{ $dado->nome_setor }}
                                    </td>
                                    <td colspan="2">{{ $dado->numero_conselho }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->turno }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->ple }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->p }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->f }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->pa }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->pex }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->sr }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->er }}</td>
                                    <td colspan="1" class="text-center">{{ @$dado->tpr }}</td>
                                    <td colspan="2" class="text-center">
                                        @if(!empty(@$dado->datas_nomes_avulsos))
                                            @foreach(@$dado->datas_nomes_avulsos as $data_nome_avulso)
                                                <strong>PA</strong> - {{@$data_nome_avulso['data'].' - '.@$data_nome_avulso['substituto_avulso'] .' - '. @$data_nome_avulso['justificativa']}}
                                                <br>
                                            @endforeach
                                        @endif
                                        @if(!empty($dado->datas_nomes_extras))
                                            @foreach($dado->datas_nomes_extras as $data_nome_extra)
                                                <strong>PEX</strong> - {{$data_nome_extra['data'].' - '.$data_nome_extra['nome_colaborador'] .' - '. $data_nome_extra['justificativa']}}
                                                <br>
                                            @endforeach
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="8" class="text-center">TOTAIS</th>
                                <th colspan="1" class="text-center">{{$dados->totais['ple']}}</th>
                                <th colspan="1" class="text-center">{{$dados->totais['p']}}</th>
                                <th colspan="1" class="text-center">{{$dados->totais['f']}}</th>
                                <th colspan="1" class="text-center">{{$dados->totais['pa']}}</th>
                                <th colspan="1" class="text-center">{{$dados->totais['pex']}}</th>
                                <th colspan="1" class="text-center">{{$dados->totais['sr']}}</th>
                                <th colspan="1" class="text-center">{{$dados->totais['er']}}</th>
                                <th colspan="1" class="text-center">{{$dados->totais['tpr']}}</th>
                                <th colspan="2" class="text-center"></th>
                            </tr>

                            </tbody>
                        @else
                                <tr>
                                    <td class="text-center">
                                        SEM FREQUÊNCIA(S)
                                    </td>
                                </tr>

                        @endif
                    </table>
                </div>

            </div>


        </box>
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
@stop

