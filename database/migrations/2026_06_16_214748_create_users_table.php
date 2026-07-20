<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Criação da tabela.
     */
    public function up(): void
    {
        // Schema::create: Cria a tabela chamada 'users' no banco de dados
        Schema::create('users', function (Blueprint $table) {

            // id(): Cria a chave primária (BIGINT) com auto-incremento automático
            $table->id()->autoIncrement();

            // string('email', 50): Cria campo VARCHAR de tamanho 50 e garante que não haverá e-mails repetidos (unique)
            $table->string('email', 50)->unique();

            // string('password'): VARCHAR de tamanho 255 para guardar a senha criptografada. Aceita nulo caso use login social
            $table->string('password', 255)->nullable();

            // dateTime: Guarda a data e hora do último login. O '0' remove frações de segundos. Pode ser nulo
            $table->dateTime('last_login', 0)->nullable();

            // timestamps(): Cria automaticamente duas colunas: 'created_at' (criação) e 'updated_at' (atualização)
            $table->timestamps();

            // softDeletes(): Cria a coluna 'deleted_at'. Permite que o usuário seja "excluído" sem sumir do banco (lixeira)
            $table->softDeletes();
        });
    }

    /**
     * Reversão da migration (Derrubar tabela).
     */
    public function down(): void
    {
        // dropIfExists: Exclui a tabela 'users' se ela existir (usado ao rodar php artisan migrate:rollback ou :refresh)
        Schema::dropIfExists('users');
    }
};
