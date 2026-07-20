<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Atributos PHP (Laravel 11+): Define quais campos aceitam cadastro em massa (Fillable) e quais ficam ocultos em consultas (Hidden)
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    // Traits padrão do Laravel para habilitar Factories (testes) e Notificações (e-mails, etc)
    use HasFactory, Notifiable;

    /**
     * Conversão de Tipos (Casting).
     */
    protected function casts(): array
    {
        return [
            // Transforma o campo em um objeto Carbon (Data/Hora) do PHP
            'email_verified_at' => 'datetime',
            // Encripta a senha automaticamente ao salvar no banco usando as ferramentas nativas
            'password' => 'hashed',
        ];
    }

    /**
     * Relacionamento: Um para Muitos.
     */
    public function notes()
    {
        // hasMany: Define que este Usuário pode possuir várias Notas vinculadas ao seu ID
        return $this->hasMany(Note::class);
    }
}
