<?php


namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MatriculaController extends Controller
{
    public function store(Request $request, Turma $turma)
    {
        $validatedData = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
        ]);

        $alunoId = $validatedData['aluno_id'];

        try {
            $turma->alunos()->attach($alunoId, ['data_matricula' => now()]);

            $turma->load('alunos');
            return response()->json([
                'message' => 'Aluno matriculado com sucesso.',
                'turma' => $turma
            ], 201);

        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return response()->json(['message' => 'Aluno já está matriculado nesta turma.'], 409);
            }
            return response()->json(['message' => 'Erro interno ao realizar matrícula.'], 500);
        }
    }

    public function destroy(Turma $turma, Aluno $aluno)
    {
        if (!$turma->alunos()->where('aluno_id', $aluno->id)->exists()) {
            return response()->json(['message' => 'Aluno não está matriculado nesta turma.'], 404);
        }

        $turma->alunos()->detach($aluno->id);

        return response()->json(null, 204);
    }
}
