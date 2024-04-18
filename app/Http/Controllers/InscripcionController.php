<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inscripcion;
use App\Models\Estudiante;
use App\Models\Grupo;

class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-inscripcion|crear-inscripcion|editar-inscripcion|borrar-inscripcion')->only('index');
        $this->middleware('permission:crear-inscripcion', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-inscripcion', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-inscripcion', ['only' => ['destroy']]);
    }

     public function index()
    {
        $inscripciones = DB::table('inscripciones')
            ->join('estudiantes', 'inscripciones.estudiante_id', '=', 'estudiantes.id')
            ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
            ->join('materias', 'grupos.materia_id', '=', 'materias.id')
            ->select(
                'inscripciones.id',
                'estudiantes.numeroDeControl',
                DB::raw("CONCAT(estudiantes.nombre, ' ', estudiantes.apellidoPaterno, ' ', estudiantes.apellidoMaterno) AS nombre_estudiante"),
                'grupos.clave AS clave_grupo',
                'materias.nombre AS nombre_materia'
            )
            ->paginate(30);

        return view('inscripciones.index', compact('inscripciones'));
    }
    public function create()
    {
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('inscripciones.crear', compact('estudiantes', 'grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        $grupo = Grupo::findOrFail($request->grupo_id);
        $estudiante = Estudiante::findOrFail($request->estudiante_id);

        // Verificar si el estudiante ya está inscrito en un grupo con horario traslapado
        $inscripcionesExistentes = $estudiante->inscripciones()->with('grupo.horario')->get();
        foreach ($inscripcionesExistentes as $inscripcionExistente) {
            if ($inscripcionExistente->grupo->horario->id == $grupo->horario->id) {
                return redirect()->back()->withErrors(['El estudiante ya está inscrito en otro grupo con el mismo horario.']);
            }
        }

        Inscripcion::create([
            'estudiante_id' => $request->estudiante_id,
            'grupo_id' => $request->grupo_id,
        ]);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción creada correctamente.');
    }

    public function show($id)
    {
        $inscripcion = Inscripcion::with(['estudiante', 'grupo'])->findOrFail($id);
        return view('inscripciones.show', compact('inscripcion'));
    }

    public function edit($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('inscripciones.editar', compact('inscripcion', 'estudiantes', 'grupos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_id' => 'required|exists:grupos,id',
        ]);
    
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->update([
            'estudiante_id' => $request->estudiante_id,
            'grupo_id' => $request->grupo_id,
        ]);
    
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada correctamente.');
    }
    public function destroy($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();
        return back()->with('success', 'Inscripción eliminada correctamente.');
    }
}