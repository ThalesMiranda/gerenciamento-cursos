<?php


namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
        $professores = Professor::all();
        return response()->json($professores, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:professors,email',
            'area_especializacao' => 'required|string|max:100',
        ]);

        $professor = Professor::create($validatedData);

        return response()->json($professor, 201);
    }

    public function show(string $id) 
    {
        $professor = Professor::find($id); 

        if (!$professor) {
            return response()->json(['message' => 'Professor não encontrado.'], 404);
        }
        
        return response()->json($professor, 200); 
    }

    public function update(Request $request, string $id) 
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor não encontrado.'], 404);
        }
        
        $validatedData = $request->validate([
            'nome' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:professors,email,' . $professor->id, 
            'area_especializacao' => 'required|string|max:100',
        ]);

        $professor->update($validatedData);

        return response()->json($professor, 200);
    }

    public function destroy(string $id) 
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor não encontrado para exclusão.'], 404);
        }
        
        $professor->delete();

        return response()->json(null, 204);
    }
}