<?php

namespace App\Services;

use App\Models\Cliente;
use App\Repositories\Cliente\ClienteRepositoryEloquent as ClienteRepository;
use App\Repositories\Dependente\DependenteRepositoryEloquent as DependenteRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
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

class ClienteService
{
    private $clienteRepository;
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
        ClienteRepository $clienteRepository,
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
        $this->clienteRepository = $clienteRepository;
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

            $cliente_fornecedor = $this->salvarClienteFornecedor($dados);

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'cliente' => $cliente_fornecedor,
                ]
            ];

        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Cadastrar.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Cadastrar.', 'error' => $exception->getMessage()
                    ], 500));
            }
        }
    }

    private function salvarClienteFornecedor($dados)
    {
        $cliente['nome'] = $dados['nome'];
        $cliente['tipo_pessoa'] = $dados['tipo_pessoa'];
        $cliente['cpf_cnpj'] = limpaCPF($dados['cpf_cnpj']);
        $cliente['telefone'] = $dados['telefone'];
        $cliente['nome_fantasia'] = $dados['nome_fantasia'];
        $cliente['papel'] = $dados['papel'];

        try {
            if ($dados['cliente_id']) {
                $cliente['updated_by'] = auth()->user()->id;
                $cliente = $this->clienteRepository->update($cliente, $dados['cliente_id']);
            } else {
                $cliente['created_by'] = auth()->user()->id;
                $cliente['updated_by'] = auth()->user()->id;
                $cliente = $this->clienteRepository->create($cliente);
            }
            return $cliente;
        } catch (Throwable $ex) {
            throw new HttpResponseException(response()->json([
                'status' => false, 'message' => 'Não foi possível Salvar.', 'error' => $ex->getMessage()
            ], 500));
        }
    }

    public function excluir($id)
    {
        try {
            $this->clienteRepository->delete($id);
            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Deletado com Sucesso!'
                ]
            ];
            return \Response()->json($dados, 200);
        } catch (Exception $exception) {
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Excluir.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Excluir.', 'error' => $exception->getMessage()
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

            $cliente = $this->salvarClienteFornecedor($dados);

            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'cliente' => $cliente,
                ]
            ];

        } catch (Exception $exception) {
            DB::rollBack();
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Editar.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Editar.', 'error' => $exception->getMessage()
                    ], 500));
            }
        }
    }

    public function visualizar($id)
    {
        return $this->colaboradorRepository->find($id);
    }


}