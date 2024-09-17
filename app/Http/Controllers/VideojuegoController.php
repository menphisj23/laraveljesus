<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;
use App\Models\Genero;

class VideojuegoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'generos' => 'required|array',
        ]);

        $videojuego = Videojuego::create(['titulo' => $request->titulo]);

        foreach ($request->generos as $nombreGenero) {
            $genero = Genero::firstOrCreate(['nombre' => strtolower($nombreGenero)]);
            $videojuego->generos()->attach($genero);
        }

        return response()->json($videojuego->load('generos'), 201);
    }

    public function index()
    {
        return response()->json(Videojuego::with('generos')->get());
    }
}
