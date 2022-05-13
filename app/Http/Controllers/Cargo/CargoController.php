<?php

namespace App\Http\Controllers\Cargo;

use App\Http\Requests\CargoRequest;
use App\Http\Controllers\Controller;
use App\DataTables\CargoDataTable;
use App\Services\CargoServices;
use App\Http\Requests\UnidadeRequest;

class CargoController extends Controller
{
    private $cargoDataTable;
    private $cargoService;

    public function __construct(CargoDataTable $cargoDataTable, CargoServices $cargoService)
    {
        $this->middleware('permissao-perfil:cargo');
        $this->cargoDataTable = $cargoDataTable;
        $this->cargoService = $cargoService;
    }

    public function index()
    {
        return $this->cargoDataTable->render('cargo.cargo-index');
    }

    public function create()
    {
        //
    }

    public function store(CargoRequest $request)
    {
        return $this->cargoService->salvar($request->all());
    }

    public function show()
    {
        //
    }

    public function edit()
    {

    }

    public function update(CargoRequest $request)
    {
        return $this->cargoService->update($request->all());
    }

    public function destroy($id)
    {
        $dados = $this->cargoService->excluir($id);
        return redirect('cargo')->with($dados->original['data']);
    }
}
