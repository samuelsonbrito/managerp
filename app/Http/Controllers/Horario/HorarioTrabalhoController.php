<?php

namespace App\Http\Controllers\Horario;

use App\Http\Requests\HorarioTabalhoRequest;
use App\Http\Controllers\Controller;
use App\DataTables\HorarioTabalhoDataTable;
use App\Services\HorarioTrabalhoService;

class HorarioTrabalhoController extends Controller
{
    private $horarioTrabalhoDataTable;
    private $horarioTrabalhoService;

    public function __construct(HorarioTabalhoDataTable $horarioTabalhoDataTable, HorarioTrabalhoService $horarioTrabalhoService)
    {
        $this->middleware('permissao-perfil:horario');
        $this->horarioTrabalhoDataTable = $horarioTabalhoDataTable;
        $this->horarioTrabalhoService = $horarioTrabalhoService;
    }

    public function index()
    {
        return $this->horarioTrabalhoDataTable->render('horario.horario-trabalho.horario-index');
    }

    public function create()
    {
        //
    }

    public function store(HorarioTabalhoRequest $request)
    {
        return $this->horarioTrabalhoService->salvar($request->all());
    }

    public function show()
    {
        //
    }

    public function edit()
    {

    }

    public function update(HorarioTabalhoRequest $request)
    {
        return $this->horarioTrabalhoService->update($request->all());
    }

    public function destroy($id)
    {
        $dados = $this->horarioTrabalhoService->excluir($id);
        return redirect('horario-trabalho')->with($dados->original['data']);
    }
}
