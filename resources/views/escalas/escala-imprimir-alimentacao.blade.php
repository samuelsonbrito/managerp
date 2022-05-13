<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Escala</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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

    <table width="100%" style="padding-top: 15px; padding-left: 13px; padding-right: 15px">

        <tr>
            <td align="left">
                <img src="{{public_path('assets/img/logosegeam.png')}}" alt="Logo" width="75" class="logo"/>
            </td>
            <td align="right" style="width: 60%;">
                <h5 style="padding-bottom: -15px" align="right"><b >SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS<b/></h5>
                <hr style="padding-bottom: -11px">
                <h6 align="right"><p style="padding-bottom: -13px; font-size: 12px">UNIDADE: {{ @$escala->unidade->nome }}</p></h6>
                <h6 align="right"><p style="font-size: 12px">TURNO: {{ @$escala->turno }}</p></h6>
                </pre>
            </td>
        </tr>

    </table>
</div>



<div class="box-success">


    <div class="card-block">
        <div class="box-body">
            <div class="col-sm-12 col-md-12">
                <div class="container bloco ">





                        <!-- Bloco Identificação -->


                        @foreach($escala->colaboradores as $colaborador)

                            @foreach($dias as $dia)


                                @foreach(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias) as $selecionado)
                                    @if($selecionado == $dia['dia'])
                                    <table class="table table-bordered table-condensed">
                                        <tbody>

                                        <tr bgcolor="#C0E7E1">
                                            <td colspan="15" class="text-center"><strong>RELAÇÃO DE FUNCIONÁRIOS PARA ALIMENTAÇÃO - {{$dia['dia']}}/{{$escala->periodo}}
                                                </strong>
                                            </td>
                                        </tr>

                                        <tr bgcolor="#ecf0f5">
                                            <td colspan="15" class="text-center"><strong>CARGO: {{$escala->cargo->descricao}} -  {{@$escala->turno == 'DIURNO' ? 'DEJEJUM ENTRADA' : 'DEJEJUM SAÍDA'}}
                                                </strong>
                                            </td>
                                        </tr>

                                            <tr>
                                                <th colspan="1" class="text-center">MATRÍCULA</th>
                                                <th colspan="6" class="text-center">NOME</th>
                                                <th colspan="2" class="text-center">HORÁRIO</th>
                                                <th colspan="6" class="text-center">ASSINATURA</th>
                                            </tr>

                                        <tr>
                                            <th colspan="1" class="text-center">{{@$colaborador->matricula}}</th>
                                            <th colspan="6" class="text-left">&nbsp;{{ @$colaborador->nome }}</th>
                                            <th colspan="2" class="text-center"></th>
                                            <th colspan="6" class="text-center"></th>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered table-condensed">
                                        <tbody>

                                        <tr bgcolor="#C0E7E1">
                                            <td colspan="15" class="text-center"><strong>RELAÇÃO DE FUNCIONÁRIOS PARA ALIMENTAÇÃO - {{$dia['dia']}}/{{$escala->periodo}}
                                                </strong>
                                            </td>
                                        </tr>

                                        <tr bgcolor="#ecf0f5">
                                            <td colspan="15" class="text-center"><strong>CARGO: {{$escala->cargo->descricao}} -  {{@$escala->turno == 'DIURNO' ? 'ALMOÇO' : 'JANTAR'}}
                                                </strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th colspan="1" class="text-center">MATRÍCULA</th>
                                            <th colspan="6" class="text-center">NOME</th>
                                            <th colspan="2" class="text-center">HORÁRIO</th>
                                            <th colspan="6" class="text-center">ASSINATURA</th>
                                        </tr>


                                        <tr>
                                            <th colspan="1" class="text-center">{{@$colaborador->matricula}}</th>
                                            <th colspan="6" class="text-left">&nbsp;{{ @$colaborador->nome }}</th>
                                            <th colspan="2" class="text-center"></th>
                                            <th colspan="6" class="text-center"></th>
                                        </tr>

                                        </tbody>
                                    </table>



                                    @endif
                                @endforeach




                            @endforeach
                        @endforeach


                        <br>

                </div>

            </div>


        </div>
    </div>
</div>


</body>
</html>





