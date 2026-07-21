<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operations
{
    /**
     * Descriptografar ID
     */
    public static function decryptId($value)
    {
        try {
            // Descriptografar valor
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            // Se falhar/inválido -> retorna null
            return null;
        }

        return $value;
    }
}
