<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Tela de login
     */
    public function login() {
        // Exibe a view com o formulário
        return view('login-form');
    }

    /**
     * Ação de login (Autenticação)
     */
    public function loginSubmit(Request $request) {

        // Validar campos (E-mail e Senha)
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

        // Pegar dados do form
        $email = $request->input('login_email');
        $password = $request->input('login_password');

        // Buscar usuário ativo no banco
        $user_validated = User::where('email', $email)
            ->where('deleted_at', null)
            ->first();

        // Se e-mail não existir -> erro
        if (!$user_validated) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha invalido.');
        }

        // Se senha não bater -> erro
        if (!password_verify($password, $user_validated->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha invalido.');
        }

        // Registrar data/hora do último acesso
        $user_validated->last_login = date('Y-m-d H:i:s');
        $user_validated->save();

        // Salvar dados do usuário na sessão (ID e E-mail)
        session([
            'user' => [
                'id'    => $user_validated->id,
                'email' => $user_validated->email,
            ]
        ]);

        // Ir para a Home
        return redirect()->to('/');
    }

    /**
     * Ação de Logout
     */
    public function logout() {
        // Limpar sessão
        session()->flush();

        // Voltar para o login
        return redirect()->route('login');
    }
}
