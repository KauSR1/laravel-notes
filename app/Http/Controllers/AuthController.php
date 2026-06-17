<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login() {
        return view('login-form');
    }

    public function logout() {
        echo "logout";
    }

    public function loginSubmit(Request $request) {
        // Validação form login
        $request->validate([
            // Regras (trocado - por _)
            'login_username' => 'required|email',
            'login_password' => 'required|min:6|max:20'
        ],
            [   // Mensagem de erros (trocado - por _)
                'login_username.required' => 'O login deve ser preenchido.',
                'login_username.email' => 'O login deve ser preenchido com um email válido.', // Adicionado para cobrir o erro de e-mail inválido
                'login_password.required' => 'A senha deve ser preenchida.',
                'login_password.min' => 'A senha deve ter ao menos :min caracteres.',
                'login_password.max' => 'A senha deve ter no máximo :max caracteres.'
            ]);

        // Capturar usuário e senha (trocado - por _)
        $username = $request->input('login_username');
        $password = $request->input('login_password');

        //testar conexao com banco de Dados
        try {
            DB::connection()->getPdo();
            echo "okay";
        } catch (\Throwable $e) {
            echo "erro ao conectar ao Db" . $e->getMessage();
        } echo  "final";
    }
}
