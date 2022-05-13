<?php

namespace App\Services;

use App\Models\Unidade;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class UnidadeService
{
    public function salvar($dados)
    {
        $dados = allUpper($dados);
        try {
            DB::beginTransaction();

            $unidade = new Unidade();

            $unidade->nome = $dados['nome'];
            $unidade->created_by = auth()->user()->id;
            $unidade->updated_by = auth()->user()->id;

            $unidade = $unidade->save();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $unidade,
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
            $unidade = Unidade::find($id);
            $unidade->delete();

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

            $unidade = Unidade::find($dados['unidade_id']);

            $unidade->nome = $dados['nomeEdit'];
            $unidade->updated_by = auth()->user()->id;
            $unidade = $unidade->save();
            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $unidade,
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

    public function getUnidades()
    {
        $unidades = Unidade::all()->pluck('nome', 'id');
        return $unidades;
    }
}