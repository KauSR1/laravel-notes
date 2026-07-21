<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Tela inicial (Listagem de notas)
     */
    public function index(){

        // Pegar ID do usuário na sessão
        $id = session('user.id');

        // Se não tiver ID na sessão -> login
        if (!$id) {
            return redirect()->route('login')->with('loginError', 'Sessão expirada. Faça login novamente.');
        }

        // Buscar usuário no banco
        $userModel = User::find($id);

        // Se usuário não existir no banco -> limpar sessão e ir para o login
        if (!$userModel) {
            session()->flush();
            return redirect()->route('login')->with('loginError', 'Usuário não encontrado.');
        }

        // Converter dados do usuário para array
        $user = $userModel->toArray();

        // Pegar notas ativas do usuário (mais recentes primeiro)
        $notes = $userModel->notes()->whereNull('deleted_at')->orderBy('created_at', 'desc')->get()->toArray();

        // Exibir view 'home' com as notas
        return view('home', ['notes' => $notes]);
    }

    /**
     * Tela para criar nova nota
     */
    public function newNote(){
        // Exibe formulário de criação
        return view('new_note');
    }

    /**
     * Ação de salvar nova nota
     */
    public function newNoteSubmit(Request $request)
    {
        // Validar título e descrição
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

        // Pegar ID do usuário na sessão
        $id = session('user.id');

        // Se não tiver sessão -> login
        if (!$id) {
            return redirect()->route('login')->with('loginError', 'Sessão expirada. Faça login novamente.');
        }

        // Criar e salvar nova nota no banco
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->description = $request->text_note;
        $note->save();

        // Redirecionar para home com mensagem de sucesso
        return redirect()->route('home')->with('success', 'Nota criada com sucesso!');
    }

    /**
     * Tela de edição de nota
     */
    public function editNote($id)
    {
        // Descriptografar ID da URL
        $id = Operations::decryptId($id);

        // Se ID for inválido -> volta pra home
        if($id == null){
            return redirect()->route('home');
        }

        // Buscar nota no banco e exibir formulário
        $note = Note::find($id);
        return view('edit_note', ['note' => $note]);
    }

    /**
     * Ação de salvar alteração da nota
     */
    public function editNoteSubmit(Request $request)
    {
        // Validar título e descrição
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

        // Se não enviou ID da nota -> volta pra home
        if($request->note_id == null){
            return redirect()->route('home');
        }

        // Descriptografar ID enviado no form
        $id = Operations::decryptId($request->note_id);

        // Se ID for inválido -> volta pra home
        if($id == null){
            return redirect()->route('home');
        }

        // Buscar nota, atualizar dados e salvar
        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->description = $request->text_note;
        $note->save();

        // Redirecionar para home com mensagem de sucesso
        return redirect()->route('home')->with('success', 'Nota alterada com sucesso!');
    }

    /**
     * Tela de confirmação de exclusão
     */
    public function deleteNote($id)
    {
        // Descriptografar ID da URL
        $id = Operations::decryptId($id);

        // Se ID for inválido -> volta pra home
        if($id == null){
            return redirect()->route('home');
        }

        // Buscar nota no banco e exibir tela de confirmação
        $note = Note::find($id);

        return view('delete_note', ['note' => $note]);
    }

    /**
     * Ação de deletar a nota
     */
    public function deleteNoteConfirm($id) {

        // Descriptografar ID da URL
        $id = Operations::decryptId($id);

        // Se ID for inválido -> volta pra home
        if($id == null){
            return redirect()->route('home');
        }

        // Buscar nota e deletar do banco
        $note = Note::find($id);
        $note->delete();

        // Redirecionar para home
        return redirect()->route('home');
    }
}
