<?php

namespace App\Services;

use App\Models\Escala;
use App\Models\Feriado;
use App\Models\Setor;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Prettus\Validator\Exceptions\ValidatorException;

class EscalaService
{
    public function getSetores($unidade_id)
    {
        $setores = Setor::where('unidade_id', $unidade_id)->get();
        $setores = $setores->mapwithkeys(function ($value, $key) {
            return [
                $key => [
                    'id' => $value->id,
                    'text' => $value->nome,
                ]
            ];
        })->sortBy('id')->values();

        if (empty($setores)) {
            $dados = [
                'status' => false,
                'data' => [
                    'icon' => 'error',
                    'titulo' => "Erro",
                    'msg' => 'Não existe setores nesta Unidade!'
                ]
            ];
            return \Response()->json($dados, 500);
        } else {
            $result = [
                'status' => true,
                'dados' => $setores
            ];
            return \Response()->json($result, 200);
        }
    }

    public function salvarEscala($dados)
    {
        $dados = allUpper($dados);
        $datas = collect($this->getMesesDias())->keyBy(['mes'])->all();

        $verfica_escala = Escala::where('periodo', $dados['mes'])
            ->where('quantidade_dias', $datas[$dados['mes']]['maximo'])
            ->where('primeiro_dia', $datas[$dados['mes']]['primeiro_dia'])
            ->where('unidade_id', $dados['unidade'])
            ->where('setor_id', $dados['setor'])
            ->where('cargo_id', $dados['cargo'])
            ->where('turno', $dados['turno'])->get();


        if (count($verfica_escala) > 0) {
            $result = [
                "status" => "existe",
                "escala_id" => $verfica_escala->first()['id'] ?? null
            ];
            return $result;
        }

        try {
            DB::beginTransaction();

            $escala = Escala::create([
                'periodo' => $dados['mes'],
                'quantidade_dias' => $datas[$dados['mes']]['maximo'],
                'primeiro_dia' => $datas[$dados['mes']]['primeiro_dia'],
                'unidade_id' => $dados['unidade'],
                'setor_id' => $dados['setor'],
                'cargo_id' => $dados['cargo'],
                'turno' => $dados['turno'],
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            $turno = $escala->turno;
            $colaboradores = $this->getColaboradoresCargo($escala->cargo_id, $escala->setor_id);

            if (count($colaboradores) != 0) {
                $colaboradores = collect($colaboradores)->map(function ($value) use ($turno) {

                    if ($this->intervaloEntreDatas('07:00', '19:00', $value->inicio_expediente, $value->fim_expediente) == 'DIURNO') {
                        if ($turno == "DIURNO") {
                            return $value;
                        }
                    }


                    if ($this->intervaloEntreDatas('19:00', '07:00', $value->inicio_expediente, $value->fim_expediente) == 'NOTURNO') {
                        if ($turno == "NOTURNO") {
                            return $value;
                        }
                    }
                });

                $colaboradores = $colaboradores->filter(function ($value) {
                    return $value !== null;
                });
            }
            if (count($colaboradores) === 0) {
                return false;
            }

            foreach ($escala->setor->colaboradores as $colaborador) {
                $escala->colaboradores()->attach($colaborador, ['dias' => ',']);
            }

            DB::commit();

            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Salvo com Sucesso!',
                    'dados' => $escala->id
                ]
            ];
            return \Response()->json($dados, 200);

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

    public function getMesesDias()
    {
        $proximo_mes = Carbon::parse('first day of next month')->locale('pt_BR');
        $mes_atual = Carbon::parse('first day of this month')->locale('pt_BR');

        $meses_disponiveis[] = ['id' => $proximo_mes->format('m/Y'), 'mes' => $proximo_mes->format('m/Y'), 'maximo' => $proximo_mes->daysInMonth, 'primeiro_dia' => $proximo_mes->isoFormat('ddd')];
        $meses_disponiveis[] = ['id' => $mes_atual->format('m/Y'), 'mes' => $mes_atual->format('m/Y'), 'maximo' => $mes_atual->daysInMonth, 'primeiro_dia' => $mes_atual->isoFormat('ddd')];

        $i = 1;

        while ($i <= 12) {
            $primeiro_dia = Carbon::now()->parse('first day of this month')->locale('pt_BR');
            $dt = Carbon::parse();
            $mes_atual = new Carbon();
            $mes = $mes_atual->subMonth($i)->format('m/Y');
            $meses_disponiveis[] = [
                'id' => $mes,
                'mes' => $mes,
                'maximo' => $dt->subMonth($i)->daysInMonth,
                'primeiro_dia' => $primeiro_dia->subMonth($i)->isoFormat('ddd'),
            ];
            $i++;
        }

        return $meses_disponiveis;
    }

    public function excluir($id)
    {
        try {
            $escala = Escala::find($id);
            $escala->colaboradores()->detach();
            $escala->delete();

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

    public function getDiasLicenca($escala_periodo, $licencas)
    {
//        dd($licencas);
        $dias_licencas = [];

        foreach ($licencas as $licenca) {


//            $inicio = explode("/", $licenca->inicio);
//            $fim = explode("/", $licenca->fim);
//            dd($inicio, $fim);
// Cria três variáveis $dia $mes $ano
            $dia = Carbon::createFromFormat('Y-m-d', $licenca->inicio)->format('d');
            $mes = Carbon::createFromFormat('Y-m-d', $licenca->inicio)->format('m');
            $ano = Carbon::createFromFormat('Y-m-d', $licenca->inicio)->format('Y');

            $dia_fim = Carbon::createFromFormat('Y-m-d', $licenca->fim)->format('d');
            $mes_fim = Carbon::createFromFormat('Y-m-d', $licenca->fim)->format('m');
            $ano_fim = Carbon::createFromFormat('Y-m-d', $licenca->fim)->format('Y');


// Recria a data invertida

            $dini = mktime(0, 0, 0, $mes, $dia, $ano); // timestamp da data inicial
            $dfim = mktime(0, 0, 0, $mes_fim, $dia_fim, $ano_fim); // timestamp da data final
//        dd($escala->periodo);
            while ($dini <= $dfim)//enquanto uma data for inferior a outra
            {
                $dt = date("d/m/Y", $dini);//convertendo a data no formato dia/mes/ano
//            dump($dt);
                $periodo_ferias = date('m/Y', ($dini));//exibindo a data
//                dd($periodo_ferias, $escala_periodo);
                if ($periodo_ferias == $escala_periodo) {
//                dump(date('d', ($dini)));
//                dump("mes de ferias");
                    $dias_licencas[] = ["dia" => date('d', ($dini))];
                }

                $dini += 86400; // adicionando mais 1 dia (em segundos) na data inicial
            }

        }

        return $dias_licencas;
    }

    public function intervaloEntreDatas($inicio, $fim, $inicio_expediente, $fim_exepediente)
    {
        //inicio_expediente 19:00
        //fim_expediente 07:00
        // 07:00 e 19:00

        if (strtotime($fim_exepediente) > strtotime($inicio_expediente)) {
            return "DIURNO";
//            return (strtotime($inicio_expediente) >= strtotime($inicio) && strtotime($inicio_expediente) <= strtotime($fim) && strtotime($fim_exepediente) >= strtotime($inicio) && strtotime($fim_exepediente) <= strtotime($fim));
        } elseif(strtotime($inicio_expediente) > strtotime($fim_exepediente)) {
            return "NOTURNO";
        }


    }

    public function getColaboradoresCargo($cargo_id, $setor_id)
    {
        $colaboradores = DB::table('colaboradores')
            ->join('admissoes', 'admissoes.colaborador_id', '=', 'colaboradores.id')
            ->join('cargos', 'cargos.id', '=', 'admissoes.cargo_id')
            ->join('setores_profissionais as sp', 'sp.colaborador_id', '=', 'colaboradores.id')
            ->join('setores as s', 's.id', '=', 'sp.setor_id')
            ->join('colaboradores_conselhos_profissionais as ccp', 'ccp.colaborador_id', '=', 'colaboradores.id')
            ->join('conselhos_profissionais as cp', 'cp.id', '=', 'ccp.conselho_id')
            ->join('horarios_trabalho_intervalos as hti', 'hti.colaborador_id', '=', 'colaboradores.id')
            ->join('horarios_trabalho as ht', 'ht.id', '=', 'hti.h_trabalho_id')
            ->select('colaboradores.id', 'colaboradores.nome', 'colaboradores.fone_contato', 'colaboradores.id as colaborador_id', 'ccp.numero_conselho as numero_conselho', 'cargos.descricao as nome_cargo', 'ht.inicio_expediente as inicio_expediente', 'ht.fim_expediente as fim_expediente')
            ->where('cargos.id', '=', $cargo_id)
            ->where('s.id', '=', $setor_id)
            ->whereNull('colaboradores.deleted_at')
            ->get();

        return $colaboradores;
    }

    public function feriados($periodo)
    {
        $feriados = Feriado::get();
        $periodo = Carbon::createFromFormat('m/Y', $periodo)->format('Y-m');
        $feriados_selecionados = [];
        foreach ($feriados as $feriado) {
            $periodo_feriado = Carbon::createFromFormat('Y-m-d', $feriado->data)->format('Y-m');
            $dia_feriado = Carbon::createFromFormat('Y-m-d', $feriado->data)->format('d');
            if ($periodo === $periodo_feriado) {
                $feriados_selecionados [] = [
                    "descricao" => $feriado->descricao,
                    "data" => bdToBr($feriado->data),
                    "dia" => $dia_feriado
                ];
            }
        }
        return $feriados_selecionados;
    }
}