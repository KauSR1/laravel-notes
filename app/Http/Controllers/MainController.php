<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Exibe a página inicial (Home) com a listagem de notas do usuário.
     */
    public function index(){

        // 1. Identificação: Pega o ID do usuário que foi salvo na sessão lá no AuthController
        $id = session('id');

        // 2. Proteção de Sessão: Se o ID não existir (sessão expirou ou não fez login), desvia para a tela de login
        if (!$id) {
            return redirect()->route('login')->with('loginError', 'Sessão expirada. Faça login novamente.');
        }

        // 3. Busca no Banco: Tenta encontrar o registro do usuário usando o ID da sessão
        $userModel = User::find($id);

        // 4. Proteção de Registro: Se o ID está na sessão mas sumiu do banco, limpa a sessão e manda para o login
        if (!$userModel) {
            session()->flush();
            return redirect()->route('login')->with('loginError', 'Usuário não encontrado.');
        }

        // 5. Conversão: Transforma os dados do usuário em um array simples do PHP
        $user = $userModel->toArray();

        // 6. Busca de Notas: Puxa todas as notas vinculadas a esse usuário, ordenando das mais recentes para as mais antigas
        $notes = $userModel->notes()->orderBy('created_at', 'desc')->get()->toArray();

        // 7. Renderização: Abre a view 'home' passando a lista de notas para ser exibida na tela
        return view('home', ['notes' => $notes]);
    }

    /**
     * Exibe o formulário de criação de uma nova nota.
     */
    public function newNote(){
        // ...
    }
}
