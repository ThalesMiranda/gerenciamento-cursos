<?php


namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::all();
        return response()->json($alunos, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:150',
            'cpf' => 'required|string|size:11|unique:alunos,cpf', 
            'email' => 'required|email|max:150|unique:alunos,email',
            'data_nascimento' => 'nullable|date',
        ]);

        $aluno = Aluno::create($validatedData);

        return response()->json($aluno, 201);
    }

public function show(string $id)
    {
        $aluno = Aluno::find($id);
        
        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado.'], 404);
        }
        
        return response()->json($aluno, 200);
    }

    public function update(Request $request, string $id)
    {
        $aluno = Aluno::find($id);

        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado para atualização.'], 404);
        }

        $validatedData = $request->validate([
            'nome' => 'required|string|max:150',
            'cpf' => 'required|string|size:11|unique:alunos,cpf,' . $aluno->id, 
            'email' => 'required|email|max:150|unique:alunos,email,' . $aluno->id,
            'data_nascimento' => 'nullable|date',
        ]);

        $aluno->update($validatedData);

        return response()->json($aluno, 200);
    }

    public function destroy(string $id)
    {
        $aluno = Aluno::find($id);

        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado para exclusão.'], 404);
        }
        
        $aluno->delete();
        return response()->json(null, 204);
    }
}