<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login() {
        return view('login-form');
    }

    public function loginSubmit(Request $request) {
        // Validação form login
        $request->validate([
            // Implementação das Regras
            'login_email' => 'required|email',
            'login_password' => 'required|min:6|max:20'
        ],
        [ //Mostra os erros na tela
            'login_email' => 'O login deve ser preenchido com um email válido.', // Adicionado para cobrir o erro de e-mail inválido
            'login_password.required' => 'A senha deve ser preenchida.',
            'login_password.min' => 'A senha deve ter ao menos :min caracteres.',
            'login_password.max' => 'A senha deve ter no máximo :max caracteres.'
        ]);

        // Capturar usuário e senha
        $email = $request->input('login_email');
        $password = $request->input('login_password');

        //Validar se o user existe na aplicação
        $user_validated = User::where('email', $email)
            ->where('deleted_at', null)
            ->first();

        if (!$user_validated) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha invalido.');
        }

        if (!password_verify($password, $user_validated->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha invalido.');
        }

        // atualizar o ultimo acesso "online"
        $user_validated->last_login = date('Y-m-d H:i:s');
        $user_validated->save();

        //Salvar o login da sessão
        session(['user' => $user_validated->email]);
    }

    public function logout() {
        session()->forget('user');
        return redirect()->route('login');
    }

}
