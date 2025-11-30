<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Route;

// Rotas de Turma (SEM conflito)
Route::get('turmas', [TurmaController::class, 'index']);
Route::post('turmas', [TurmaController::class, 'store']);

Route::get('turmas/{id}', [TurmaController::class, 'show'])->whereNumber('id'); 
Route::put('turmas/{id}', [TurmaController::class, 'update'])->whereNumber('id');
Route::patch('turmas/{id}', [TurmaController::class, 'update'])->whereNumber('id');
Route::delete('turmas/{id}', [TurmaController::class, 'destroy'])->whereNumber('id');

// ROTAS ANINHADAS DEPOIS
Route::post('turmas/{turma}/alunos', [MatriculaController::class, 'store']);
Route::delete('turmas/{turma}/alunos/{aluno}', [MatriculaController::class, 'destroy']);

Route::resource('cursos', CursoController::class);
Route::resource('professores', ProfessorController::class);
Route::resource('alunos', AlunoController::class);