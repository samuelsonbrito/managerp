@inject('horarios','App\Services\HorarioTrabalhoService')
@inject('intervalo','App\Services\IntervaloService')
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
            margin-left: -30px;
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
                <h5 style="padding-bottom: -15px" align="right"><b >SERVIÇOS DE ENFERMAGEM E GESTÃO EM SAÚDE DO AMAZONAS</b></h5>
                <hr style="padding-bottom: -11px">
                <h6 align="right"><p style="padding-bottom: -13px; font-size: 12px">RELATÓRIO COLABORADOR</p></h6>
                <h6 align="right"><p style="font-size: 12px">GERADO EM {{date('d/m/Y')}}</p></h6>

            </td>
        </tr>

    </table>
</div>


<div class="box-success">
    <h6 style="margin-left: 3.2rem; font-size: 8px">COLABORADOR - MATRÍCULA: {{ $colaborador->matricula }}</h6>

    <div class="card-block">
        <div class="box-body">
            <div class="col-sm-12 col-md-12">
                <div class="container bloco ">

                    <table class="table table-bordered table-condensed">
                        <tbody>

                        <tr  bgcolor="#60A7A6" style="color:whitesmoke;">
                            <td class="text-center" colspan="10"><strong>INFORMAÇÕES PESSOAIS</strong></td>
                        </tr>

                        <!-- Bloco Identificação -->

                        <tr>
                            <td colspan="3"><strong>NOME:</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{ $colaborador->nome }}</td>
                            <td colspan="4"><strong>DATA DE NASCIMENTO:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador->data_nascimento) }}</td>
                            <td colspan="2"><strong>NACIONALIDADE:</strong>&nbsp;&nbsp;{{ $colaborador->nacionalidade }}
                            </td>
                            <td colspan="1" class="text-right" style="text-align: right;"><strong>UF:</strong>&nbsp;&nbsp;{{ $colaborador->estado_nascimento }}</td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>CIDADE:</strong>&nbsp;&nbsp;{{ $colaborador->local_nascimento }}</td>
                            <td colspan="2"><strong>RAÇA E COR:</strong>&nbsp;&nbsp;{{ $colaborador->raca_cor }}</td>
                            <td colspan="5"><strong>GRAU DE INSTRUÇÃO:</strong>&nbsp;&nbsp;{{$colaborador->grau_instrucao}}
                            <td colspan="2" style="text-align: right;"><strong>ESTADO CIVIL:</strong>&nbsp;&nbsp;{{ $colaborador->estado_civil }}</td>

                        </tr>
                        <tr>
                            <td colspan="2"><strong>FONE CONTATO:</strong>&nbsp;&nbsp;{{$colaborador->fone_contato}}
                            </td>
                            <td colspan="4"><strong>RESIDÊNCIA PRÓPRIA:</strong>&nbsp;&nbsp;{{$colaborador->residencia_propria == 1 ? 'SIM' : 'NÃO'}}
                            </td>
                            <td colspan="4"><strong>COMPRADA COM RECURSOS DO FGTS:</strong>&nbsp;&nbsp;{{$colaborador->recurso_fgts == 1 ? 'SIM' : 'NÃO'}}</td>
                        </tr>

                        <tr bgcolor="#60A7A6" style="color:whitesmoke;">
                            <td class="text-center" colspan="10"><strong>ENDEREÇO</strong></td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>CEP:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->cep }}</td>
                            <td colspan="2"><strong>CIDADE:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->cidade }}</td>
                            <td colspan="2"><strong>UF:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->uf }}</td>
                            <td colspan="4"><strong>RUA:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->rua }}</td>
                            <td colspan="1"><strong>NÚMERO:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->numero }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>BAIRRO:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->bairro }}</td>
                            <td colspan="7"><strong>COMPLEMENTO:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->complemento }}</td>
                        </tr>


                        <tr bgcolor="#60A7A6" style="color:whitesmoke;">
                            <td colspan="10" class="text-center"><strong>INFORMAÇÕES FAMILIAR</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5"><strong>NOME DO PAI:</strong>&nbsp;&nbsp;{{ $colaborador->nome_pai }}</td>
                            <td colspan="5"><strong>NOME DA MÃE:</strong>&nbsp;&nbsp;{{ $colaborador->nome_mae }}</td>
                        </tr>

                        @if(!empty($colaborador['dependentes']))
                            <tr>
                                <td class="text-center" colspan="10"><strong>DEPENDENTES</strong></td>
                            </tr>
                        @endif

                        @foreach($colaborador['dependentes'] as $dependente)
                            <tr>
                                <td colspan="3" ><strong>NOME: </strong>&nbsp;&nbsp;{{ $dependente->nome}}</td>
                                <td colspan="4" ><strong>CPF:</strong>&nbsp;&nbsp;{{ $dependente->cpf}}</td>
                                <td colspan="3"><strong>DATA DE NASCIMENTO:</strong>&nbsp;&nbsp;{{ bdToBr($dependente->data_nascimento)}}</td>
                            </tr>
                        @endforeach


                        <tr bgcolor="#60A7A6" style="color:whitesmoke;">
                            <td colspan="10" class="text-center"><strong>DADOS DA ADMISSÃO</strong>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>CARGO:</strong>&nbsp;&nbsp;{{ $cargos[$colaborador['admissao']->cargo_id] }}</td>
                            <td colspan="2"><strong>SALÁRIO:</strong>&nbsp;&nbsp;R$ {{ $colaborador['admissao']->salario }}</td>
                            <td colspan="4"><strong>DATA DE ADMISSÃO:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['admissao']->data_admissao) }}</td>
                            <td colspan="3"><strong>EXAME ADMISSIONAL:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['admissao']->data_exame_admissional) }}</td>


                        </tr>
                        <tr>
                            <td colspan="3"><strong>CONTRATO REGISTRADO EM OUTRA EMPRESA:</strong>&nbsp;&nbsp;{{ $colaborador['admissao']->contrato_registrado_outra_empresa == 1 ? 'SIM' : 'NÃO' }}</td>
                            <td colspan="2"><strong>READMISSÃO:</strong>&nbsp;&nbsp;{{ $colaborador['admissao']->readmissao == 1 ? 'SIM' : 'NÃO' }}</td>
                            <td colspan="3"><strong>PRIMEIRO EMPREGO:</strong>&nbsp;&nbsp; {{ $colaborador['admissao']->primeiro_emprego == 1 ? 'SIM' : 'NÃO' }}</td>
                            <td colspan="2"><strong>EXPERIÊNCIA:</strong>&nbsp;&nbsp;{{ $experiencias[$colaborador['admissao']->experiencia_id] }}</td>
                        </tr>
                        <tr>
                            <td colspan="1"><strong>REGIME:</strong>&nbsp;&nbsp;{{ $colaborador['admissao']->regime_trabalho }}</td>
                            <td colspan="6"><strong>HORÁRIO DE TRABALHO:</strong>&nbsp;&nbsp;
                                {{$horarios->getHorarioTrabalho($colaborador['horarioTrabalhoIntervalo']->h_trabalho_id)['descricao_periodo']
                           .' - '.$horarios->getHorarioTrabalho($colaborador['horarioTrabalhoIntervalo']->h_trabalho_id)['inicio_expediente']
                           .' às '.$horarios->getHorarioTrabalho($colaborador['horarioTrabalhoIntervalo']->h_trabalho_id)['fim_expediente'] }}
                            </td>
                            <td colspan="3"><strong>INTERVALO:</strong>&nbsp;&nbsp;
                                {{$intervalo->getHorarioIntervalo($colaborador['horarioTrabalhoIntervalo']->i_trabalho_id)['hora_inicial']
                                                            . 'ÀS '.$intervalo->getHorarioIntervalo($colaborador['horarioTrabalhoIntervalo']->i_trabalho_id)['hora_final'] }}
                            </td>

                        </tr>

                        <tr>
                            <td colspan="10"><strong>VALE TRANSPORTE, PROCEDER COM O DESCONTO:</strong>&nbsp;&nbsp;{{ $colaborador['admissao']->vale_transporte_desconto == 1 ? 'SIM' : 'NÃO' }}</td>
                        </tr>

                        <tr bgcolor="#60A7A6" style="color:whitesmoke;">
                            <td class="text-center" colspan="10"><strong>DOCUMENTOS</strong></td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>CPF:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->cpf }}</td>
                            <td colspan="1"><strong>RG:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->rg }}</td>
                            <td colspan="4"><strong>ORGÃO EMISSOR/UF:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->orgao_emissor }}</td>
                            <td colspan="3"><strong>DATA DE EXPEDIÇÃO:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->rg_data_emissao) }}</td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>CTPS:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->pis }}</td>
                            <td colspan="1"><strong>SÉRIE:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->data_inscricao_pis) }}</td>
                            <td colspan="4"><strong>UF:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor }}</td>
                            <td colspan="3"><strong>DATA DE EMISSÃO:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor_zona }}</td>

                        </tr>
                        @if(!empty($colaborador['documento']->cnh_numero))
                            <tr>
                                <td colspan="1"><strong>CNH:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->cnh_numero }}</td>
                                <td colspan="1"><strong>CATEGORIA:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->cnh_categoria }}</td>
                                <td colspan="4"><strong>DATA DE VALIDADE:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->cnh_data_validade) }}</td>
                                <td colspan="4"><strong>DATA DE EMISSÃO:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->cnh_data_emissao) }}</td>
                            </tr>
                        @endif
                        @if(!empty($colaborador['documento']->certificado_reservista))
                            <tr>
                                <td colspan="3"><strong>CERTIFICADO DE RESERVISTA:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->certificado_reservista }}</td>
                                <td colspan="2"><strong>SÉRIE:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->certificado_reservista_serie }}</td>
                                <td colspan="5"><strong>CATEGORIA DO CERTIFICADO DE RESERVISTA:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->certificado_reservista_categoria }}</td>

                            </tr>
                        @endif
                        <tr>
                            <td colspan="2"><strong>TÍTULO DE ELEITOR:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor }}</td>
                            <td colspan="1"><strong>ZONA:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor_zona }}</td>
                            <td colspan="2"><strong>SEÇÃO:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor_secao }}</td>
                            <td colspan="2"><strong>UF:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor_uf }}</td>
                            <td colspan="1"><strong>PIS:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->pis }}</td>
                            <td colspan="2"><strong>INSCRIÇÃO(PIS):</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->data_inscricao_pis) }}</td>
                        </tr>
                        @if(!empty($colaborador['conselhoProfissional']))
                            <tr>
                                <td colspan="4"><strong>CONSELHO PROFISSIONAL:</strong>&nbsp;&nbsp;{{ $conselhos[$colaborador['conselhoProfissional']->conselho_id] }}</td>
                                <td colspan="4"><strong>NÚMERO DO CONSELHO:</strong>&nbsp;&nbsp;{{ $colaborador['conselhoProfissional']->numero_conselho }}</td>
                                <td colspan="2"><strong>DATA DE EMISSÃO:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['conselhoProfissional']->data_emissao) }}</td>
                            </tr>
                            <tr>

                                <td colspan="1"><strong>UF(CONSELHO):</strong>&nbsp;&nbsp;{{$colaborador['conselhoProfissional']->uf}}</td>
                                <td colspan="9"><strong>DATA VENCIMENTO(CONSELHO):</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['conselhoProfissional']->data_validade) }}</td>
                            </tr>
                        @endif




                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>





