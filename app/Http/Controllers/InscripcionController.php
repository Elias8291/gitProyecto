<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inscripcion;
use App\Models\Estudiante; // Asegúrate de incluir los modelos necesarios
use App\Models\Grupo;

class InscripcionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-inscripcion|crear-inscripcion|editar-inscripcion|borrar-inscripcion')->only('index');
        $this->middleware('permission:crear-inscripcion', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-inscripcion', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-inscripcion', ['only' => ['destroy']]);
    }

    public function index()
    {
        $inscripciones = Inscripcion::with(['alumno', 'grupo'])->paginate(10);
        return view('inscripciones.index', compact('inscripciones'));
    }

    // Muestra el formulario para crear una nueva inscripción
    public function create()
    {
        // Aquí también puedes pasar datos adicionales a la vista si es necesario, como la lista de estudiantes y grupos
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('inscripciones.crear', compact('estudiantes', 'grupos'));
    }

    // Almacena una nueva inscripción en la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'alumno_numeroDeControl' => 'required|exists:estudiantes,numeroDeControl',
            'grupo_clave' => 'required|exists:grupos,clave',
        ]);

        Inscripcion::create([
            'estudiantes_numeroDeControl' => $validatedData['alumno_numeroDeControl'],
            'grupo_clave' => $validatedData['grupo_clave'],
        ]);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción creada correctamente.');
    }




    // Muestra una inscripción específica
    public function show($id)
    {
        $inscripcion = Inscripcion::with(['alumno', 'grupo'])->findOrFail($id);
        return view('inscripciones.show', compact('inscripcion'));
    }

    // Muestra el formulario para editar una inscripción existente
    public function edit($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('inscripciones.editar', compact('inscripcion', 'estudiantes', 'grupos'));
    }

    // Actualiza una inscripción específica
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'alumno_numeroDeControl' => 'required|exists:estudiantes,numeroDeControl',
            'grupo_clave' => 'required|exists:grupos,clave',
        ]);

        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->update($validatedData);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada correctamente.');
    }

    // Elimina una inscripción
    public function destroy($id)
    {
        Inscripcion::findOrFail($id)->delete();
        return back()->with('success', 'Inscripción eliminada correctamente.');
    }
}
