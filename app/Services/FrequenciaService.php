<?php

namespace App\Services;

use App\Models\Colaborador;
use App\Models\Escala;
use App\Models\FrequenciaEscala;
use App\Models\Unidade;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class FrequenciaService
{
    public function imprimirRelatorio($dados)
    {
        $turno = $dados['turno'];

        $colaboradores_frequencias = DB::table('frequencias_escalas')
            ->join('colaboradores as c', 'c.id', '=', 'frequencias_escalas.colaborador_id')
            ->join('escalas_profissionais as ep', 'ep.colaborador_id', '=', 'frequencias_escalas.colaborador_id')
            ->join('escalas as e', 'e.id', '=', 'ep.escala_id')
            ->join('cargos', 'cargos.id', '=', 'e.cargo_id')
            ->join('setores as s', 's.id', '=', 'e.setor_id')
            ->join('unidades as u', 'u.id', '=', 'e.unidade_id')
            ->leftJoin('colaboradores_conselhos_profissionais as ccp', 'ccp.colaborador_id', '=', 'c.id')
            ->leftJoin('horarios_trabalho_intervalos as hti', 'hti.colaborador_id', '=', 'c.id')
            ->leftJoin('horarios_trabalho as ht', 'ht.id', '=', 'hti.h_trabalho_id')
            ->whereNull('frequencias_escalas.deleted_at')
            ->where('e.periodo', $dados['data'])
            ->where('u.id', $dados['unidade'])
            ->where('cargos.id', $dados['cargo'])
            ->select(
                'c.nome as nome_colaborador',
                'c.id as colaborador_id',
                'c.matricula as matricula_colaborador',
                's.nome as nome_setor',
                'e.periodo as periodo',
                'e.id as escala_id',
                'ccp.numero_conselho',
                'ht.inicio_expediente',
                'ht.fim_expediente',
                'cargos.descricao as nome_cargo',
                'cargos.id as cargo_id',
                'u.nome as nome_unidade',
                'u.id as unidade_id',
                'ep.dias as dias'
            )
        ->distinct()
            ->get();

        $totais = [
            'ple' => 0,
            'p' => 0,
            'f' => 0,
            'pa' => 0,
            'pex' => 0,
            'sr' => 0,
            'er' => 0,
            'tpr' => 0
        ];



        $colaboradores_frequencias = collect($colaboradores_frequencias)->map(function ($value) use ($turno, &$totais) {
            $dias_plantoes = array_filter(explode(',', $value->dias));
            $presencas = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->where('frequencia', 'PRESENTE')->count();
            $faltas = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->where('frequencia', 'FALTA')->count();
            $avulsos = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->whereNotNull('substituto_avulso')->count();
            $extras = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->whereNotNull('substituto_extra')->count();
            $extras_realizados = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->where('substituto_extra', $value->colaborador_id)->count();
            if ($avulsos > 0) {
                $data_e_nome_avulsos = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->whereNotNull('substituto_avulso')->select('substituto_avulso', 'updated_at', 'motivo_ausencia')->get();

                foreach ($data_e_nome_avulsos as &$item) {
                    $item['justificativa'] = $item['motivo_ausencia'] == null ? 'SEM JUSTIFICATIVA' : $item['motivo_ausencia'];
                    $item['data'] = createdbdToBr($item['updated_at']);
                }

                $value->datas_nomes_avulsos = $data_e_nome_avulsos;
            } else {
                $value->datas_nomes_avulsos = null;
            }

            if ($extras > 0) {
                $data_e_nome_extras = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->whereNotNull('substituto_extra')->select('substituto_extra', 'updated_at', 'motivo_ausencia')->get();

                foreach ($data_e_nome_extras as &$item) {
                    $item['justificativa'] = $item['motivo_ausencia'] == null ? 'SEM JUSTIFICATIVA' : $item['motivo_ausencia'];
                    $item['data'] = createdbdToBr($item['updated_at']);
                    $item['nome_colaborador'] = Colaborador::find($item['substituto_extra'])->nome;
                }

                $value->datas_nomes_extras = $data_e_nome_extras;
            } else {
                $value->datas_nomes_extras = null;
            }


            $value->ple = count($dias_plantoes);
            $value->p = $presencas;
            $value->f = $faltas;
            $value->pa = $avulsos;
            $value->pex = $extras;
            $value->sr = $faltas - ($avulsos + $extras);
            $value->er = $extras_realizados;
            $value->tpr = $presencas + $extras_realizados;

            $totais['ple'] = $totais['ple'] + $value->ple;
            $totais['p'] = $totais['p'] + $value->p;
            $totais['f'] = $totais['f'] + $value->f;
            $totais['pa'] = $totais['pa'] + $value->pa;
            $totais['pex'] = $totais['pex'] + $value->pex;
            $totais['sr'] = $totais['sr'] + $value->sr;
            $totais['er'] = $totais['er'] + $value->er;
            $totais['tpr'] = $totais['tpr'] + $value->tpr;

            if ($turno == 'DIURNO') {
                if ($this->intervaloEntreDatas('07:00', '19:00', $value->inicio_expediente, $value->fim_expediente)) {
                    $value->turno = "D";
                    return $value;
                }
            } elseif ($turno == 'NOTURNO') {
                if ($this->intervaloEntreDatas('19:00', '07:00', $value->inicio_expediente, $value->fim_expediente)) {
                    $value->turno = "N";
                    return $value;
                }
            }
        });
        $colaboradores_frequencias->totais = $totais;
        return $colaboradores_frequencias;

    }

    public function gerarRelatorio($dados)
    {
        $turno = $dados['turno'];

        $colaboradores_frequencias = DB::table('frequencias_escalas')
            ->join('colaboradores as c', 'c.id', '=', 'frequencias_escalas.colaborador_id')
            ->join('escalas_profissionais as ep', 'ep.colaborador_id', '=', 'frequencias_escalas.colaborador_id')
            ->join('escalas as e', 'e.id', '=', 'ep.escala_id')
            ->join('cargos', 'cargos.id', '=', 'e.cargo_id')
            ->join('setores as s', 's.id', '=', 'e.setor_id')
            ->join('unidades as u', 'u.id', '=', 'e.unidade_id')
            ->leftJoin('colaboradores_conselhos_profissionais as ccp', 'ccp.colaborador_id', '=', 'c.id')
            ->leftJoin('horarios_trabalho_intervalos as hti', 'hti.colaborador_id', '=', 'c.id')
            ->leftJoin('horarios_trabalho as ht', 'ht.id', '=', 'hti.h_trabalho_id')
            ->whereNull('frequencias_escalas.deleted_at')
            ->where('e.periodo', $dados['data'])
            ->where('u.id', $dados['unidade'])
            ->where('cargos.id', $dados['cargo'])
            ->select(
                'c.nome as nome_colaborador',
                'c.id as colaborador_id',
                'c.matricula as matricula_colaborador',
                's.nome as nome_setor',
                'e.periodo as periodo',
                'e.id as escala_id',
                'ccp.numero_conselho',
                'ht.inicio_expediente',
                'ht.fim_expediente',
                'cargos.descricao as nome_cargo',
                'cargos.id as cargo_id',
                'u.nome as nome_unidade',
                'u.id as unidade_id',
                'ep.dias as dias'
            )
            ->distinct()
            ->get();

        $totais = [
            'ple' => 0,
            'p' => 0,
            'f' => 0,
            'pa' => 0,
            'pex' => 0,
            'sr' => 0,
            'er' => 0,
            'tpr' => 0
        ];
        $colaboradores_frequencias = collect($colaboradores_frequencias)->map(function ($value) use ($turno, &$totais) {
            $dias_plantoes = array_filter(explode(',', $value->dias));
            $presencas = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->where('frequencia', 'PRESENTE')->count();
            $faltas = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->where('frequencia', 'FALTA')->count();
            $avulsos = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->whereNotNull('substituto_avulso')->count();
            $extras = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->whereNotNull('substituto_extra')->count();
            $extras_realizados = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->where('substituto_extra', $value->colaborador_id)->count();
            if ($avulsos > 0) {
                $data_e_nome_avulsos = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->whereNotNull('substituto_avulso')->select('substituto_avulso', 'updated_at', 'motivo_ausencia')->get();

                foreach ($data_e_nome_avulsos as &$item) {
                    $item['justificativa'] = $item['motivo_ausencia'] == null ? 'SEM JUSTIFICATIVA' : $item['motivo_ausencia'];
                    $item['data'] = createdbdToBr($item['updated_at']);
                }

                $value->datas_nomes_avulsos = $data_e_nome_avulsos;
            } else {
                $value->datas_nomes_avulsos = null;
            }

            if ($extras > 0) {
                $data_e_nome_extras = FrequenciaEscala::where('colaborador_id', $value->colaborador_id)->where('escala_id', $value->escala_id)->whereNotNull('substituto_extra')->select('substituto_extra', 'updated_at', 'motivo_ausencia')->get();

                foreach ($data_e_nome_extras as &$item) {
                    $item['justificativa'] = $item['motivo_ausencia'] == null ? 'SEM JUSTIFICATIVA' : $item['motivo_ausencia'];
                    $item['data'] = createdbdToBr($item['updated_at']);
                    $item['nome_colaborador'] = Colaborador::find($item['substituto_extra'])->nome;
                }

                $value->datas_nomes_extras = $data_e_nome_extras;
            } else {
                $value->datas_nomes_extras = null;
            }


            $value->ple = count($dias_plantoes);
            $value->p = $presencas;
            $value->f = $faltas;
            $value->pa = $avulsos;
            $value->pex = $extras;
            $value->sr = $faltas - ($avulsos + $extras);
            $value->er = $extras_realizados;
            $value->tpr = $presencas + $extras_realizados;

            $totais['ple'] = $totais['ple'] + $value->ple;
            $totais['p'] = $totais['p'] + $value->p;
            $totais['f'] = $totais['f'] + $value->f;
            $totais['pa'] = $totais['pa'] + $value->pa;
            $totais['pex'] = $totais['pex'] + $value->pex;
            $totais['sr'] = $totais['sr'] + $value->sr;
            $totais['er'] = $totais['er'] + $value->er;
            $totais['tpr'] = $totais['tpr'] + $value->tpr;


            if ($this->intervaloEntreDatas('07:00', '19:00', $value->inicio_expediente, $value->fim_expediente) == 'DIURNO') {
                $value->turno = "D";
            }

            if ($this->intervaloEntreDatas('19:00', '07:00', $value->inicio_expediente, $value->fim_expediente) == 'NOTURNO') {
                $value->turno = "N";
            }

            if ($turno == 'DIURNO' && $value->turno == "D") {
                return $value;

            } elseif ($turno == 'NOTURNO' && $value->turno == "N") {
                return $value;
            }
        });

        $array = $colaboradores_frequencias->toArray();
        if (count(array_filter($array)) == 0) {
            return null;
        }

        $colaboradores_frequencias->totais = $totais;
        $colaboradores_frequencias->data = str_replace('/', '-', $dados['data']);
        $colaboradores_frequencias->turno = $turno;
        return $colaboradores_frequencias;

    }

    public function gerarFrequencias($dados)
    {
        $periodo = Carbon::createFromFormat('d/m/Y', $dados['data'])->format('m/Y');
        $periodo_result = Carbon::createFromFormat('d/m/Y', $dados['data'])->format('m-Y');
        $dia = Carbon::createFromFormat('d/m/Y', $dados['data'])->format('d');

        $escalas = Escala::where('periodo', $periodo)
            ->where('turno', $dados['turno'])
            ->where('unidade_id', $dados['unidade'])
            ->get();

        $frequencias = [];

        foreach ($escalas as $escala) {
            foreach ($escala->colaboradores as $colaborador) {
                foreach (array_filter(explode(',', $colaborador->pivot->dias)) as $d) {
                    if ((int)$dia == (int)$d) {
                        $frequencias [] = [
                            'escala_id' => $escala->id,
                            'colaborador_id' => $colaborador->id,
                            'dia' => $d,
                        ];
                    }

                }
            }
        }

        try {

            DB::beginTransaction();

            $result = [];

            foreach ($frequencias as $frequencia) {
                $result [] = FrequenciaEscala::firstOrCreate($frequencia);
            }

            DB::commit();

            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Salvo com Sucesso!',
                    'dados' => [
                        'dia' => $dia,
                        'unidade' => $dados['unidade'],
                        'periodo' => $periodo_result,
                        'turno' => $dados['turno'],
                    ]
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

    public function getFrequencias($periodo, $dia, $unidade)
    {
        $periodo = Carbon::createFromFormat('m-Y', $periodo)->format('m/Y');
        $frequencias = new FrequenciaEscala();
        $frequencias = $frequencias
            ->newQuery()
            ->leftJoin('escalas as e', 'e.id', 'frequencias_escalas.escala_id')
            ->leftJoin('colaboradores as c', 'c.id', 'frequencias_escalas.colaborador_id')
            ->leftJoin('admissoes as a', 'a.colaborador_id', 'frequencias_escalas.colaborador_id')
            ->leftJoin('cargos', 'cargos.id', 'a.cargo_id')
            ->leftJoin('colaboradores_conselhos_profissionais as ccp', 'ccp.colaborador_id', 'frequencias_escalas.colaborador_id')
            ->where('e.unidade_id', '=', $unidade)
            ->where('frequencias_escalas.dia', '=', $dia)
            ->where('e.periodo', '=', $periodo)
            ->select('frequencias_escalas.*', 'c.nome', 'cargos.descricao as cargo', 'ccp.numero_conselho')
            ->get();

        return $frequencias;
    }

    public function update($dados)
    {
        $dados = allUpper($dados);
        try {
            DB::beginTransaction();

            $frequencia = FrequenciaEscala::find($dados['frequencia_id']);

            $frequencia->motivo_ausencia = $dados['motivoEdit'];
            $frequencia->tipo_substituto = $dados['tipo_substituto'];
            if ($dados['tipo_substituto'] == 'AVULSO') {
                $frequencia->substituto_avulso = $dados['substitutoAvulsoEdit'];
            } else {
                $frequencia->substituto_extra = $dados['colaborador'];
            }

            $frequencia->frequencia = 'FALTA';
            $frequencia = $frequencia->save();
            DB::commit();

            return [
                'status' => true,
                'message' => 'Alterado Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $frequencia,
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

    public function reverterFrequencia($id)
    {
        try {
            $frequencia = FrequenciaEscala::find($id);
            $frequencia->frequencia = 'PRESENTE';
            $frequencia->motivo_ausencia = null;
            $frequencia->tipo_substituto = 'NENHUM';
            $frequencia->substituto_avulso = null;
            $frequencia->substituto_extra = null;

            $frequencia = $frequencia->save();

            $dados = [
                'status' => true,
                'data' => [
                    'icon' => 'success',
                    'titulo' => "Sucesso",
                    'msg' => 'Alterado com Sucesso!'
                ]
            ];
            return \Response()->json($dados, 200);
        } catch (Exception $exception) {
            switch (get_class($exception)) {
                case ValidatorException::class:
                    throw new HttpResponseException(response()->json([
                        'status' => false, 'message' => 'Não foi possível Alterar.', 'error' => $exception->getMessageBag()
                    ], 500));
                case HttpResponseException::class:
                    throw $exception;
                default:
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Não foi possível Alterar.', 'error' => $exception->getMessage()
                    ], 500));
            }
        }
    }

    public function intervaloEntreDatas($inicio, $fim, $inicio_expediente, $fim_exepediente)
    {
        //inicio_expediente 19:00
        //fim_expediente 07:00
        // 07:00 e 19:00

        if (strtotime($fim_exepediente) > strtotime($inicio_expediente)) {
            return "DIURNO";
//            return (strtotime($inicio_expediente) >= strtotime($inicio) && strtotime($inicio_expediente) <= strtotime($fim) && strtotime($fim_exepediente) >= strtotime($inicio) && strtotime($fim_exepediente) <= strtotime($fim));
        } elseif (strtotime($inicio_expediente) > strtotime($fim_exepediente)) {
            return "NOTURNO";
        }


    }
}