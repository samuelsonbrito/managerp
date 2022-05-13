<?php
/**
 * Created by PhpStorm.
 * User: messias
 * Date: 08/02/19
 * Time: 22:03
 */

namespace App\Services;


use App\Models\Intervalo;
use App\Repositories\Intervalo\IntervaloRepositoryEloquent as IntervaloRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class IntervaloService
{
    /**
     * @var IntervaloRepository
     */
    private $intervaloRepository;

    function __construct(IntervaloRepository $intervaloRepository)
    {
        $this->intervaloRepository = $intervaloRepository;
    }

    public function getIntervalos()
    {
      return $this->intervaloRepository->all();
    }

    public function getHorarioIntervalo($id)
    {
        return $this->intervaloRepository->find($id);
    }

    public function salvar($dados)
    {
        $dados = allUpper($dados);

        try {
            DB::beginTransaction();

            $horario_intervalo = new Intervalo();

            $horario_intervalo->hora_inicial = $dados['hora_inicial'];
            $horario_intervalo->hora_final = $dados['hora_final'];
            $horario_intervalo->created_by = auth()->user()->id;
            $horario_intervalo->updated_by = auth()->user()->id;
            $horario_intervalo = $horario_intervalo->save();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $horario_intervalo,
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
    public function excluir($id)
    {
        try {
            $horario_intervalo = Intervalo::find($id);
            $horario_intervalo->delete();

            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Excluído com Sucesso!'
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

    public function update($dados)
    {
        $dados = allUpper($dados);
        try {
            DB::beginTransaction();
            $horario_intervalo = Intervalo::find($dados['horario_intervalo_id']);

            $horario_intervalo->hora_inicial = $dados['hora_inicialEdit'];
            $horario_intervalo->hora_final = $dados['hora_finalEdit'];
            $horario_intervalo->updated_by = auth()->user()->id;
            $horario_intervalo = $horario_intervalo->save();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $horario_intervalo,
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
}