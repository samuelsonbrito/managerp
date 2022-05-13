<?php

namespace App\Http\Controllers\Horario;

use App\Http\Requests\HorarioIntervaloRequest;
use App\Http\Controllers\Controller;
use App\DataTables\HorarioIntervaloDataTable;
use App\Services\IntervaloService;

class HorarioIntervaloController extends Controller
{
    private $horarioIntervaloDataTable;
    private $horarioIntervaloService;

    public function __construct(HorarioIntervaloDataTable $horarioIntervaloDataTable, IntervaloService $horarioIntervaloService)
    {
        $this->middleware('permissao-perfil:horario');
        $this->horarioIntervaloDataTable = $horarioIntervaloDataTable;
        $this->horarioIntervaloService = $horarioIntervaloService;
    }

    public function index()
    {
        return $this->horarioIntervaloDataTable->render('horario.horario-intervalo.horario-index');
    }

    public function create()
    {
        //
    }

    public function store(HorarioIntervaloRequest $request)
    {
        return $this->horarioIntervaloService->salvar($request->all());
    }

    public function show()
    {
        //
    }

    public function edit()
    {

    }

    public function update(HorarioIntervaloRequest $request)
    {
        return $this->horarioIntervaloService->update($request->all());
    }

    public function destroy($id)
    {
        $dados = $this->horarioIntervaloService->excluir($id);
        return redirect('horario-intervalo')->with($dados->original['data']);
    }
}
