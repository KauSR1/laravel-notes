<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    // Ativa soft delete (exclusão lógica)
    Use SoftDeletes;

    /**
     * Relacionamento: Pertence a um usuário
     */
    public function user()
    {
        // Uma nota pertence a apenas 1 usuário
        return $this->belongsTo(User::class);
    }
}
