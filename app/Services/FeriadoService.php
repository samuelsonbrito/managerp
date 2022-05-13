<?php

namespace App\Services;

use App\Models\Feriado;
use App\Models\Unidade;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class FeriadoService
{
    public function salvar($dados)
    {
        $dados = allUpper($dados);
        try {
            DB::beginTransaction();

            $feriado = new Feriado();

            $feriado->descricao = $dados['descricao'];
            $feriado->tipo = $dados['tipo'];
            $feriado->data = dataBrParaOBanco($dados['data_feriado']);
            $feriado->repetir_anualmente = $dados['repetir_anualmente'];


            $feriado = $feriado->save();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $feriado,
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
            $feriado = Feriado::find($id);
            $feriado->delete();

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

}