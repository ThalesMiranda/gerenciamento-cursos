<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->date('data_inicio');
            $table->date('data_fim');
            
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            
            $table->foreignId('professor_id')->nullable()->constrained('professors')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};