<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PerfilDataTable;
use App\DataTables\PerfilModuloDataTable;
use App\DataTables\UsuarioDataTable;
use App\Models\Perfil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdministradorService;

class AdministradorController extends Controller
{
    private $usuarioDataTable;
    private $perfilDataTable;
    private $perfilModuloDataTable;
    private $administradorService;

    public function __construct(UsuarioDataTable $usuarioDataTable, AdministradorService $administradorService, PerfilDataTable $perfilDataTable, PerfilModuloDataTable $perfilModuloDataTable)
    {
        $this->middleware('permissao-perfil:administrador');
        $this->usuarioDataTable = $usuarioDataTable;
        $this->perfilDataTable = $perfilDataTable;
        $this->perfilModuloDataTable = $perfilModuloDataTable;
        $this->administradorService = $administradorService;
    }

    public function index()
    {
        $modulos = AdministradorService::getModulos();
        $usuarios = AdministradorService::getUsuarios();
        $perfis = AdministradorService::getPerfisTable();

        return view('admin.admin-index', compact('modulos', 'usuarios', 'perfis'));
    }

    public function usuarioIndex()
    {
        $perfis = AdministradorService::getPerfis();
        return $this->usuarioDataTable->render('usuario.usuario-index', compact('perfis'));
    }

    public function salvarUsuario(Request $request)
    {
        return $this->administradorService->salvarUsuario($request);
    }

    public function excluirUsuario(Request $request)
    {
        $dados = $this->administradorService->excluirUsuario($request);
        return redirect()->route('admin.usuario')->with($dados->original['data']);
    }

    public function perfilIndex()
    {
        return $this->perfilDataTable->render('perfil.perfil-index');
    }

    public function salvarPerfil(Request $request)
    {
        return $this->administradorService->salvarPerfil($request);
    }

    public function excluirPerfil(Request $request)
    {
        $dados = $this->administradorService->excluirPerfil($request);
        return redirect()->route('admin.perfil')->with($dados->original['data']);
    }

    public function permissaoAcesso()
    {
        $perfis = AdministradorService::getPerfis();
        return $this->perfilModuloDataTable->render('admin.admin-gerenciar-modulos', compact('perfis'));
    }

    public function adicionarPermissaoAcesso(Request $request)
    {
        return $this->administradorService->adicionarPermissaoAcesso($request);
    }

    public function removerPermissaoAcesso(Request $request)
    {
        $dados = $this->administradorService->removerPermissaoAcesso($request);
        return redirect()->route('admin.permissao-acesso')->with($dados->original['data']);
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
