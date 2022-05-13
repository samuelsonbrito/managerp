<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Repositories\Anexo\AnexoRepositoryEloquent as AnexoRepository;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Prettus\Validator\Exceptions\ValidatorException;

class ContratoService
{
    private $anexoRepository;
    private $contrato;
    public function __construct(AnexoRepository $anexoRepository,Contrato $contrato)
    {
        $this->anexoRepository = $anexoRepository;
        $this->contrato = $contrato;
    }
    public function getContratosInfo()
    {
        $contratos = Contrato::all();
        $contratoInfo = $contratos->map(function($item){

            return $item;
        });
        return $contratoInfo;
    }

    public function anexosContratos($id)
    {
        $contrato = Contrato::find($id);

        $anexos = $contrato->anexos;

        $anexos = collect($anexos)->map(function ($item) {
            $item['data_criacao'] = createdbdToBr($item['created_at']);
            return $item;
        });

        return $anexos;
    }

    public function salvarContratoUnidade($cont,$request)
    {
        $contrato = $this->contrato->find($cont->id);
        $contrato->unidades()->detach();
       
        try {
            collect($request)->map(function($item) use ($contrato){

                $contrato->unidades()->attach($item);
                    return [
                        'status'=>true,
                        'message'=>'Contrato Unidade Salva com Sucesso'
                    ];      
            });
        } catch (\Throwable $exception) {
            return [
              'status'=>false,
            'error'=> $exception->getMessage()
            ];
        }
    }

    public function salvarContrato($request)
    {
        $diff=Carbon::createFromFormat('d/m/Y',$request['data_inicial'])->format('Ymd');
        $diff += rand(1,1000);
        
        try {
            DB::beginTransaction();
            $valor = explode('.',$request['valor']);
            $valor = implode('',$valor);
            $valor_formatado = str_replace(',','.',$valor);

           if (!empty($request['contrato_id'])) {
                $contrato = Contrato::find($request['contrato_id']);
                $contrato->valor =$request['valor'];
                $contrato->data_inicial = $request['data_inicial'];
                $contrato->data_fim = $request['data_final'];
                $contrato->data_assinatura = $request['data_assinatura'];
                $contrato->valor = (double) $valor_formatado;
                $contrato->numero = $request['numero'] == null ? $diff : $request['numero'];
                $contrato->cliente_id = $request['cliente'];
                $contrato->updated_by = auth()->user()->id;
                $contrato->save();
           
           } else {
                $contrato= Contrato::create([
                    'valor' =>$request['valor'],
                    'data_inicial' => $request['data_inicial'],
                    'data_fim' =>$request['data_final'],
                    'data_assinatura' => $request['data_assinatura'],
                    'valor' => (double) $valor_formatado,
                    'numero' => $request['numero'] == null ? $diff : $request['numero'],
                    'cliente_id'=>$request['cliente'],
                    'created_by'=>auth()->user()->id,
                    'updated_by'=>auth()->user()->id,
                ]);
           }
 
            self::salvarContratoUnidade($contrato, $request['unidades']);

            DB::commit();
            return [
                'status' => true,
                'message' => 'Contrato Salvo     com  Sucesso!'
            ];


        }catch (\Throwable $exception) {
            DB::rollBack();
            return[
              'status'=>false,
              'error'=>$exception->getMessage()
            ];
        }
    }

    public function cadastrarAnexo($dados)
    {
        $dados['anexo']->getClientOriginalName();

        $dados_anexo['nome'] = $dados['nome'];
        $dados_anexo['contrato_id'] = $dados['contrato_id'];
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
        } catch (\Exception $exception) {
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
        } catch (\Exception $exception) {
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

    public function baixarAnexo($id)
    {
        $anexo = $this->anexoRepository->find($id);
        return Storage::download($anexo['url']);
    }

    public function editarAnexo($dados)
    {
        $dados = allUpper($dados);
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

    public function getDadosContrato(int $id) : array
    {
        $contrato = Contrato::find($id);
  
        return [
            'contrato' => $contrato
        ];
    }

    public function excluir(int $id)
    {
        try {
            $contrato = Contrato::find($id);
            $contrato->delete();
            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Contrato Deletado com Sucesso!'
                ]
            ];
            return \Response()->json($dados, 200);
        } catch (Exception $exception) {
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Excluir o Contrato.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Excluir o Contrato.', 'error' => $exception->getMessage()
                    ], 500));
            }

        }
    }
}