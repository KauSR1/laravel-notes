<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    Use SoftDeletes;
    /**
     * Define o relacionamento inverso com o Usuário.
     */
    public function user()
    {
        // AJUSTE: Troquei 'belongsToMany' (Muitos para Muitos) por 'belongsTo' (Muitos para Um).
        // Significa: "Esta nota pertence a um único Usuário".
        return $this->belongsTo(User::class);
    }
}
