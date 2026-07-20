<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Exibe a tela com o formulário de login.
     */
    public function login() {
        return view('login-form');
    }

    /**
     * Processa o envio do formulário de login (Autenticação).
     */
    public function loginSubmit(Request $request) {

        // 1. Validação: Garante que os dados enviados seguem as regras e define mensagens de erro customizadas
        $request->validate([
            'login_email' => 'required|email',
            'login_password' => 'required|min:6|max:20'
        ],
            [
                'login_email.required' => 'O campo e-mail deve ser preenchido.',
                'login_email.email' => 'O login deve ser preenchido com um email válido.',
                'login_password.required' => 'A senha deve ser preenchida.',
                'login_password.min' => 'A senha deve ter ao menos :min caracteres.',
                'login_password.max' => 'A senha deve ter no máximo :max caracteres.'
            ]);

        // 2. Captura: Guarda o e-mail e senha vindos do formulário em variáveis
        $email = $request->input('login_email');
        $password = $request->input('login_password');

        // 3. Busca no Banco: Procura pelo usuário ativo (não deletado) usando o e-mail informado
        $user_validated = User::where('email', $email)
            ->where('deleted_at', null)
            ->first();

        // 4. Checagem de E-mail: Se o usuário não for encontrado, volta ao formulário com erro
        if (!$user_validated) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha invalido.');
        }

        // 5. Checagem de Senha: Descriptografa e compara a senha digitada com a do banco
        if (!password_verify($password, $user_validated->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha invalido.');
        }

        // 6. Histórico: Atualiza e salva a coluna 'last_login' com a data/hora atual do acesso
        $user_validated->last_login = date('Y-m-d H:i:s');
        $user_validated->save();

        // 7. Sessão: Grava o e-mail e o ID do usuário na sessão do navegador (identifica o usuário logado)
        session(['user' => $user_validated->email, 'id' => $user_validated->id]);

        // 8. Sucesso: Redireciona o usuário para a página inicial (Home)
        return redirect()->to('/');
    }

    /**
     * Desconecta o usuário do sistema.
     */
    public function logout() {
        // session()->flush(): Limpa e destrói todos os dados salvos na sessão atual (incluindo o ID)
        session()->flush();

        // Redireciona de volta para a tela de login
        return redirect()->route('login');
    }
}
