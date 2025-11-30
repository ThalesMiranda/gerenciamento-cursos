<?php


namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::with(['curso', 'professor'])->get();
        return response()->json($turmas, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:50|unique:turmas,codigo',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'curso_id' => 'required|exists:cursos,id',
            'professor_id' => 'nullable|exists:professors,id', 
        ]);

        $turma = Turma::create($validatedData);

        return response()->json($turma, 201);
    }

    public function show(string $id)
    {
        $turma = Turma::with(['alunos', 'curso', 'professor'])->find($id);

        if (!$turma) {
            return response()->json(['message' => 'Turma não encontrada.'], 404);
        }
        
        return response()->json($turma, 200);
    }

    public function update(Request $request, string $id)
        {
            $turma = Turma::find($id);

            if (!$turma) {
                return response()->json(['message' => 'Turma não encontrada para atualização.'], 404);
            }

            $validatedData = $request->validate([
                'codigo' => 'required|string|max:50|unique:turmas,codigo,' . $turma->id,
                'data_inicio' => 'required|date',
                'data_fim' => 'required|date|after_or_equal:data_inicio',
                'curso_id' => 'required|exists:cursos,id',
                'professor_id' => 'nullable|exists:professors,id',
            ]);

            $turma->update($validatedData);

            return response()->json($turma, 200);
        }

        public function destroy(string $id)
        {
            $turma = Turma::find($id);

            if (!$turma) {
                return response()->json(['message' => 'Turma não encontrada para exclusão.'], 404);
            }
            
            $turma->delete();
            return response()->json(null, 204);
        }
}