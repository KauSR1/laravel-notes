<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Criação da tabela de notas.
     */
    public function up(): void
    {
        // Schema::create: Cria a tabela chamada 'notes' no banco de dados
        Schema::create('notes', function (Blueprint $table) {

            // id(): Chave primária (BIGINT) com incremento automático para cada nota
            $table->id()->autoIncrement();

            // integer('user_id'): Guarda o ID do usuário dono desta nota (Chave Estrangeira)
            $table->integer('user_id');

            // string('title', 200): Título da nota como VARCHAR limitado a 200 caracteres
            $table->string('title', 200);

            // text('description'): Campo do tipo TEXT para suportar textos longos na descrição da nota
            $table->text('description');

            // timestamps(): Cria as colunas 'created_at' e 'updated_at' para controle de datas da nota
            $table->timestamps();

            // softDeletes(): Cria a coluna 'deleted_at', permitindo recuperar notas excluídas acidentalmente
            $table->softDeletes();
        });
    }

    /**
     * Reversão da migration (Derrubar tabela).
     */
    public function down(): void
    {
        // dropIfExists: Exclui a tabela 'notes' se ela existir ao reverter as migrations
        Schema::dropIfExists('notes');
    }
};
