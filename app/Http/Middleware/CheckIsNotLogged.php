<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsNotLogged
{
    /**
     * Intercepta a requisição (usado em rotas como a tela de Login).
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Redirecionamento: Se o usuário JÁ estiver logado, impede que ele veja a tela de login e o manda para a Home
        if(session('user')) {
            return redirect('/');
        }

        // 2. Permissão: Se o usuário NÃO estiver logado, permite que ele acesse a página normalmente (ex: formulário de login)
        return $next($request);
    }
}
