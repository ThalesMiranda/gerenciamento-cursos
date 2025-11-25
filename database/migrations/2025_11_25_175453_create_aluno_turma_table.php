<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aluno_turma', function (Blueprint $table) {
            
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
            
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');
            
            $table->primary(['aluno_id', 'turma_id']);
            
            $table->date('data_matricula')->default(now());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aluno_turma');
    }
};