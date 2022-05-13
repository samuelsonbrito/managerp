<?php

namespace App\Http\Controllers\Cliente;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ClienteDataTable;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    private $clienteDataTable;
    private $clienteService;

    public function __construct(ClienteDataTable $clienteDataTable, ClienteService $clienteService)
    {
        $this->middleware('permissao-perfil:cliente');
        $this->clienteDataTable = $clienteDataTable;
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        return $this->clienteDataTable->render('cliente.cliente-index');
    }

    public function create()
    {
        return view('cliente.cliente-create');
    }

    public function store(Request $request)
    {
        if ($request->cliente_id) {
            return $this->clienteService->update($request->all());
        } else {
            return $this->clienteService->salvar($request->all());
        }
    }

    public function show($id)
    {
        $data = [
            'cliente' => Cliente::find($id)
        ];
        return view('cliente.cliente-visualizar')->with($data);

    }

    public function edit($id)
    {
        $data = [
            'cliente' => Cliente::find($id)
        ];

        return view('cliente.cliente-create')->with($data);
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        $dados = $this->clienteService->excluir($id);
        return redirect('cliente')->with($dados->original['data']);
    }
}
