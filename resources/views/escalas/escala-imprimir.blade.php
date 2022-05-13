<!doctype html>
<html lang="PT-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Escala</title>
    <style>
        .text-center {
            text-align: center;
        }

        .box-success {
            width: 100%;
            font-size: 5px;
            padding: 20px 30px;
            text-align: left;
            margin-left: -50px;
            background-color: #FFF;
        }

        .bloco {
            width: 101%;

            border: 5px #f0f0f0;
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

        #tabela{
            font-size: 9px;
            margin-bottom: -200px;
        }

        .text-center {
            text-align: center;
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

        .logo {
            margin-left: 30px;
        }
        .segeam {
            width: 101%;
            margin-top: 30px;
            padding-bottom: -150px;
        }
        .segeam {
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
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
            font-size: x-small;
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

        <table width="100%" style="padding-top: 15px; padding-left: 13px; padding-right: 15px">

            <tr>
                <td align="left">
                    <img src="{{public_path('assets/img/logosegeam.png')}}" alt="Logo" width="75" class="logo"/>
                </td>
                <td align="right" style="width: 50%;">

                    {{--<h3>SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS</h3>--}}
                    {{--<pre>--}}
                    {{--UNIDADE: {{ @$escala->unidade->nome}} - SETOR: {{ @$escala->setor->nome }} - TURNO: {{ @$escala->turno }}--}}
                    {{--CARGO: {{ @$escala->cargo->descricao }} - PERÍODO: {{ @$escala->periodo }}--}}


                    <h5 align="right" style="padding-bottom: -15px"><b>SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS<b/></h5>
                    <hr style="margin-left: 77px; width: 470px; padding-bottom: -11px">
                    <h6 align="right"><p style="padding-bottom: -13px">UNIDADE: {{ @$escala->unidade->nome}} - SETOR: {{ @$escala->setor->nome }} - TURNO: {{ @$escala->turno }}</p></h6>
                    <h6 align="right"><p>CARGO: {{ @$escala->cargo->descricao }} - PERÍODO: {{ @$escala->periodo }}</p></h6>

                </td>
            </tr>

        </table>
    </div>
    <br>
{{--<div class="segeam">--}}
    {{--<div class="item" style="margin: 10px 4px 10px 0"> <img src="{{public_path('assets/img/logosegeam.png')}}" alt="Logo" width="80" class="logo"></div>--}}

    {{--<div class="item" style="margin: 10px 4px 10px 0">--}}
        {{--<h5 align="right" style="padding-bottom: -7px"><b>SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS</b></h5>--}}
        {{--<h6 align="right" style="padding-bottom: -7px"><b>UNIDADE: {{ @$escala->unidade->nome}} - SETOR: {{ @$escala->setor->nome }} - TURNO: {{ @$escala->turno }}</b></h6>--}}
        {{--<h6 align="right" style="padding-bottom: -7px"><b>CARGO: {{ @$escala->cargo->descricao }} - PERÍODO: {{ @$escala->periodo }}</b></h6>--}}
    {{--</div>--}}
    {{--<div class="item" style="margin: 20px 4px 10px 0"><h4 align="right"><small><strong style="color: black">2- Nº da Guia no Prestador</strong></small><b> {{ @$guiaHonorario->guiaBase->nro_guia_prestador }}</b></h4></div>--}}
{{--</div>--}}

<div class="box-success">


    <div class="card-block">
        <div class="box-body">
            <div class="col-sm-12 col-md-12">
                <div class="container bloco">

                    <table class="table table-bordered table-condensed" id="tabela">
                        <tr bgcolor="#60a7a6" style="color: whitesmoke">
                            @if(count($dias) == 29)
                                <td colspan="60" class="text-center"><strong>
                                        PLANTÕES</strong>
                                </td>
                            @endif

                            @if(count($dias) == 30)
                                <td colspan="61" class="text-center"><strong>
                                        PLANTÕES</strong>
                                </td>
                            @endif

                            @if(count($dias) == 31)
                                <td colspan="62" class="text-center"><strong>
                                        PLANTÕES</strong>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            @if(count($dias) == 29)
                                <td colspan="61" class="text-left">


                                    @foreach($feriados as $feriado)
                                        <i><span
                                            ></span><strong>FERIADOS: </strong>{{$feriado['data']}} - {{$feriado['descricao']}}
                                            &nbsp;&nbsp;&nbsp;&nbsp;</i>
                                    @endforeach


                                </td>
                            @endif

                            @if(count($dias) == 30)
                                    <td colspan="61" class="text-left">


                                        @foreach($feriados as $feriado)
                                            <i><span
                                                ></span><strong>FERIADOS: </strong>{{$feriado['data']}} - {{$feriado['descricao']}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;</i>
                                        @endforeach


                                    </td>
                            @endif

                            @if(count($dias) == 31)
                                    <td colspan="61" class="text-left">


                                        @foreach($feriados as $feriado)
                                            <i><span
                                                ></span><strong>FERIADOS: </strong>{{$feriado['data']}} - {{$feriado['descricao']}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;</i>
                                        @endforeach


                                    </td>
                            @endif

                        </tr>
                        <tr>
                            <th  colspan="1" class="text-center">MATRÍCULA</th>
                            <th  colspan="21" class="text-center">NOME</th>
                            <th colspan="2" class="text-center">CONTATO</th>
                            <th colspan="2" class="text-center">CONSELHO</th>
                            <th colspan="4" class="text-center">HORÁRIO</th>


                            @foreach($dias as $dia)


                            @foreach($feriados as $feriado)
                                @if($feriado['dia'] == $dia['dia'])

                                    <input type="hidden" value="{{$dia['feriado'] = 'F'}}">

                                @endif
                                @endforeach

                                @if($dia['feriado'] == 'F')
                                    <th class="text-center" style="font-size: 6px; background: darkgray; width: 2px">
                                @elseif($dia['nome_dia'] == 'SÁB' || $dia['nome_dia'] == 'DOM')
                                    <th colspan="1" class="text-center" style="font-size: 6px; background: #f2f3f4; width: 2px">
                                @else
                                    <th colspan="1" class="text-center" style="font-size: 6px; width: 2px">
                                        @endif

                                        {{ substr($dia['nome_dia'],0,1)}}
                                        <br>{{$dia['dia']}}

                                        {{--</button>--}}

                                        {{--</span>--}}
                                    </th>


                                @endforeach
                                <th colspan="1" class="text-center" style="font-size: 6px; vertical-align: middle">TOTAL</th>

                        </tr>


                        @foreach($escala->colaboradores as $colaborador)

                            <tr>
                                <td colspan="1">{{ @$colaborador->matricula }}</td>
                                <td colspan="21">{{ @$colaborador->nome }}</td>
                                <td colspan="2">{{@$colaborador->fone_contato}}</td>
                                <td colspan="2">{{ @$colaborador->conselhoProfissional->numero_conselho }}
                                </td>

                                <td colspan="4">{{ @$colaborador->horarioTrabalhoIntervalo->horarioTrabalho->inicio_expediente.' - '. @$colaborador->horarioTrabalhoIntervalo->horarioTrabalho->fim_expediente}}
                                </td>

                                @foreach($dias as $dia)
                                    @foreach($feriados as $feriado)
                                        @if($feriado['dia'] == $dia['dia'])

                                            <input type="hidden" value="{{$dia['feriado'] = 'F'}}">

                                        @endif
                                    @endforeach

                                        @if($dia['feriado'] == 'F')
                                            <td class="text-center" style="font-size: 6px; background: darkgray; width: 2px">
                                        @elseif($dia['nome_dia'] == 'SÁB' || $dia['nome_dia'] == 'DOM')
                                            <td colspan="1" class="text-center" style="font-size: 6px; background: #f2f3f4; width: 2px">
                                        @else
                                            <td colspan="1" class="text-center" style="font-size: 6px; width: 2px">
                                        @endif

                                        @foreach(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias) as $selecionado)
                                            @if($selecionado == $dia['dia'])

                                                <input type="hidden" value="{{$dia['status'] = 'selecionado'}}">

                                            @endif
                                        @endforeach

                                        @if($dia['status'] == 'selecionado')
                                            <strong>P</strong>
                                        @endif
                                    </td>

                                @endforeach
                                <td colspan="1" class="text-center"><strong>{{count(array_filter(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias)))}}</strong>
                                </td>

                            </tr>


                        @endforeach


                        <br>

                    </table>
                    <br><br><br><br>

                        <table>
                            @if(count($dias) == 29)
                                <tr>
                                    <td colspan="29" class="text-center" style="height: 400px; padding: 0px 100px -10px 100px;">
                                        <img src="{{public_path('assets/img/eliane.png')}}" alt="assinatura_eliane" width="60" style="padding-bottom: -22px">
                                        <p style="padding-bottom: -7px">___________________________________________________</p>
                                        <b style="font-size: 12px">Eliane Calderaro Santana - Coren: 201.979 </b>
                                    </td>
                                    <td colspan="29" class="text-center" style="height: 400px; padding: 0px 100px -10px 100px;">
                                        <img src="{{public_path('assets/img/karina.png')}}" alt="assinatura_eliane" width="60" style="padding-bottom: -22px">
                                        <p style="padding-bottom: -7px">___________________________________________________</p>
                                        <b style="font-size: 12px">Karina Barros - Coren: 166.956 </b>
                                    </td>
                                </tr>
                            @endif

                            @if(count($dias) == 30)


                                <tr>
                                    <td colspan="30" class="text-center" style="height: 400px; padding: 0px 100px -10px 100px;">
                                       <img src="{{public_path('assets/img/eliane.png')}}" alt="assinatura_eliane" width="60" style="padding-bottom: -22px">
                                        <p style="padding-bottom: -7px">___________________________________________________</p>
                                        <b style="font-size: 12px">Eliane Calderaro Santana - Coren: 201.979 </b>
                                    </td>
                                    <td colspan="30" class="text-center" style="height: 400px; padding: 0px 100px -10px 100px;">
                                        <img src="{{public_path('assets/img/karina.png')}}" alt="assinatura_eliane" width="60" style="padding-bottom: -22px">
                                        <p style="padding-bottom: -7px">___________________________________________________</p>
                                        <b style="font-size: 12px">Karina Barros - Coren: 166.956 </b>
                                    </td>
                                </tr>

                            @endif

                            @if(count($dias) == 31)


                                    <tr>
                                        <td colspan="31" class="text-center" style="height: 400px; padding: 0px 100px -10px 100px;">
                                            <img src="{{public_path('assets/img/eliane.png')}}" alt="assinatura_eliane" width="60" style="padding-bottom: -22px">
                                            <p style="padding-bottom: -7px">___________________________________________________</p>
                                            <b style="font-size: 12px">Eliane Calderaro Santana - Coren: 201.979 </b>
                                        </td>
                                        <td colspan="31" class="text-center" style="height: 400px; padding: 0px 100px -10px 100px;">
                                            <img src="{{public_path('assets/img/karina.png')}}" alt="assinatura_eliane" width="60" style="padding-bottom: -22px">
                                            <p style="padding-bottom: -7px">___________________________________________________</p>
                                            <b style="font-size: 12px">Karina Barros - Coren: 166.956 </b>
                                        </td>
                                    </tr>
                            @endif



                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>





