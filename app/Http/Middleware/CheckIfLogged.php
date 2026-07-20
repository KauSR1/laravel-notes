<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfLogged
{
    /**
     * Intercepta a requisição antes que ela chegue no Controller.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Bloqueio: Se NÃO houver 'user' salvo na sessão, desvia o usuário direto para a tela de login
        if(!session('user')) {
            return redirect('/login');
        }

        // 2. Permissão: Se o usuário estiver logado, deixa a requisição continuar para a rota solicitada
        return $next($request);
    }
}
