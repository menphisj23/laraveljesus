<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Genero;

class PeliculaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'generos' => 'required|array',
        ]);

        $pelicula = Pelicula::create(['titulo' => $request->titulo]);

        foreach ($request->generos as $nombreGenero) {
            $genero = Genero::firstOrCreate(['nombre' => strtolower($nombreGenero)]);
            $pelicula->generos()->attach($genero);
        }

        return response()->json($pelicula->load('generos'), 201);
    }

    public function index()
    {
        return response()->json(Pelicula::with('generos')->get());
    }
}
