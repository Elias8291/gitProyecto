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
    $inscripciones = Inscripcion::with(['estudiante', 'grupo'])->paginate(10);
    $estudiantes = Estudiante::all();
    $grupos = Grupo::all();
    return view('inscripciones.index', compact('inscripciones', 'estudiantes', 'grupos'));
}

    // Muestra el formulario para crear una nueva inscripción
    public function create()
    {
        // Aquí también puedes pasar datos adicionales a la vista si es necesario, como la lista de estudiantes y grupos
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('inscripciones.crear', compact('estudiantes', 'grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_clave' => 'required|exists:grupos,clave',
        ]);
    
        $grupo = Grupo::findOrFail($request->grupo_clave);
        $estudiante = Estudiante::findOrFail($request->estudiante_id);
    
        // Verificar si el estudiante ya está inscrito en un grupo con horario traslapado
        $inscripcionesExistentes = $estudiante->inscripciones()->with('grupo.horario')->get();
    
        foreach ($inscripcionesExistentes as $inscripcionExistente) {
            if ($inscripcionExistente->grupo->horario->id == $grupo->horario->id) {
                return redirect()->back()->withErrors(['El estudiante ya está inscrito en otro grupo con el mismo horario.']);
            }
        }
    
        // Crear la nueva inscripción
        Inscripcion::create([
            'estudiante_id' => $request->estudiante_id,
            'grupo_clave' => $request->grupo_clave,
        ]);
    
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción creada correctamente.');
    }



    // Muestra una inscripción específica
    public function show($id)
    {
        $inscripcion = Inscripcion::with(['estudiante', 'grupo'])->findOrFail($id);
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
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_clave' => 'required|exists:grupos,clave',
        ]);

        Inscripcion::create($request->all());

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción creada correctamente.');
    }

    // Elimina una inscripción
    public function destroy($id)
    {
        Inscripcion::findOrFail($id)->delete();
        return back()->with('success', 'Inscripción eliminada correctamente.');
    }
}
