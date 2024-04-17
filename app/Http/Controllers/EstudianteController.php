<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;


class EstudianteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-estudiante|crear-estudiante|editar-estudiante|borrar-estudiante')->only('index');
        $this->middleware('permission:crear-estudiante', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-estudiante', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-estudiante', ['only' => ['destroy']]);
    }

    public function index()
    {
        $estudiantes = Estudiante::paginate(20);
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numeroDeControl' => 'required|numeric|digits:8|unique:estudiantes',
            'nombre' => 'required',
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
            'semestre' => 'required|integer|min:1',
        ]);

        Estudiante::create($request->all());
        return redirect()->route('estudiantes.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.editar', compact('estudiante'));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'numeroDeControl' => 'required|numeric|digits:8|unique:estudiantes,numeroDeControl,' . $estudiante->id,
            'nombre' => 'required',
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
            'semestre' => 'required|integer|min:1',
        ]);

        $estudiante->update($request->all());
        return redirect()->route('estudiantes.index');
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();

        return redirect()->route('estudiantes.index');
    }
}
