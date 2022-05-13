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



        @font-face {
            font-family: 'Droid';
            font-style: normal;
            font-weight: normal;
            src: url('dompdf/lib/fonts/DroidSansFallback.ttf') format('truetype');
        }



        #conteudo-tabela {

            margin-top: 30px;
            width: 750px;
            margin-left: 50px;

        }
        #cabecalho {
            width: 730px;
            margin: auto;
            margin-bottom: 70px;
        }

        #conteudo-tabela #th-conteudo, #td-conteudo {
            padding: 8px 14px 8px 14px;
            border: 1px solid #333;
        }

        .text-center {
            text-align: center;
        }
        #tr-conteudo{
            background: #d7dbe0;
        }
        #titulo-1{
            background: #60A7A6;
            color: whitesmoke;
            font-weight: bolder;
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
                <h5 style="padding-bottom: -15px" align="right"><b >SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS</b></h5>
                <hr style="padding-bottom: -11px">
                <h6 align="right"><p style="padding-bottom: -13px; font-size: 12px">RELATÓRIO COLABORADOR / SETORES</p></h6>
                <h6 align="right"><p style="font-size: 12px">GERADO EM {{date('d/m/Y')}}</p></h6>

            </td>
        </tr>

    </table>
</div>
<table id="conteudo-tabela">
    <thead>
    <tr id="titulo-1">
        <th colspan="4"  class="text-center" id="th-conteudo">HISTÓRICO DOS SETORES DO COLABORADOR</th>

    </tr>
    </thead>
    <thead>
    <tr id="tr-conteudo">
        <th id="th-conteudo">COLABORADOR</th>
        <th id="th-conteudo">SETOR</th>
        <th id="th-conteudo">DATA ENTRADA</th>
        <th id="th-conteudo">DATA SAÍDA</th>
    </tr>
    </thead>
    <tbody>

    @foreach($dados as $dado)
        @if($dado->data_saida != null)
            <tr>
                <td id="td-conteudo">{{$dado->nome_colaborador}}</td>
                <td id="td-conteudo">{{$dado->nome_setor}}</td>
                <td id="td-conteudo">{{$dado->data_entrada}}</td>
                <td id="td-conteudo">{{$dado->data_saida}}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
<br>
<br>
<br>
<table id="conteudo-tabela">
    <thead>
    <tr id="titulo-1">
        <th colspan="3"  class="text-center" id="th-conteudo">SETORES ATUAIS DO COLABORADOR</th>

    </tr>
    </thead>
    <thead>
    <tr id="tr-conteudo">
        <th id="th-conteudo">COLABORADOR</th>
        <th id="th-conteudo">SETOR</th>
        <th id="th-conteudo">DATA ENTRADA</th>
    </tr>
    </thead>
    <tbody>

    @foreach($dados as $dado)
        @if($dado->data_saida == null)
            <tr>
                <td id="td-conteudo">{{$dado->nome_colaborador}}</td>
                <td id="td-conteudo">{{$dado->nome_setor}}</td>
                <td id="td-conteudo">{{$dado->data_entrada}}</td>

            </tr>
@endif
@endforeach
</body>
</html>





