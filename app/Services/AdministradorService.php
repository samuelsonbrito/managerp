<?php

namespace App\Services;

use App\Models\Modulo;
use App\Models\Perfil;
use App\Models\Unidade;
use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AdministradorService
{
    public static function getModulos()
    {
        return Modulo::all();
    }

    public static function getUsuarios()
    {
        return User::all();
    }

    public static function getPerfis()
    {
        return Perfil::all()->pluck('descricao', 'id');
    }

    public static function getPerfisTable()
    {
        return Perfil::all();
    }

    public function getModulosSelect()
    {
        return Modulo::all()->pluck('modulo', 'id');
    }

    public function salvarUsuario($request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->nome,
                'username' => $request->nome_usuario,
                'email' => $request->email,
                'password' => Hash::make($request->senha),
                'perfil_id' => $request->perfil,
                'status' => $request->status,
            ]);

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $user,
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

    public function excluirUsuario($request)
    {
        try {
            $usuario = User::find($request->id);
            $usuario->delete();

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

    public function salvarPerfil($request)
    {
        DB::beginTransaction();

        try {
            $user = Perfil::create([
                'descricao' => $request->descricao,
            ]);

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $user,
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

    public function excluirPerfil($request)
    {
        try {
            $perfil = Perfil::find($request->id);
            $perfil->delete();

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

    public function adicionarPermissaoAcesso($request)
    {
        DB::beginTransaction();

        try {
            $perfil = Perfil::find($request->perfil);
            $perfil->modulos()->detach();
            foreach ($request->modulos as $modulo) {
                $perfil->modulos()->attach($modulo, [
                    'cadastrar' => (bool)$request->cadastrar ?? false,
                    'editar' => (bool)$request->editar ?? false,
                    'visualizar' => (bool)$request->visualizar ?? false,
                    'excluir' => (bool)$request->excluir ?? false,
                ]);
            }

            DB::commit();

            return [
                'status' => true,
                'message' => 'Salvo Com Sucesso!',
                'data' => $dados = [
                    'unidade' => $perfil,
                ]
            ];

        } catch (Throwable $throwable) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Não foi possível Adicionar.', 'error' => $throwable->getMessage()
            ], 500));
        }
    }

    public function removerPermissaoAcesso($request)
    {
        try {
            $perfil = Perfil::find($request->id);
            $perfil->modulos()->detach();

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
}