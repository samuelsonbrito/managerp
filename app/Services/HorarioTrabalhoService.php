<?php
/**
 * Created by PhpStorm.
 * User: messias
 * Date: 08/02/19
 * Time: 22:03
 */

namespace App\Services;


use App\Models\HorarioTrabalho;
use App\Repositories\HorarioTrabalho\HorarioTrabalhoRepositoryEloquent as HorarioTrabalhoRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;


class HorarioTrabalhoService
{
    /**
     * @var HorarioTrabalhoRepository
     */
    private $horarioTrabalhoRepository;

    function __construct(HorarioTrabalhoRepository $horarioTrabalhoRepository)
    {
        $this->horarioTrabalhoRepository = $horarioTrabalhoRepository;
    }

    public function getHorariosTrabalho()
    {
        return $this->horarioTrabalhoRepository->all();
    }

    public function getHorarioTrabalho($id)
    {
        return $this->horarioTrabalhoRepository->find($id);
    }

    public function getHorariosTrabalhoSelect()
    {
        $horarios = $this->horarioTrabalhoRepository->all()->map(function($item) {
            return $item;
        });
        return $horarios;
    }


    public function salvar($dados)
    {
        $dados = allUpper($dados);

        try {
            DB::beginTransaction();

            $horario_trabalho = new HorarioTrabalho();

            $horario_trabalho->descricao_periodo = $dados['descricao_periodo'];
            $horario_trabalho->inicio_expediente = $dados['inicio_expediente'];
            $horario_trabalho->fim_expediente = $dados['fim_expediente'];
            $horario_trabalho->created_by = auth()->user()->id;
            $horario_trabalho->updated_by = auth()->user()->id;
            $horario_trabalho = $horario_trabalho->save();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $horario_trabalho,
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
            $horario_trabalho = HorarioTrabalho::find($id);
            $horario_trabalho->delete();

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
            $horario_trabalho = HorarioTrabalho::find($dados['horario_trabalho_id']);

            $horario_trabalho->descricao_periodo = $dados['descricao_periodoEdit'];
            $horario_trabalho->inicio_expediente = $dados['inicio_expedienteEdit'];
            $horario_trabalho->fim_expediente = $dados['fim_expedienteEdit'];
            $horario_trabalho->updated_by = auth()->user()->id;
            $horario_trabalho = $horario_trabalho->save();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $horario_trabalho,
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