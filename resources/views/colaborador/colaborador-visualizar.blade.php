@extends('adminlte::page')
@section('css')
    <style>


        * {
            margin: 0;
            box-sizing: border-box;
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
        /*table{*/
            /*font-size: 10px;*/
            /*!*margin-bottom: 30px;*!*/
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
        Gerenciamento Admissional
        <small>Gerencie os Colaboradores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('colaborador.index')}}"></i> Colaboradores</a></li>
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
        <box boxtipo="box-success" boxtitulo="COLABORADOR - MATRÍCULA: {{ $colaborador->matricula }}">
            <div class="container bloco ">
                <div class="row" style="margin-bottom: 1.5rem">
                    <div class="col-md-12">
                        <a href="{{route('imprimir.colaborador', $colaborador->id)}}"  target='_blank' class="btn btn-primary"><i
                                    class="fa fa-print"></i> Imprimir</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed" style="font-size: 10px;">
                        <tbody>
                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>INFORMAÇÕES PESSOAIS</strong></label>
                            </td>
                        </tr>

                        <!-- Bloco Identificação -->

                        <tr>
                            <td colspan="3"><strong>Nome:</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{ $colaborador->nome }}</td>
                            <td colspan="2"><strong>Data de
                                    Nascimento:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador->data_nascimento) }}</td>
                            <td colspan="3"><strong>Nacionalidade:</strong>&nbsp;&nbsp;{{ $colaborador->nacionalidade }}
                            </td>
                            <td colspan="2"><strong>UF:</strong>&nbsp;&nbsp;{{ $colaborador->estado_nascimento }}</td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>Cidade de
                                    Nascimento:</strong>&nbsp;&nbsp;{{ $colaborador->local_nascimento }}</td>
                            <td colspan="1"><strong>Raça e Cor:</strong>&nbsp;&nbsp;{{ $colaborador->raca_cor }}</td>
                            <td colspan="3"><strong>Estado Civil:</strong>&nbsp;&nbsp;{{ $colaborador->estado_civil }}</td>
                            <td colspan="4"><strong>Grau de Instrução:</strong>&nbsp;&nbsp;{{$colaborador->grau_instrucao}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Fone Contato:</strong>&nbsp;&nbsp;{{$colaborador->fone_contato}}
                            </td>
                            <td colspan="4"><strong>Residêcia
                                    Própria:</strong>&nbsp;&nbsp;{{$colaborador->residencia_propria == 1 ? 'SIM' : 'NÃO'}}
                            </td>
                            <td colspan="4"><strong>Comprada com Recursos do
                                    FGTS:</strong>&nbsp;&nbsp;{{$colaborador->recurso_fgts == 1 ? 'SIM' : 'NÃO'}}</td>
                        </tr>

                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>ENDEREÇO</strong></label></td>
                        </tr>

                        <tr>
                            <td colspan="1"><strong>Cep:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->cep }}</td>
                            <td colspan="2"><strong>Cidade:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->cidade }}</td>
                            <td colspan="1"><strong>UF:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->uf }}</td>
                            <td colspan="3"><strong>Rua:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->rua }}</td>
                            <td colspan="1"><strong>Número:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->numero }}</td>
                            <td colspan="2"><strong>Bairro:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->bairro }}</td>
                        </tr>
                        <tr>
                            <td colspan="10"><strong>Complemento:</strong>&nbsp;&nbsp;{{ $colaborador['endereco']->complemento }}</td>
                        </tr>


                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>INFORMAÇÕES FAMILIAR</strong></label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Nome do Pai:</strong>&nbsp;&nbsp;{{ $colaborador->nome_pai }}</td>
                            <td colspan="7"><strong>Nome da Mãe:</strong>&nbsp;&nbsp;{{ $colaborador->nome_mae }}</td>
                        </tr>
                        @if(!empty($colaborador['dependentes']))
                            <tr>
                                <td colspan="10" class="text-center" style="border-bottom: #0d3349"><label for=""><strong>DEPENDENTES</strong></label></td>
                            </tr>
                        @endif
                        @foreach($colaborador['dependentes'] as $dependente)
                            <tr>
                                <td colspan="3"><strong>Nome: </strong>&nbsp;&nbsp;{{ $dependente->nome}}</td>
                                <td colspan="4"><strong>CPF:</strong>&nbsp;&nbsp;{{ $dependente->cpf}}</td>
                                <td colspan="3"><strong>Data de Nascimento:</strong>&nbsp;&nbsp;{{ bdToBr($dependente->data_nascimento)}}</td>
                            </tr>
                        @endforeach


                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>DADOS DA ADMISSÃO</strong></label>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>Salário:</strong>&nbsp;&nbsp;R$ {{ $colaborador['admissao']->salario }}</td>
                            <td colspan="1"><strong>Cargo:</strong>&nbsp;&nbsp;{{ $cargos[$colaborador['admissao']->cargo_id] }}</td>
                            <td colspan="2"><strong>Data de Admissão:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['admissao']->data_admissao) }}</td>
                            <td colspan="5"><strong>Regime de Trabalho:</strong>&nbsp;&nbsp;{{ $colaborador['admissao']->regime_trabalho }}</td>

                        </tr>
                        <tr>
                            <td colspan="3"><strong>Horário de Trabalho:</strong>&nbsp;&nbsp; {{$horarios->getHorarioTrabalho($colaborador['horarioTrabalhoIntervalo']->h_trabalho_id)['descricao_periodo']
                                .' - '.$horarios->getHorarioTrabalho($colaborador['horarioTrabalhoIntervalo']->h_trabalho_id)['inicio_expediente']
                                .' às '.$horarios->getHorarioTrabalho($colaborador['horarioTrabalhoIntervalo']->h_trabalho_id)['fim_expediente'] }}</td>


                            <td colspan="3"><strong>Intervalo de Trabalho:</strong>&nbsp;&nbsp;
                                {{$intervalo->getHorarioIntervalo($colaborador['horarioTrabalhoIntervalo']->i_trabalho_id)['hora_inicial']
                                                                .' às '.$intervalo->getHorarioIntervalo($colaborador['horarioTrabalhoIntervalo']->i_trabalho_id)['hora_final'] }}
                            </td>

                            <td colspan="4"><strong>Exame Admissional:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['admissao']->data_exame_admissional) }}</td>
                        </tr>


                        <tr>
                            <td colspan="2"><strong>Primeiro Emprego:</strong>&nbsp;&nbsp; {{ $colaborador['admissao']->primeiro_emprego == 1 ? 'SIM' : 'NÃO' }}</td>
                            <td colspan="1"><strong>Readmissão:</strong>&nbsp;&nbsp;{{ $colaborador['admissao']->readmissao == 1 ? 'SIM' : 'NÃO' }}</td>
                            <td colspan="3"><strong>Experiência:</strong>&nbsp;&nbsp;{{ $experiencias[$colaborador['admissao']->experiencia_id] }}</td>
                            <td colspan="4"><strong>Contrato Registrado em Outra Empresa:</strong>&nbsp;&nbsp;{{ $colaborador['admissao']->contrato_registrado_outra_empresa == 1 ? 'SIM' : 'NÃO' }}</td>
                        </tr>
                        <tr>
                            <td colspan="12"><strong>Vale Transporte, proceder com o Desconto:</strong>&nbsp;&nbsp;{{ $colaborador['admissao']->vale_transporte_desconto == 1 ? 'SIM' : 'NÃO' }}</td>
                        </tr>
                        <!-- Fim Bloco Ensino Médio -->

                        <!-- Bloco Curso -->
                        <tr bgcolor="#C0E7E1">
                            <td colspan="10" class="text-center"><label for=""><strong>DOCUMENTOS</strong></label></td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>CPF:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->cpf }}</td>
                            <td colspan="1"><strong>RG:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->rg }}</td>
                            <td colspan="3"><strong>Orgão Emissor/UF:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->orgao_emissor }}</td>
                            <td colspan="4"><strong>Data de Expedição:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->rg_data_emissao) }}</td>
                        </tr>

                        <tr>
                            <td colspan="2"><strong>CTPS:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->pis }}</td>
                        <td colspan="1"><strong>Série:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->data_inscricao_pis) }}</td>
                        <td colspan="3"><strong>UF:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor }}</td>
                        <td colspan="4"><strong>Data de Emissão:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor_zona }}</td>

                    </tr>
                    @if(!empty($colaborador['documento']->cnh_numero))
                        <tr>
                            <td colspan="2"><strong>CNH:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->cnh_numero }}</td>
                            <td colspan="1"><strong>Categoria:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->cnh_categoria }}</td>
                            <td colspan="3"><strong>Data de Validade:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->cnh_data_validade) }}</td>
                            <td colspan="4"><strong>Data de Emissão:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->cnh_data_emissao) }}</td>
                        </tr>
                    @endif
                    @if(!empty($colaborador['documento']->certificado_reservista))
                        <tr>
                            <td colspan="2"><strong>Certificado Reservista:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->certificado_reservista }}</td>
                            <td colspan="1"><strong>Série:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->certificado_reservista_serie }}</td>
                            <td colspan="7"><strong>Categoria do Certificado de Reservista:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->certificado_reservista_categoria }}</td>

                        </tr>
                    @endif
                    <tr>
                        <td colspan="2"><strong>PIS:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->pis }}</td>
                        <td colspan="1"><strong>Data de Inscrição(PIS):</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['documento']->data_inscricao_pis) }}</td>
                        <td colspan="3"><strong>Título de Eleitor:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor }}</td>
                        <td colspan="1"><strong>Zona:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor_zona }}</td>
                        <td colspan="1"><strong>Seção:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor_secao }}</td>
                        <td colspan="2"><strong>UF:</strong>&nbsp;&nbsp;{{ $colaborador['documento']->titulo_eleitor_uf }}</td>
                    </tr>
                    @if(!empty($colaborador['conselhoProfissional']))
                        <tr>
                            <td colspan="3"><strong>Conselho Profissional:</strong>&nbsp;&nbsp;{{ $conselhos[$colaborador['conselhoProfissional']->conselho_id] }}</td>
                            <td colspan="2"><strong>Número do Conselho:</strong>&nbsp;&nbsp;{{ $colaborador['conselhoProfissional']->numero_conselho }}</td>
                            <td colspan="4"><strong>Data de Emissão:</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['conselhoProfissional']->data_emissao) }}</td>
                            <td colspan="1"><strong>UF:</strong>&nbsp;&nbsp;{{$colaborador['conselhoProfissional']->uf}}</td>
                        </tr>
                        <tr>
                            <td colspan="10"><strong>Data Vencimento(Conselho):</strong>&nbsp;&nbsp;{{ bdToBr($colaborador['conselhoProfissional']->data_validade) }}</td>
                        </tr>
                    @endif
                        
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

