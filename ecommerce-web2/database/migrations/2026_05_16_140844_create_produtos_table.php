<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            // Chave estrangeira ligando o produto a uma categoria
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2); // 10 dígitos no total, 2 decimais
            $table->integer('estoque')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};