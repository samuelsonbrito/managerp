<?php

namespace App\Services;

use App\Models\{Colaborador, ColaboradorHorarioTrabalhoIntervalo, HistoricoColaboradorSetor, LicencaColaborador, Setor};
use App\Repositories\Colaborador\ColaboradorRepositoryEloquent as ColaboradorRepository;
use App\Repositories\Dependente\DependenteRepositoryEloquent as DependenteRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\{DB, Storage};
use Illuminate\Support\Str;
use Throwable;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\Anexo\AnexoRepositoryEloquent as AnexoRepository;
use App\Repositories\ColaboradorConselhoProfissional\ColaboradorConselhoProfissionalRepositoryEloquent as ColaboradorConselhoRepository;
use App\Repositories\Documento\DocumentoRepositoryEloquent as DocumentoRepository;
use App\Repositories\Endereco\EnderecoRepositoryEloquent as EnderecoRepository;
use App\Repositories\HorarioTrabalho\HorarioTrabalhoRepositoryEloquent as HorarioTrabalhoRepository;
use App\Repositories\Intervalo\IntervaloRepositoryEloquent as IntervaloRepository;
use App\Repositories\Admissao\AdmissaoRepositoryEloquent as AdmissaoRepository;
use App\Repositories\ColaboradoHTrabalhoIntervalo\ColaboradorHTrabalhoIntervaloRepositoryEloquent;

class ColaboradorService
{
    private $colaboradorRepository;
    private $paisEstadoCidadeService;
    private $dependenteRepository;
    private $anexoRepository;
    private $colaboradorConselhoRepository;
    private $documentoRepository;
    private $enderecoRepository;
    private $horarioTrabalhoRepository;
    private $intervaloRepository;
    private $admissaoRepository;
    private $colaboradorHorarioTrabalhoIntervalo;

    function __construct(
        ColaboradorRepository $colaboradorRepository,
        PaisEstadoCidadeService $paisEstadoCidadeService,
        DependenteRepository $dependenteRepository,
        AnexoRepository $anexoRepository,
        ColaboradorConselhoRepository $colaboradorConselhoRepository,
        DocumentoRepository $documentoRepository,
        EnderecoRepository $enderecoRepository,
        HorarioTrabalhoRepository $horarioTrabalhoRepository,
        IntervaloRepository $intervaloRepository,
        AdmissaoRepository $admissaoRepository,
        ColaboradorHTrabalhoIntervaloRepositoryEloquent $colaboradorHorarioTrabalhoIntervalo
    )
    {
        $this->colaboradorRepository = $colaboradorRepository;
        $this->paisEstadoCidadeService = $paisEstadoCidadeService;
        $this->dependenteRepository = $dependenteRepository;
        $this->anexoRepository = $anexoRepository;
        $this->colaboradorConselhoRepository = $colaboradorConselhoRepository;
        $this->documentoRepository = $documentoRepository;
        $this->enderecoRepository = $enderecoRepository;
        $this->horarioTrabalhoRepository = $horarioTrabalhoRepository;
        $this->intervaloRepository = $intervaloRepository;
        $this->admissaoRepository = $admissaoRepository;
        $this->colaboradorHorarioTrabalhoIntervalo = $colaboradorHorarioTrabalhoIntervalo;
    }

