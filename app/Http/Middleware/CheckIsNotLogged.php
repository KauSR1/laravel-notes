<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsNotLogged
{
    /**
     * Impedir acesso de usuários já logados
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se JÁ estiver logado -> vai pra Home
        if(session('user')) {
            return redirect('/');
        }

        // Se NÃO estiver logado -> continua
        return $next($request);
    }
}
