<?php

namespace App\Services;

use App\Models\Colaborador;
use App\Models\HistoricoColaboradorSetor;
use App\Models\Setor;
use App\Repositories\Colaborador\ColaboradorRepositoryEloquent;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class SetorService
{
    private $colaboradorRepository;

    public function __construct(ColaboradorRepositoryEloquent $colaboradorRepository)
    {
        $this->colaboradorRepository = $colaboradorRepository;
    }

    public function salvar($dados)
    {
        $dados = allUpper($dados);

        DB::beginTransaction();
        try {
            $setor = new Setor();
            $setor->nome = $dados['nome'];
            $setor->insalubridade = $dados['insalubridade'];
            $setor->unidade_id = $dados['unidade'];
            $setor->created_by = auth()->user()->id;
            $setor->updated_by = auth()->user()->id;

            $setor = $setor->save();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $setor,
                ]
            ];

        } catch (Throwable $throwable) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Não foi possível Cadastrar.', 'error' => $throwable->getMessage()
            ], 500));

        }
    }

    public function excluir($id)
    {
        try {
            $unidade = Setor::find($id);
            $unidade->delete();

            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Excluído com Sucesso!'
                ]
            ];

            return Response()->json($dados, 200);
        } catch (Throwable $throwable) {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Não foi possível Excluir.', 'error' => $throwable->getMessage()
            ], 500));
        }
    }

    public function update($dados)
    {
        $dados = allUpper($dados);

        DB::beginTransaction();
        try {
            $setor = Setor::find($dados['setor_id']);
            $setor->nome = $dados['nomeEdit'];
            $setor->insalubridade = $dados['insalubridadeEdit'];
            $setor->unidade_id = $dados['unidadeEdit'];
            $setor->updated_by = auth()->user()->id;
            $setor = $setor->save();
            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $setor,
                ]
            ];

        } catch (Throwable $throwable) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Não foi possível Editar.', 'error' => $throwable->getMessage()
            ], 500));

        }
    }

    public function getColaboradores($setor_id)
    {
        $colaboradores = new Colaborador();
        $colaboradores = $colaboradores
            ->newQuery()
            ->leftJoin('setores_profissionais as sp', 'sp.colaborador_id', 'colaboradores.id')
            ->leftJoin('setores as s', 's.id', 'sp.setor_id')
            ->leftJoin('documentos as d', 'd.colaborador_id', 'colaboradores.id')
            ->leftJoin('admissoes as a', 'a.colaborador_id', 'colaboradores.id')
            ->leftJoin('cargos as c', 'c.id', 'a.cargo_id')
            ->where('s.id', '=', $setor_id)
            ->select('colaboradores.*', 'd.cpf', 'c.descricao', 's.id as setor_id')
            ->get();

        $colaboradores = collect($colaboradores)->map(function ($item, $key) {
            $item['data_nascimento'] = bdToBr($item['data_nascimento']);
            $item['cpf'] = formatarCnpjCpf($item['cpf']);
            return $item;
        });

        return $colaboradores;
    }

    public function colaboradoresAjax($nome)
    {
        $nome = mb_strtoupper($nome);

        $colaborador = $this->colaboradorRepository
            ->findWhere([
                'nome' => ['nome', 'like', "%$nome%"],
            ]);

        return $colaborador;
    }


    public function adicionarColaborador($dados, $id)
    {
        $colaborador = Colaborador::find($dados['colaborador']);
        $setor = Setor::find($id);

        try {
            DB::beginTransaction();
            $c = $colaborador->setores()->attach($setor);
            HistoricoColaboradorSetor::create([
                'setor_id' => $setor->id,
                'nome_setor' => $setor->nome,
                'colaborador_id' => $colaborador->id,
                'nome_colaborador' => $colaborador->nome,
                'data_entrada' => date("Y-m-d"),
            ]);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Adicionado Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $c,
                ]
            ];

        } catch (Throwable $throwable) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Não foi possível Adicionar. Verifique se este Colaborador já está incluso no setor.', 'error' => $throwable->getMessage()
            ], 500));

        }
    }

    public function removerColaborador($colaborador_id, $setor_id)
    {
        $colaborador = Colaborador::find($colaborador_id);
        $setor = Setor::find($setor_id);

        try {
            $colaborador->setores()->detach($setor);
            $this->removeEscala($colaborador, $setor);
            $historico = HistoricoColaboradorSetor::where('setor_id', $setor->id)
                ->where('colaborador_id', $colaborador->id)
                ->whereNull('data_saida')->get()->first();

            $historico->data_saida = date('Y-m-d');
            $historico->save();


            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Removido com Sucesso!'
                ]
            ];
            return Response()->json($dados, 200);
        } catch (Throwable $throwable) {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Não foi possível Remover.', 'error' => $throwable->getMessage()
            ], 500));


        }
    }

    public function removeEscala($colaborador, $setor)
    {
        $escala = $colaborador->escalas->where('setor_id', $setor->id)->first();
        if (!empty($escala)) {
            $escala->colaboradores()->detach($colaborador);
        }
    }
}