    public function salvar($dados)
    {
        try {
            DB::beginTransaction();

            $colaborador = $this->salvarColaborador($dados);
            $admissao = $this->salvarDadosAdmissional($dados, $colaborador->id);
            $endereco = $this->salvarEndereco($dados, $colaborador->id);
            $dependentes = $this->salvarDependentes($dados, $colaborador->id);
            $documentos = $this->salvarDocumentos($dados, $colaborador->id);
            $anexos_colaborador = $this->salvarAnexosColaborador($dados, $colaborador->id);

            DB::commit();

            return [
                'status' => true,
                'message' => 'Colaborador Salvo Com Sucesso!',
                'data' => $dados = [
                    'colaborador' => $colaborador,
                    'dependentes' => $dependentes,
                    'documentos' => $documentos,
                    'anexos_colaborador' => $anexos_colaborador,
                    'endereco' => $endereco,
                    'admissao' => $admissao
                ]
            ];

        } catch (Throwable $throwable) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Não foi possível Cadastrar o Colaborador.', 'error' => $throwable->getMessage()
            ], 500));

        }
    }

    private function salvarColaborador($dados)
    {
        $postos['postos'] = @json_decode($dados['postos-hidden'], true);
        $colaborador['nome'] = $dados['nome'];
        $colaborador['fone_contato'] = limpaTelefone($dados['fone_contato']);
        $colaborador['matricula'] = $dados['matricula'] ? $dados['matricula'] : "";
        $colaborador['nome_pai'] = mb_strtoupper($dados['nome_pai']);
        $colaborador['nome_mae'] = mb_strtoupper($dados['nome_mae']);
        $colaborador['nacionalidade'] = nacionalidade($dados['nacionalidade']);
        $colaborador['estado_civil'] = $dados['estado_civil'];
        $colaborador['data_nascimento'] = dataBrParaOBanco($dados['data_nascimento']);
        $colaborador['local_nascimento'] = $dados['cidade_nascimento'];
        $colaborador['estado_nascimento'] = $dados['estado_nascimento'] ?? null;
        $colaborador['grau_instrucao'] = $dados['grau_instrucao'];
        $colaborador['raca_cor'] = $dados['raca_cor'];
        $colaborador['residencia_propria'] = $dados['residencia_propria'];
        $colaborador['recurso_fgts'] = $dados['recurso_fgts'] ?? null;

        try {
            if ($dados['colaborador_id']) {
                $colaborador['updated_by'] = auth()->user()->id;
                $colaborador = $this->colaboradorRepository->update($colaborador, $dados['colaborador_id']);
            } else {
                $colaborador['created_by'] = auth()->user()->id;
                $colaborador['updated_by'] = auth()->user()->id;
                $colaborador = $this->colaboradorRepository->create($colaborador);

                if (!empty($postos['postos']) && count($postos['postos']) >= 1) {
                    foreach ($postos['postos'] as $posto) {
                        $colaborador = Colaborador::find($colaborador->id);
                        $setor = Setor::find($posto['id']);
                        $colaborador->setores()->attach($setor);
                        HistoricoColaboradorSetor::create([
                            'setor_id' => $setor->id,
                            'nome_setor' => $setor->nome,
                            'colaborador_id' => $colaborador->id,
                            'nome_colaborador' => $colaborador->nome,
                            'data_entrada' => date("Y-m-d"),
                        ]);
                    }
                }

            }
            return $colaborador;
        } catch (Throwable $ex) {
            throw new HttpResponseException(response()->json([
                'status' => false, 'message' => 'Não foi possível Salvar os Dados do Colaborador.', 'error' => $ex->getMessage()
            ], 500));
        }
    }

    private function salvarEndereco($dados, $colaborador_id)
    {
        $dados_endereco['rua'] = $dados['rua'];
        $dados_endereco['numero'] = $dados['numero'];
        $dados_endereco['bairro'] = $dados['bairro'];
        $dados_endereco['complemento'] = $dados['complemento'];
        $dados_endereco['cep'] = limpaCPF($dados['cep']);
        $dados_endereco['cidade'] = $dados['cidade'];
        $dados_endereco['uf'] = $dados['uf'];

        try {
            if ($dados['colaborador_id']) {
                $dados_endereco['updated_by'] = auth()->user()->id;
                $colaborador = $this->colaboradorRepository->find($dados['colaborador_id']);
                $endereco = $this->enderecoRepository->update($dados_endereco, $colaborador->endereco->id);
            } else {
                $dados_endereco['colaborador_id'] = $colaborador_id;
                $dados_endereco['created_by'] = auth()->user()->id;
                $dados_endereco['updated_by'] = auth()->user()->id;
                $endereco = $this->enderecoRepository->create($dados_endereco);
            }

            return $endereco;
        } catch (Throwable $ex) {
            throw new HttpResponseException(response()->json([
                'status' => false, 'message' => 'Não foi possível Salvar o Endereco do Colaborador.', 'error' => $ex->getMessage()
            ], 500));
        }
    }

    private function salvarDependentes($dados, $colaborador_id)
    {
        $dados_dependentes = @json_decode($dados['dependentes-hidden'], true);
        if (is_null($dados_dependentes)) {
            return false;
        } else {
            foreach ($dados_dependentes as $dado_dependente) {
                $dependente['nome'] = $dado_dependente['nome'];
                $dependente['data_nascimento'] = dataBrParaOBanco($dado_dependente['data_nasc']);
                $dependente['cpf'] = limpaCPF($dado_dependente['cpf']);
                $dependente['colaborador_id'] = $colaborador_id;
                $dependente['created_by'] = auth()->user()->id;
                $dependente['updated_by'] = auth()->user()->id;

                try {
                    $dependentes = $this->dependenteRepository->create($dependente);

                    if (array_key_exists($dado_dependente['id'], $dados)) {
                        $this->salvarAnexoDependentes($dados[$dado_dependente['id']], $dependentes->id);
                    }
                } catch (Throwable $ex) {
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Salvar os Dependentes e seus Anexos.', 'error' => $ex->getMessage()
                    ], 500));
                }
            }
        }

        return $dependentes;
    }

    private function salvarAnexoDependentes($dados, $dependente_id)
    {
        foreach ($dados as $key => $dado) {
            $dados_anexo['dependente_id'] = $dependente_id;
            $dados_anexo['nome'] = $dado->getClientOriginalName();
            $dados_anexo['created_by'] = auth()->user()->id;
            $dados_anexo['updated_by'] = auth()->user()->id;
            $nome_arquivo = uniqid() . "." . $dado->getClientOriginalExtension();
            $upload = $dado->storeAs('downloads', $nome_arquivo);
            $dados_anexo['url'] = 'downloads/' . $nome_arquivo;
            $salvar_anexo = $this->anexoRepository->create($dados_anexo);
        }
        return $salvar_anexo;
    }

    private function salvarAnexosColaborador($dados, $colaborador_id)
    {
        if (isset($dados['anexos'])) {
            foreach ($dados['anexos'] as $key => $value) {
                $dados_anexo['colaborador_id'] = $colaborador_id;
                $dados_anexo['nome'] = $dados['nomeanexo'][$key];
                $dados_anexo['created_by'] = auth()->user()->id;
                $dados_anexo['updated_by'] = auth()->user()->id;
                $nome_arquivo = uniqid() . "." . $value->getClientOriginalExtension();
                $upload = $value->storeAs('downloads', $nome_arquivo);
                $dados_anexo['url'] = 'downloads/' . $nome_arquivo;
                $salvar_anexo = $this->anexoRepository->create($dados_anexo);
            }
        } else {
            return null;
        }

        return $salvar_anexo;
    }

    private function salvarDocumentos($dados, $colaborador_id)
    {
        $dados_documentos['rg'] = limpaCPF($dados['rg']);
        $dados_documentos['orgao_emissor'] = $dados['orgao_emissor'];
        $dados_documentos['rg_data_emissao'] = dataBrParaOBanco($dados['data_expedicao_rg']);
        $dados_documentos['cpf'] = limpaCPF($dados['cpf']);
        $dados_documentos['pis'] = $dados['pis'];
        $dados_documentos['data_inscricao_pis'] = dataBrParaOBanco($dados['data_pis']);
        $dados_documentos['titulo_eleitor'] = $dados['titulo'];
        $dados_documentos['titulo_eleitor_zona'] = $dados['zona'];
        $dados_documentos['titulo_eleitor_secao'] = $dados['secao'];
        $dados_documentos['titulo_eleitor_uf'] = $dados['uf_titulo'];
        $dados_documentos['ctps'] = $dados['ctps'];
        $dados_documentos['ctps_serie'] = $dados['serie_ctps'];
        $dados_documentos['ctps_uf'] = $dados['uf_ctps'];
        $dados_documentos['ctps_data_emissao'] = dataBrParaOBanco($dados['data_emissao_ctps']);
        $dados_documentos['certificado_reservista'] = $dados['certificado_reservista'];
        $dados_documentos['certificado_reservista_serie'] = $dados['serie_reservista'];
        $dados_documentos['certificado_reservista_categoria'] = $dados['categoria_reservista'];
        $dados_documentos['cnh_numero'] = $dados['cnh'];
        $dados_documentos['cnh_categoria'] = $dados['categoria_cnh'] ?? null;
        $dados_documentos['cnh_data_validade'] = dataBrParaOBanco($dados['validade_cnh']);
        $dados_documentos['cnh_data_emissao'] = dataBrParaOBanco($dados['emissao_cnh']);
        $dados_documentos['created_by'] = auth()->user()->id;
        $dados_documentos['updated_by'] = auth()->user()->id;
        // Dados de ColaboradoresConselhos
        $dados_conselho['conselho_id'] = $dados['conselho_profissional'] ?? null;
        $dados_conselho['numero_conselho'] = $dados['numero_conselho'];
        $dados_conselho['data_emissao'] = dataBrParaOBanco($dados['data_emissao_conselho']);
        $dados_conselho['data_validade'] = dataBrParaOBanco($dados['validade_conselho']);
        $dados_conselho['uf'] = $dados['uf_conselho'];


        try {

            if ($dados['colaborador_id']) {
                $dados_conselho['updated_by'] = auth()->user()->id;
                $colaborador = $this->colaboradorRepository->find($dados['colaborador_id']) ?? null;
                $documentos = $this->documentoRepository->update($dados_documentos, $colaborador->documento->id);

                if ($dados_conselho['numero_conselho'] !== null && $dados_conselho['numero_conselho'] !== '') {
                    $dados_conselho['created_by'] = auth()->user()->id;
                    $dados_conselho['updated_by'] = auth()->user()->id;
                    $this->colaboradorConselhoRepository->update($dados_conselho, $dados['colaborador_id']);
                }
            } else {
                $dados_documentos['colaborador_id'] = $colaborador_id;
                $dados_conselho['colaborador_id'] = $colaborador_id;

                $dados_documentos['created_by'] = auth()->user()->id;
                $dados_documentos['updated_by'] = auth()->user()->id;
                $dados_conselho['created_by'] = auth()->user()->id;
                $dados_conselho['updated_by'] = auth()->user()->id;
                $documentos = $this->documentoRepository->create($dados_documentos);
                if ($dados_conselho['numero_conselho'] !== null && $dados_conselho['numero_conselho'] !== '') {
                    $this->colaboradorConselhoRepository->create($dados_conselho);
                }

                return $documentos;

            }

        } catch (Throwable $ex) {
            throw new HttpResponseException(response()->json([
                'status' => false, 'message' => 'Não foi possível Salvar os Documentos.', 'error' => $ex->getMessage()
            ], 500));
        }

        return $documentos;
    }

    private function salvarDadosAdmissional($dados, $colaborador_id)
    {
        $dados_admissao['cargo_id'] = $dados['cargo'];
        $dados_admissao['experiencia_id'] = $dados['experiencia'];
        $dados_admissao['regime_trabalho'] = $dados['regime_trabalho'];
        $dados_admissao['vale_transporte_desconto'] = $dados['vale_transporte'];
        $dados_admissao['data_admissao'] = dataBrParaOBanco($dados['data_admissao']);
        $dados_admissao['data_exame_admissional'] = dataBrParaOBanco($dados['data_exame_admissional']);
        $dados_admissao['salario'] = realProBD($dados['salario']);
        $dados_admissao['primeiro_emprego'] = $dados['primeiro_emprego'];
        $dados_admissao['readmissao'] = $dados['readmissao'];
        $dados_admissao['contrato_registrado_outra_empresa'] = $dados['contrato_outra'];
        $dados_col_htra_int['intervalo_id'] = $dados['horario_intervalo'];
        $dados_col_htra_int['h_trabalho_id'] = $dados['horario_trabalho'];
        $dados_col_htra_int['data_registro'] = date('Y-m-d');
        $dados_col_htra_int['colaborador_id'] = $colaborador_id;

        try {
            if ($dados['colaborador_id']) {
                $dados_admissao['updated_by'] = auth()->user()->id;
                $colaborador = $this->colaboradorRepository->find($dados['colaborador_id']);
                $admissao = $this->admissaoRepository->update($dados_admissao, $colaborador->admissao->id);
                $horario_traba_intervalo = ColaboradorHorarioTrabalhoIntervalo::find($colaborador->horarioTrabalhoIntervalo->id);
                $horario_traba_intervalo->update([
                    'i_trabalho_id' => $dados['horario_intervalo'],
                    'h_trabalho_id' => $dados['horario_trabalho']
                ]);
                $horario_traba_intervalo->save;

            } else {
                $col_trab_int = new ColaboradorHorarioTrabalhoIntervalo();
                $col_trab_int->data_registro = date('Y-m-d');
                $col_trab_int->colaborador_id = $colaborador_id;
                $col_trab_int->i_trabalho_id = $dados['horario_intervalo'];
                $col_trab_int->h_trabalho_id = $dados['horario_trabalho'];

                $dados_admissao['colaborador_id'] = $colaborador_id;
                $dados_admissao['created_by'] = auth()->user()->id;
                $dados_admissao['updated_by'] = auth()->user()->id;
                $admissao = $this->admissaoRepository->create($dados_admissao);
                $col_trab_int->save();

            }

        } catch (Throwable $ex) {
            DB::rollBack();
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Não foi possível Salvar os Dados de Admissão.',
                'error' => $ex->getMessage()
            ], 500));
        }

        return $admissao;
    }

    public function excluir($id)
    {
        try {
            $this->colaboradorRepository->delete($id);
            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Colaborador Deletado com Sucesso!'
                ]
            ];
            return \Response()->json($dados, 200);
        } catch (Exception $exception) {
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Excluir o Colaborador.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Excluir o Colaborador.', 'error' => $exception->getMessage()
                    ], 500));
            }

        }
    }

    public function editar($id)
    {
        return $this->colaboradorRepository->find($id);
    }

    public function update($dados)
    {

        try {
            DB::beginTransaction();

            $colaborador = $this->salvarColaborador($dados);
            $endereco = $this->salvarEndereco($dados, $colaborador->id);
            $admissao = $this->salvarDadosAdmissional($dados, $colaborador->id);
            $documentos = $this->salvarDocumentos($dados, $colaborador->id);
            // $dependentes = $this->salvarDependentes($dados, $colaborador->id);

            // $anexos_colaborador = $this->salvarAnexosColaborador($dados, $colaborador->id);

            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'colaborador' => $colaborador,
                    'endereco' => $endereco,
                    'admissao' => $admissao,
                    'documentos' => $documentos,
                    // 'dependentes' => $dependentes,
                    //'anexos_colaborador' => $anexos_colaborador,

                ]
            ];

        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Editar o Colaborador.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Editar o Colaborador.', 'error' => $exception->getMessage()
                    ], 500));
            }
        }
    }

    public function visualizar($id)
    {
        return $this->colaboradorRepository->find($id);
    }

    public function verificaCpf($cpf)
    {
        $cpf = limpaCPF($cpf);
        $cpf = $this->documentoRepository->findWhere(['cpf' => $cpf])->first();

        if (empty($cpf)) {
            $dados = [
                'status' => false,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Este CPF ainda não existe no Sistema!'
                ]
            ];
            return \Response()->json($dados, 200);
        } else {
            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'error',
                    'titulo' => "Erro",
                    'msg' => 'Este CPF já está Cadastrado no Sistema!'
                ]
            ];
            return \Response()->json($dados, 200);
        }
    }


    public function anexosColaborador($id)
    {
        $anexos = $this->anexoRepository
            ->makeModel()
            ->newQuery()
            ->where('colaborador_id', '=', $id)
            ->select('anexos.*')
            ->get();

        $anexos = collect($anexos)->map(function ($item, $key) {
            $item['data_criacao'] = createdbdToBr($item['data_criacao']);
            return $item;

        });

        return $anexos;

    }

    public function dependentes($id)
    {
        $dependentes = $this->dependenteRepository
            ->makeModel()
            ->newQuery()
            ->where('colaborador_id', '=', $id)
            ->select('dependentes.*')
            ->get();

        $dependentes = collect($dependentes)->map(function ($item, $key) {
            $item['data_nascimento'] = bdToBr($item['data_nascimento']);
            $item['cpf'] = formatarCnpjCpf($item['cpf']);
            return $item;
        });

        return $dependentes;
    }

    public function licencas($id)
    {
        $licencas = LicencaColaborador::where('colaborador_id', '=', $id)
            ->join('licencas', 'licencas.id', '=', 'licenca_colaboradors.licenca_id')
            ->select('licenca_colaboradors.*', 'licencas.tipo as tipo')
            ->get();

        $licencas = collect($licencas)->map(function ($item, $key) {
            $item['inicio'] = bdToBr($item['inicio']);
            $item['fim'] = bdToBr($item['fim']);
            return $item;
        });

        return $licencas;
    }

    public function anexosDependentes($id)
    {
        $colaborador = $this->colaboradorRepository->find($id);
        $dependentes = $colaborador->dependentes()->select('id')->get();


        $anexos = $this->anexoRepository
            ->makeModel()
            ->newQuery()
            ->select()->get();


        $anexos = collect($anexos)->filter(function ($item) use ($dependentes, $id) {
            foreach ($dependentes as $dependente) {
                if ($dependente->id === $item->dependente_id || $id == $item->colaborador_id) {
                    return $item;
                }
            }
        });

        $anexos = collect($anexos)->map(function ($item) {
            if (!empty($item['colaborador_id'])) {
                $item['dono_anexo'] = "COLABORADOR";
            } else {
                $dependente = $this->dependenteRepository->find($item['dependente_id']);
                $item['dono_anexo'] = 'DEPENDENTE - ' . $dependente->nome;
            }
            $item['data_criacao'] = createdbdToBr($item['created_at']);
            return $item;
        });


        return $anexos;

    }

    public function baixarAnexo($id)
    {
        $anexo = $this->anexoRepository->find($id);
        return Storage::download($anexo['url']);
    }

    public function excluirAnexo($id)
    {
        try {
            $this->anexoRepository->delete($id);
            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Anexo Deletado com Sucesso!'
                ]
            ];
            return \Response()->json($dados, 200);
        } catch (Exception $exception) {
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Excluir o Anexo.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Excluir o Anexo.', 'error' => $exception->getMessage()
                    ], 500));
            }

        }
    }

    public function excluirDependente($id)
    {
        try {
            DB::beginTransaction();
            $dependente = $this->dependenteRepository->find($id);
            $dependente->anexos()->delete();
            $this->dependenteRepository->delete($id);
            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Dependente Deletado com Sucesso!'
                ]
            ];
            DB::commit();
            return \Response()->json($dados, 200);
        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Excluir o Dependente.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Excluir o Dependente.', 'error' => $exception->getMessage()
                    ], 500));
            }

        }
    }

    public function excluirLicenca($id)
    {
        try {
            DB::beginTransaction();
            $licenca = LicencaColaborador::find($id);
            $licenca->delete();
            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Licença Deletada com Sucesso!'
                ]
            ];
            DB::commit();
            return \Response()->json($dados, 200);
        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Excluir o Dependente.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Excluir o Dependente.', 'error' => $exception->getMessage()
                    ], 500));
            }

        }
    }

    public function cadastrarDependente($dados)
    {
        $dependente['colaborador_id'] = $dados['colaborador_id'];
        $dependente['nome'] = $dados['nome'];
        $dependente['cpf'] = limpaCPF($dados['cpf']);
        $dependente['data_nascimento'] = dataBrParaOBanco($dados['data_nascimento']);
        $dependente['created_by'] = auth()->user()->id;
        $dependente['updated_by'] = auth()->user()->id;

        try {
            DB::beginTransaction();

            $dependente = $this->dependenteRepository->create($dependente);

            DB::commit();
            return [
                'status' => true,
                'message' => 'Dependente Salvo Com Sucesso!',
                'data' => $dados = [
                    'dependentes' => $dependente
                ]
            ];
        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Cadastrar o Dependente.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Cadastrar o Dependente.', 'error' => $exception->getMessage()
                    ], 500));
            }

        }

    }

    public function cadastrarLicenca($dados)
    {
        $licenca = new LicencaColaborador();
        $licenca->colaborador_id = $dados['colaborador_id'];
        $licenca->licenca_id = $dados['tipo'];
        $licenca->inicio = dataBrParaOBanco($dados['inicio']);
        $licenca->fim = dataBrParaOBanco($dados['fim']);

        try {
            DB::beginTransaction();

            $licenca = $licenca->save();

            DB::commit();
            return [
                'status' => true,
                'message' => 'Licença Salva Com Sucesso!',
                'data' => $dados = [
                    'dependentes' => $licenca
                ]
            ];
        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Cadastrar a Licença.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Cadastrar a Licença.', 'error' => $exception->getMessage()
                    ], 500));
            }

        }

    }

    public function cadastrarAnexo($dados)
    {
        $id = preg_replace("/\D/", "", $dados['dependentes']);

        if (Str::contains($dados['dependentes'], 'COLABORADOR')) {
            $dados_anexo['colaborador_id'] = $id;
        } else {
            $dados_anexo['dependente_id'] = $id;
        }

        $dados['anexo']->getClientOriginalName();

        $dados_anexo['nome'] = $dados['nome'];
        $dados_anexo['created_by'] = auth()->user()->id;
        $dados_anexo['updated_by'] = auth()->user()->id;
        $nome_arquivo = uniqid() . "." . $dados['anexo']->getClientOriginalExtension();
        $upload = $dados['anexo']->storeAs('downloads', $nome_arquivo);
        $dados_anexo['url'] = 'downloads/' . $nome_arquivo;


        try {
            DB::beginTransaction();

            $salvar_anexo = $this->anexoRepository->create($dados_anexo);

            DB::commit();
            return [
                'status' => true,
                'message' => 'Anexo Salvo Com Sucesso!',
                'data' => $dados = [
                    'anexo' => $salvar_anexo
                ]
            ];
        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Cadastrar o Anexo.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Cadastrar o Anexo.', 'error' => $exception->getMessage()
                    ], 500));
            }

        }

    }

    public function editarAnexo($dados)
    {
        $dados_anexo['nome'] = $dados['nome_anexo'];
        try {
            DB::beginTransaction();
            $anexo = $this->anexoRepository->update($dados_anexo, $dados['anexo_id']);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'anexo' => $anexo,


                ]
            ];

        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Editar o Anexo.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Editar o Anexo.', 'error' => $exception->getMessage()
                    ], 500));
            }
        }
    }

    public function editarDependente($dados)
    {
        $dependente['nome'] = $dados['nome'];
        $dependente['cpf'] = limpaCPF($dados['cpf']);
        $dependente['data_nascimento'] = dataBrParaOBanco($dados['data_nascimento']);
        $dependente['updated_by'] = auth()->user()->id;
        try {
            DB::beginTransaction();
            $dependente = $this->dependenteRepository->update($dependente, $dados['dependente_id']);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'dependente' => $dependente,


                ]
            ];

        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Editar o Dependente.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Editar o Dependente.', 'error' => $exception->getMessage()
                    ], 500));
            }
        }
    }

    public function colaboradorDependente($id)
    {
        $colaborador = $this->colaboradorRepository->find($id);
        $select[] = ['id' => "$colaborador->id - COLABORADOR", "nome" => "COLABORADOR"];
        foreach ($colaborador->dependentes as $dependente) {
            $select[] = ['id' => "$dependente->id - DEPENDENTE", 'nome' => "DEPENDENTE - $dependente->nome"];
        }

        return collect($select)->pluck('nome', 'id');
    }
}