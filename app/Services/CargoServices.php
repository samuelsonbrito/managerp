<?php

namespace App\Services;

use App\Models\Cargo;
use App\Repositories\Cargo\CargoRepositoryEloquent as CargoRepository;
use Illuminate\Support\Facades\DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class CargoServices
{
    private $cargoRepository;

    function __construct(CargoRepository $cargoRepository)
    {
        $this->cargoRepository = $cargoRepository;
    }

    public function getCargos()
    {
        $cargos = $this->cargoRepository->all();
        $cargos = $cargos->pluck('descricao', 'id');

        $cargos = collect($cargos)->map(function ($value){
            return $value = mb_strtoupper($value);
        });

        return $cargos;
    }

    public function salvar($dados)
    {
        $dados = allUpper($dados);
        try {
            DB::beginTransaction();

            $cargo = new Cargo();

            $cargo->descricao = $dados['descricao'];
            $cargo->created_by = auth()->user()->id;
            $cargo->updated_by = auth()->user()->id;

            $cargo = $cargo->save();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $cargo,
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
            $cargo = Cargo::find($id);
            $cargo->delete();

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

            $cargo = Cargo::find($dados['cargo_id']);

            $cargo->descricao = $dados['descricaoEdit'];
            $cargo->updated_by = auth()->user()->id;
            $cargo = $cargo->save();
            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $cargo,
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