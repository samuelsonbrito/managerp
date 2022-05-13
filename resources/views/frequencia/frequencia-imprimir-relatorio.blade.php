<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Frequencia</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        * {
            font-family: "Roboto", sans-serif;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            padding-top: 10px;
            background: #e6e6e6;
            text-align: center;
        }


        th, td {
            padding: 8px 14px 8px 14px;

        }


        .text-center {
            text-align: center;
        }


        .box-success {
            margin-top: 30px;
            width: 100%;
            font-size: 5px;
            padding: 20px 30px;
            text-align: left;
            margin-left: -10px;
            background-color: #FFF;
        }

        .bloco {
            width: 100.5%;

            border: 5px 5px 5px 5px #f0f0f0;
            border-radius: 5px;

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

        table {
            font-size: 8px;
            margin-bottom: 30px;
        }

        th, td {
            padding: 8px 14px 8px 14px;

        }

        .text-center {
            text-align: center;
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


        .legend {
            left: 80px;
            top: 10px;
            padding: 5px;

        }

        .escala-botao {
            font-size: 0.8rem;
        }

        .logo {
            margin-left: 30px;
        }
        .segeam {
            width: 101%;
            /*background: #11785e;*/
            /*color: whitesmoke;*/
            margin-top: 30px;
            padding-bottom: -100px;
        }
        .segeam {
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
        }

        .item {

        }

        .segeam > .item {
            margin-right: 0.2%;
            /*border: 1px dashed black;*/
        }

        .segeam > .item:last-child {
            margin-right: 0;
        }

        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: 9px;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #60A7A6;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }


    </style>
</head>
<body>
<div class="information">

    <table width="100%" style="padding: 7px 1px -28px -1px">

        <tr>
            <td align="left">
                <img src="{{public_path('assets/img/logosegeam.png')}}" alt="Logo" width="75" class="logo"/>
            </td>
            <td align="right" style="width: 70%;">
                <h5 style="padding-bottom: -15px" align="right"><b >SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS</b></h5>
                <hr style="padding-bottom: -11px; margin-left: 79px; width: 470px">
                <h6 align="right"><p style="padding-bottom: -13px; font-size: 12px">UNIDADE: {{$dados['0']->nome_unidade}}</p></h6>
                <h6 align="right"><p style="font-size: 12px">TURNO: {{ $dados['0']->turno == 'D' ? 'DIURNO' : 'NOTURNO' }}</p></h6>

            </td>
        </tr>

    </table>
</div>
{{--<div class="segeam">--}}
    {{--<div class="item" style="margin: 10px 4px 10px 0"> <img src="{{public_path('assets/img/logosegeam.png')}}" alt="Logo" width="80" class="logo"></div>--}}

    {{--<div class="item" style="margin: 10px 4px 10px 0">--}}
        {{--<h5 align="right" style="padding-bottom: -7px"><b>SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS</b></h5>--}}
        {{--<h6 align="right" style="padding-bottom: -7px"><b>UNIDADE: {{$dados['0']->nome_unidade}}</b></h6>--}}
        {{--<h6 align="right" style="padding-bottom: -7px"><b>TURNO: {{ $dados['0']->turno == 'D' ? 'DIURNO' : 'NOTURNO' }}</b></h6>--}}
    {{--</div>--}}
    {{--<div class="item" style="margin: 20px 4px 10px 0"><h4 align="right"><small><strong style="color: black">2- Nº da Guia no Prestador</strong></small><b> {{ @$guiaHonorario->guiaBase->nro_guia_prestador }}</b></h4></div>--}}
{{--</div>--}}

<div class="box-success">


    <div class="card-block">
        <div class="box-body">
            <div class="col-sm-12 col-md-12">
                <div class="container bloco ">

                        <table class="table table-bordered table-condensed" style="margin-left: -26px; width: 760px; font-size: 9px">
                            <tbody>
                            <tr bgcolor="#60A7A6" style="color: whitesmoke">
                                <td colspan="18" class="text-center"><strong>FREQUENCIA DE {{$dados['0']->nome_unidade}} EM {{$dados['0']->periodo}}</strong></label>
                                </td>
                            </tr>

                            <!-- Bloco Identificação -->

                            <tr bgcolor="#ecf0f5">
                                <td colspan="18" class="text-center"><strong>PLE: </strong>Plantão Escala &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>P: </strong>Presenças &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>F: </strong>Faltas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                                    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>PA: </strong>Plantões Avulsos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>PEX: </strong>Plantões Extras &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>SR: </strong>Sem Reposição &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ER: </strong>Extras Realizados (Acum) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TRP: </strong>Total de Plantões Realizados &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
                            <tr style="font-size: 8px">
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
                            <tr style="font-size: 8px">
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
                                <tr style="font-size: 8px">
                                    <td colspan="1">{{ $dado->matricula_colaborador }}</td>
                                    <td colspan="2">{{ $dado->nome_colaborador }}</td>
                                    <td colspan="2">{{ $dado->nome_setor }}
                                    </td>
                                    <td colspan="2">{{ $dado->numero_conselho }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->turno }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->ple }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->p }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->f }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->pa }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->pex }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->sr }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->er }}</td>
                                    <td colspan="1" class="text-center">{{ $dado->tpr }}</td>
                                    <td colspan="2" class="text-center">
                                        @if(!empty($dado->datas_nomes_avulsos))
                                            @foreach($dado->datas_nomes_avulsos as $data_nome_avulso)
                                                <strong>PA</strong> - {{$data_nome_avulso['data'].' - '.$data_nome_avulso['substituto_avulso'] .' - '. $data_nome_avulso['justificativa']}}
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
                            <tr style="font-size: 8px">
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
                        </table>
                    </div>
            </div>


        </div>
    </div>
</div>


</body>
</html>





