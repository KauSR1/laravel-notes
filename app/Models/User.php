<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Campos liberados para cadastro em massa
#[Fillable(['name', 'email', 'password'])]
// Campos ocultados no retorno do JSON/Array
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Conversão de tipos de dados
     */
    protected function casts(): array
    {
        return [
            // Converter para objeto de Data/Hora
            'email_verified_at' => 'datetime',
            // Hash automático na senha ao salvar
            'password' => 'hashed',
        ];
    }

    /**
     * Relacionamento: Tem muitas notas
     */
    public function notes()
    {
        // Usuário possui várias notas
        return $this->hasMany(Note::class);
    }
}
