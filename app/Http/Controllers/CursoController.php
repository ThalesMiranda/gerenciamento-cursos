<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return response()->json($cursos, 200);
    }

    public function create()
    {
    }

    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'nome' => 'required|string|max:150|unique:cursos,nome',
                'descricao' => 'nullable|string',
                'carga_horaria' => 'required|integer|min:1',
            ]);

            $curso = Curso::create($validatedData);

            return response()->json($curso, 201);
        }

    public function show(Curso $curso)
    {
        return response()->json($curso, 200);
    }

    public function edit(Curso $curso)
    {
    }

    public function update(Request $request, Curso $curso)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:150|unique:cursos,nome,' . $curso->id, 
            'descricao' => 'nullable|string',
            'carga_horaria' => 'required|integer|min:1',
        ]);

        $curso->update($validatedData);

        return response()->json($curso, 200);
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return response()->json(null, 204);
    }
}
