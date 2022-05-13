<?php

namespace App\Http\Middleware;

use Auth;

use Closure;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Repositories\UserRepositoryEloquent;

class PermissaoPerfil
{
    public function handle($request, Closure $next, $chave = null)
    {
        if (!Auth::check()) {
            return response(view('auth.login'));

        } else {
            if(\Gate::allows('isAdmin')){
                return $next($request);
//
            } else {
                if(auth()->user()->perfil->modulos->where('chave', $chave)->isEmpty()){
                    abort(403, "Desculpe, você não tem permissão!");
                } else {
                    return $next($request);
                }


            }
        }
    }
}
