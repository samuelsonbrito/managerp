<?php

namespace App\Services;

use App\Models\Contrato;
use App\Models\Escala;
use App\Repositories\Colaborador\ColaboradorRepositoryEloquent as ColaboradorRepository;
use App\Repositories\Dependente\DependenteRepositoryEloquent as DependenteRepository;
use Carbon\Carbon;
use App\Repositories\Anexo\AnexoRepositoryEloquent as AnexoRepository;
use App\Repositories\ColaboradorConselhoProfissional\ColaboradorConselhoProfissionalRepositoryEloquent as ColaboradorConselhoRepository;
use App\Repositories\Documento\DocumentoRepositoryEloquent as DocumentoRepository;
use App\Repositories\Endereco\EnderecoRepositoryEloquent as EnderecoRepository;
use App\Repositories\HorarioTrabalho\HorarioTrabalhoRepositoryEloquent as HorarioTrabalhoRepository;
use App\Repositories\Intervalo\IntervaloRepositoryEloquent as IntervaloRepository;
use App\Repositories\Admissao\AdmissaoRepositoryEloquent as AdmissaoRepository;
use function foo\func;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    private $colaboradorRepository;
    private $paisEstadoCidadeService;
    private $dependenteRepository;
    private $anexoRepository;
    private $colaboradorConselhoRepository;
    private $documentoRepository;
    private $enderecoRepository;
    private $horarioTrabalhoRepository;
    private $intervaloRepository;
    private $admissaoRepository;
    /**
     * @var Contrato
     */
    private $contratoModel;

    function __construct(
        ColaboradorRepository $colaboradorRepository,
        PaisEstadoCidadeService $paisEstadoCidadeService,
        DependenteRepository $dependenteRepository,
        AnexoRepository $anexoRepository,
        ColaboradorConselhoRepository $colaboradorConselhoRepository,
        DocumentoRepository $documentoRepository,
        EnderecoRepository $enderecoRepository,
        HorarioTrabalhoRepository $horarioTrabalhoRepository,
        IntervaloRepository $intervaloRepository,
        AdmissaoRepository $admissaoRepository,
        Contrato $contratoModel
    ) {
        $this->colaboradorRepository = $colaboradorRepository;
        $this->paisEstadoCidadeService = $paisEstadoCidadeService;
        $this->dependenteRepository = $dependenteRepository;
        $this->anexoRepository = $anexoRepository;
        $this->colaboradorConselhoRepository = $colaboradorConselhoRepository;
        $this->documentoRepository = $documentoRepository;
        $this->enderecoRepository = $enderecoRepository;
        $this->horarioTrabalhoRepository = $horarioTrabalhoRepository;
        $this->intervaloRepository = $intervaloRepository;
        $this->admissaoRepository = $admissaoRepository;
        $this->contratoModel = $contratoModel;
    }

    public function conselhosAVencer()
    {
        $colaboradores_conselhos = $this->colaboradorConselhoRepository
            ->makeModel()
            ->newQuery()
            ->leftJoin('conselhos_profissionais', 'conselhos_profissionais.id', '=', 'colaboradores_conselhos_profissionais.conselho_id')
            ->leftJoin('colaboradores', 'colaboradores.id', '=', 'colaboradores_conselhos_profissionais.colaborador_id')
            ->select('colaboradores.nome as nome_colaborador', 'conselhos_profissionais.*', 'colaboradores_conselhos_profissionais.*')
            ->get();

        $conselhos_vencendo = collect($colaboradores_conselhos)->filter(function ($item, $key) {
            $data_vencimento = Carbon::createFromFormat('Y-m-d', $item['data_validade']);
            $data_atual = Carbon::now();
            if ($data_atual < $data_vencimento) {
                $dias = $data_atual->diffInDays($data_vencimento);
                if ($dias <= 60) {
                    return $item;
                }
            }
        });

        $conselhos_vencendo = collect($conselhos_vencendo)->map(function ($item, $key) {
            $item['data_validade'] = bdToBr($item['data_validade']);
            return $item;

        });
        if (\Route::getCurrentRoute()->getName() == 'conselhos.prestes.vencer' || \Route::getCurrentRoute()->getName() == 'imprimir.conselhos.prestes.vencer') {
            return $conselhos_vencendo;
        }
        return $conselhos_vencendo->count();

    }


    public function conselhosVencidos()
    {
        $colaboradores_conselhos = $this->colaboradorConselhoRepository
            ->makeModel()
            ->newQuery()
            ->leftJoin('conselhos_profissionais', 'conselhos_profissionais.id', '=', 'colaboradores_conselhos_profissionais.conselho_id')
            ->leftJoin('colaboradores', 'colaboradores.id', '=', 'colaboradores_conselhos_profissionais.colaborador_id')
            ->select('colaboradores.nome as nome_colaborador', 'conselhos_profissionais.*', 'colaboradores_conselhos_profissionais.*')
            ->get();

        $conselhos_vencidos = collect($colaboradores_conselhos)->filter(function ($item, $key) {
            $data_vencimento = Carbon::createFromFormat('Y-m-d', $item['data_validade']);
            $data_atual = Carbon::now();
            if ($data_atual > $data_vencimento) {
                return $item;
            }
        });

        $conselhos_vencidos = collect($conselhos_vencidos)->map(function ($item, $key) {
            $item['data_validade'] = bdToBr($item['data_validade']);
            return $item;

        });
        if (\Route::getCurrentRoute()->getName() == 'conselhos.vencidos' || \Route::getCurrentRoute()->getName() == 'imprimir.conselhos.vencidos') {
            return $conselhos_vencidos;
        }
        return $conselhos_vencidos->count();

    }

    public function alertaFerias()
    {
        $colaboradores = $this->colaboradorRepository
            ->makeModel()
            ->newQuery()
            ->has('admissao')
            ->leftJoin('admissoes', 'admissoes.colaborador_id', '=', 'colaboradores.id')
            ->leftJoin('cargos', 'cargos.id', '=', 'admissoes.cargo_id')
            ->select('colaboradores.*', 'admissoes.*', 'cargos.descricao as cargo_descricao')
            ->get();


        $colaboradores = collect($colaboradores)->filter(function ($item, $key) {
            $data_admissao = Carbon::createFromFormat('Y-m-d', $item['data_admissao']);
            $data_atual = Carbon::now();
            if ($data_atual > $data_admissao) {
                $dias = $data_atual->diffInDays($data_admissao);
                if ($dias >= 547) {
                    return $item;
                } else {
                    return null;
                }

            }
        });


        $colaboradores = collect($colaboradores)->map(function ($item, $key) {
            $item['data_admissao'] = bdToBr($item['data_admissao']);
            return $item;

        });

        if (\Route::getCurrentRoute()->getName() == 'alerta.ferias.colaboradores' || \Route::getCurrentRoute()->getName() == 'imprimir.alerta.ferias') {
            return $colaboradores;
        }
        return $colaboradores->count();

    }

    public function getTotalReceitas() {

        $receitas = $this->contratoModel
            ->where('status','ATIVO')
            ->get();

        $totalReceitas = $receitas->map(function($item){
            return $item->valor;
        })->sum();
        return $totalReceitas;
    }
    public function getTotalCustos(){
        $custos = $this->admissaoRepository->get();
        $totalCustos = $custos->map(function ($item){
            return $item->salario;
        })->sum();

        return $totalCustos;
    }
    public function getLucroTotal() {

        $custoTotal = self::getTotalCustos();
        $totalReceitas = self::getTotalReceitas();

        return $totalReceitas - $custoTotal;
    }

    public function frequenciaDiaAnterior()
    {
        $data_anterior = new Carbon('last day', 'America/Cuiaba');
        $dia = $data_anterior->format('d');
        $mes_ano = $data_anterior->format('m/Y');

        $presentes = DB::table('frequencias_escalas')
            ->join('escalas_profissionais as ep', 'ep.escala_id', '=', 'frequencias_escalas.escala_id')
            ->join('escalas as e', 'e.id', '=', 'ep.escala_id')
            ->where('frequencia', 'PRESENTE')
            ->distinct()
            ->select('frequencias_escalas.id as frequencia_id', 'e.id as escala_id', 'e.periodo', 'frequencias_escalas.dia')
            ->where('frequencias_escalas.dia', $dia)
            ->get()->count();

        $faltas = DB::table('frequencias_escalas')
            ->join('escalas_profissionais as ep', 'ep.escala_id', '=', 'frequencias_escalas.escala_id')
            ->join('escalas as e', 'e.id', '=', 'ep.escala_id')
            ->where('frequencia', 'FALTA')
            ->distinct()
            ->select('frequencias_escalas.id as frequencia_id', 'e.id as escala_id', 'e.periodo', 'frequencias_escalas.dia')
            ->where('frequencias_escalas.dia', $dia)
            ->get()->count();


        $unidade_mais_faltantes = DB::table('frequencias_escalas')

            ->where('dia', $dia)
            ->select(DB::raw('count(*) as dia, escala_id'))
            ->where('frequencia', '=', 'FALTA')
            ->groupBy('escala_id')
            ->orderBy('dia', 'asc')
            ->get();

        $unidade_mais_presentes = DB::table('frequencias_escalas')

            ->where('dia', $dia)
            ->select(DB::raw('count(*) as dia, escala_id'))
            ->where('frequencia', '=', 'PRESENTE')
            ->groupBy('escala_id')
            ->orderBy('dia', 'asc')
            ->get();

        $unidade_mais_faltantes =$unidade_mais_faltantes->map(function ($value) {
            $value->nome_unidade = Escala::find($value->escala_id)->unidade->nome ?? null;
            return $value;
        });

        $unidade_mais_presentes = $unidade_mais_presentes->map(function ($value) {
            $value->nome_unidade = Escala::find($value->escala_id)->unidade->nome ?? null;
            return $value;
        });

        $unidade_mais_faltantes = $unidade_mais_faltantes->filter(function ($value) {
            return $value->nome_unidade != null;
        });

        $unidade_mais_presentes = $unidade_mais_presentes->filter(function ($value) {
            return $value->nome_unidade != null;
        });


// Os resultados serão 80% e 20%

        $percentual_falta_unidade = count($unidade_mais_faltantes) == 0 ? 0 : ($unidade_mais_faltantes->last()->dia / $faltas) * 100;
        $percentual_presenca_unidade = count($unidade_mais_presentes) == 0 ? 0 : ($unidade_mais_presentes->last()->dia / $presentes) * 100;


        return $frequencia = [
            'presentes' => $presentes,
            'faltas' => $faltas,
            'total_frequencia' => $presentes + $faltas,
            'data' => $data_anterior->format('d/m/Y'),
            'unidade_mais_faltantes' => $unidade_mais_faltantes->last()->nome_unidade ?? null,
            'unidade_mais_presentes' => $unidade_mais_presentes->last()->nome_unidade ?? null,
            'percentual_falta' => number_format($percentual_falta_unidade, '0'),
            'percentual_presenca' => number_format($percentual_presenca_unidade, '0')
        ];
    }
}