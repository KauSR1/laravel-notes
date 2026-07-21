<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfLogged
{
    /**
     * Middleware de proteção de rota
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se NÃO estiver logado -> vai pro login
        if(!session('user')) {
            return redirect('/login');
        }

        // Se estiver logado -> continua
        return $next($request);
    }
}
