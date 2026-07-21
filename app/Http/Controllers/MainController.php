<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Exibe a página inicial (Home) com a listagem de notas do usuário.
     */
    public function index(){

        // 1. Identificação: Pega o ID do usuário que foi salvo na sessão lá no AuthController
        $id = session('user.id');

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
        $notes = $userModel->notes()->whereNull('deleted_at')->orderBy('created_at', 'desc')->get()->toArray();

        // 7. Renderização: Abre a view 'home' passando a lista de notas para ser exibida na tela
        return view('home', ['notes' => $notes]);
    }

    /**
     * Exibe o formulário de criação de uma nova nota.
     */
    public function newNote(){
        // Renderização: Exibe a tela com o formulário para o usuário digitar a nova nota
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        $request->validate([
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:3000'
        ],
        [
            'text_title.required' => 'O campo Titulo deve ser preenchido.',
            'text_title.min' => 'O Titulo deve ter ao menos :min caracteres.',
            'text_title.max' => 'O Titulo deve ter no máximo :max caracteres.',

            'text_note.required' => 'A descrição deve ser preenchida.',
            'text_note.min' => 'A descrição deve ter ao menos :min caracteres.',
            'text_note.max' => 'A descrição deve ter no máximo :max caracteres.'
        ]);

        $id = session('user.id');

        if (!$id) {
            return redirect()->route('login')->with('loginError', 'Sessão expirada. Faça login novamente.');
        }

        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->description = $request->text_note;

        $note->save();
        return redirect()->route('home')->with('success', 'Nota criada com sucesso!');
    }

    /**
     * Exibe o formulário para edição de uma nota existente.
     *
     * @param string $id ID da nota criptografado vindo da URL
     */
    public function editNote($id)
    {
        // Descriptografia: Descriptografa o ID recebido via URL para obter o ID real no banco de dados
        $id = Operations::decryptId($id);

        if($id == null){
            return redirect()->route('home');
        }

        $note = Note::find($id);
        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request)
    {
        $request->validate([
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:3000'
        ],
            [
                'text_title.required' => 'O campo Titulo deve ser preenchido.',
                'text_title.min' => 'O Titulo deve ter ao menos :min caracteres.',
                'text_title.max' => 'O Titulo deve ter no máximo :max caracteres.',

                'text_note.required' => 'A descrição deve ser preenchida.',
                'text_note.min' => 'A descrição deve ter ao menos :min caracteres.',
                'text_note.max' => 'A descrição deve ter no máximo :max caracteres.'
            ]);

        if($request->note_id == null){
            return redirect()->route('home');
        }

        $id = Operations::decryptId($request->note_id);

        if($id == null){
            return redirect()->route('home');
        }

        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->description = $request->text_note;
        $note->save();

        return redirect()->route('home')->with('success', 'Nota alterada com sucesso!');
    }

    /**
     * Exibe a confirmação ou processa a exclusão de uma nota.
     *
     * @param string $id ID da nota criptografado vindo da URL
     */
    public function deleteNote($id)
    {
        // Descriptografia: Descriptografa o ID recebido via URL para obter o ID real no banco de dados
        $id = Operations::decryptId($id);

        if($id == null){
            return redirect()->route('home');
        }

        $note = Note::find($id);

        return view('delete_note', ['note' => $note]);
    }

    public function deleteNoteConfirm($id) {

        $id = Operations::decryptId($id);

        if($id == null){
            return redirect()->route('home');
        }

        $note = Note::find($id);
        $note->delete();

        return redirect()->route('home');
    }
}
