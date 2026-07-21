<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operations
{
    /**
     * Tenta descriptografar um ID vindo da URL
     */
    public static function decryptId($value)
    {
        try {
            // Tenta descriptografar o valor recebido
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            // Em caso de falha/hash inválido, redireciona para a Home
            return null;
        }

        return $value;
    }
}
