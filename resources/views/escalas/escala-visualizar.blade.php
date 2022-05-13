@extends('adminlte::page')
@section('css')
    <style>
        #link-grupo{
            color: black!important;
        }
        .grupo {
            margin-left: 2px;
            background-color: transparent !important;
            border-color: transparent !important;
        }

        .dropdown-menu{
            position: absolute!important;
            will-change: transform!important;
            top: -15px!important;
            left: 0px!important;
            transform: translate3d(-1px, -84px, 0px)!important;
        }

        .btn#b-escala {
            padding: 6px 1px !important;
            font-size: 9px !important;
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
        Escalas
        <small>Visualizar Escala Mensal</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('escala.consultar-escala')}}"> Escalas</a></li>
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
        <box boxtipo="box-success" boxtitulo="ESCALA MENSAL">
            <div class="container bloco ">
                <div class="row">
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

                    {{--<div class="col-md-1">--}}
                        {{--<div class="input-group-btn">--}}
                            {{--<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Imprimir--}}
                            {{--<span class="fa fa-caret-down"></span>--}}
                            {{--</button>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<a href="{{route('imprimir.escala', @$escala->id)}}" target='_blank'  id='link-grupo'>--}}
                                    {{--<button class="btn btn-xs grupo"> Escalas da Unidade/Setor</button>--}}
                                {{--</a>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<a href="{{route('escala.imprimir-alimentacao', @$escala->id)}}" target='_blank' id='link-grupo'>--}}
                                    {{--<button class="btn btn-xs grupo"> Relação para Ticket Alimentação</button>--}}
                                {{--</a>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<a href="{{route('escala.imprimir-frequencia-manual', @$escala->id)}}" target='_blank' id='link-grupo'>--}}
                                    {{--<button class="btn btn-xs grupo"> Frequencia Manual</button>--}}
                                {{--</a>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                        {{--<a href="{{route('imprimir.escala', @$escala->id)}}" target='_blank' class="btn btn-primary"><i--}}
                                    {{--class="fa fa-print"></i> Imprimir</a>--}}
                    {{--</div>--}}
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed" style="font-size: 10px;">
                        <tbody>
                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>INFORMAÇÕES
                                        ESCALA</strong></label>
                            </td>
                        </tr>

                        <!-- Bloco Identificação -->

                        <tr>
                            <td colspan="3"><strong>Período:</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{ @$escala->periodo }}
                            </td>
                            <td colspan="4"><strong>Unidade:</strong>&nbsp;&nbsp;{{ @$escala->unidade->nome }}</td>
                            <td colspan="3"><strong>Setor:</strong>&nbsp;&nbsp;{{ @$escala->setor->nome }}</td>
                        </tr>

                        <tr>
                            <td colspan="3"><strong>Turno:</strong>&nbsp;&nbsp;{{ @$escala->turno }}
                            </td>
                            <td colspan="7"><strong>Cargo:</strong>&nbsp;&nbsp;{{ @$escala->cargo->descricao }}</td>
                        </tr>


                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>TOTAL DE ESCALAS POR DIA</strong></label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <div class="input-group col-md-12">
                                    @foreach($dias as $dia)
                                        <span class="button-checkbox input-group-btn">
                                            <button type="button" class="btn escala-botao"
                                                    id="b-escala"
                                                    data-color="primary">{{$dia['nome_dia']}}
                                                <br>{{$dia['dia']}}
                                            </button>

                                    </span>

                                    @endforeach
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="10">
                                <div class="input-group col-md-12">
                                    @foreach($dias as $dia)
                                        <span class="button-checkbox input-group-btn">
                                            <button type="button" class="btn escala-botao"
                                                    id="b-escala"
                                            >
                                                <br><strong>{{$dia['total_plantoes']}}</strong>
                                            </button>

                                    </span>

                                    @endforeach
                                </div>
                            </td>
                        </tr>

                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>PROFISSIONAIS</strong></label>
                            </td>
                        </tr>
                        @foreach($escala->colaboradores as $colaborador)

                            {{--{{dd(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias))}}--}}

                            <tr>
                                <td colspan="3"><strong>Nome:</strong>&nbsp;&nbsp;{{ @$colaborador->nome }}</td>
                                <td colspan="2">
                                    <strong>Conselho:</strong>&nbsp;&nbsp;{{ @$colaborador->conselhoProfissional->numero_conselho }}
                                </td>
                                <td colspan="2"><strong>Contato:</strong>&nbsp;&nbsp;23423423423423</td>
                                <td colspan="2">
                                    <strong>Horário:</strong>&nbsp;&nbsp;{{ @$colaborador->horarioTrabalhoIntervalo->horarioTrabalho->inicio_expediente.' às '. @$colaborador->horarioTrabalhoIntervalo->horarioTrabalho->fim_expediente}}
                                </td>
                                <td colspan="1">
                                    <strong>Vale-Transporte:</strong>&nbsp;&nbsp;{{ @$colaborador->admissao->vale_transporte_desconto == 1 ? 'SIM' : 'NÃO' }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="10" class="text-center" style="border-bottom: #0d3349"><label
                                            for=""><strong>DATAS</strong></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <div class="input-group col-md-12">
                                        @foreach($dias as $dia)
                                            @foreach(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias) as $selecionado)
                                                {{--{{dd($selecionado)}}--}}
                                                @if($selecionado == $dia['dia'])

                                                    <input type="hidden" value="{{$dia['status'] = 'selecionado'}}">
                                                    {{--@else--}}
                                                    {{--<span class="button-checkbox input-group-btn">--}}
                                                    {{--<button type="button" class="btn escala-botao"--}}
                                                    {{--id="b-escala"--}}
                                                    {{--data-color="primary">{{$dia['nome_dia']}}--}}
                                                    {{--<br>{{$dia['dia']}}--}}
                                                    {{--</button>--}}

                                                    {{--</span>--}}
                                                @endif
                                            @endforeach

                                            @foreach($dias_licencas as $licenca)
                                                @if($colaborador->id == $licenca['colaborador_id'])
                                                    @foreach($licenca['dias'] as $l)

                                                        @if($l['dia'] == $dia['dia'])

                                                            <input type="hidden" value="{{$dia['status'] = 'licenca'}}">
                                                            {{--@else--}}
                                                            {{--<span class="button-checkbox input-group-btn">--}}
                                                            {{--<button type="button" class="btn escala-botao"--}}
                                                            {{--id="b-escala"--}}
                                                            {{--data-color="primary">{{$dia['nome_dia']}}--}}
                                                            {{--<br>{{$dia['dia']}}--}}
                                                            {{--</button>--}}

                                                            {{--</span>--}}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach


                                            @foreach($feriados as $feriado)


                                                @if($feriado['dia'] == $dia['dia'])
                                                    <input type="hidden" value="{{$dia['inf_feriado'] = ' - F'}}">
                                                @endif


                                            @endforeach



                                            <span class="button-checkbox input-group-btn">
                                                    <button type="button" class="btn escala-botao {{$dia['status']}}"
                                                            id="b-escala"
                                                            data-color="primary">{{$dia['nome_dia']}}
                                                        <br>{{$dia['dia']}}{{$dia['inf_feriado']}}
                                                    </button>

                                                </span>

                                        @endforeach


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 text-left" style="padding-left: 1px">
                                            <div class="legend">
                                                <ul>
                                                    <li>
                                                        @foreach($feriados as $feriado)
                                                            <i><span
                                                                ></span>{{$feriado['data']}} - {{$feriado['descricao']}}
                                                                &nbsp;&nbsp;&nbsp;&nbsp;</i>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=" col-md-6 text-right">
                                            <div class="legend">
                                                <ul>
                                                    <li><span
                                                        ></span>F - FERIADO&nbsp;&nbsp;&nbsp;&nbsp;<span
                                                                style="background-color:#178D7B"></span>PLANTÃO&nbsp;&nbsp;&nbsp;&nbsp;<span
                                                                style="background-color:#db5461"></span>FÉRIAS/LICENÇA
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10" class="text-right"><strong>TOTAL
                                        PLANTÕES: {{count(array_filter(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias)))}}</strong>

                                </td>

                            </tr>


                        @endforeach
                        <br>
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

