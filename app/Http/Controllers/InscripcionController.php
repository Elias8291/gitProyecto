<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inscripcion;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Periodo;

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
                DB::raw("CONCAT(estudiantes.nombre, ' ', estudiantes.apellidoPaterno, ' ', COALESCE(estudiantes.apellidoMaterno, '')) AS nombre_estudiante"),
                'grupos.clave AS clave_grupo',
                'materias.nombre AS nombre_materia',
                'grupos.activo AS grupo_activo'
            )
            ->paginate(30);
    
        $periodos = Periodo::all();
    
        return view('inscripciones.index', compact('inscripciones', 'periodos'));
    }
    

    public function create(Request $request)
    {
        $estudiantes = Estudiante::all();
        $grupo = Grupo::with('materia', 'horario', 'rangoAlumno')->find($request->query('grupo_id'));

        if (!$grupo) {
            return redirect()->back()->withErrors(['Grupo no encontrado.']);
        }

        return view('inscripciones.crear', compact('estudiantes', 'grupo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        $grupo = Grupo::with('rangoAlumno', 'horario')->findOrFail($request->grupo_id);
        $estudiante = Estudiante::findOrFail($request->estudiante_id);

        // Verificar si el estudiante ya está inscrito en un grupo con horario traslapado
        $inscripcionesExistentes = $estudiante->inscripciones()->with('grupo.horario')->get();
        foreach ($inscripcionesExistentes as $inscripcionExistente) {
            if ($inscripcionExistente->grupo->horario->id == $grupo->horario->id) {
                return redirect()->back()->withErrors(['El estudiante ya está inscrito en otro grupo con el mismo horario.']);
            }
        }

        // Verificar el número máximo de inscripciones permitidas en el grupo
        if ($grupo->rangoAlumno) {
            $maxAlumnos = $grupo->rangoAlumno->max_alumnos;
            if ($grupo->inscripciones()->count() >= $maxAlumnos) {
                return redirect()->back()->withErrors(['No se pueden agregar más inscripciones, se ha alcanzado el máximo permitido.']);
            }
        } else {
            return redirect()->back()->withErrors(['El grupo no tiene un rango de alumnos definido.']);
        }

        Inscripcion::create([
            'estudiante_id' => $request->estudiante_id,
            'grupo_id' => $request->grupo_id,
        ]);

        // Actualizar el estado del grupo si ha alcanzado el máximo de inscripciones
        $this->actualizarEstadoGrupo($grupo);

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

    private function actualizarEstadoGrupo($grupo)
    {
        $inscripcionesCount = $grupo->inscripciones()->count();
        if ($grupo->rangoAlumno && $inscripcionesCount >= $grupo->rangoAlumno->max_alumnos) {
            $grupo->activo = 0; // Inactivo
        } else {
            $grupo->activo = 1; // Activo
        }
        $grupo->save();
    }

    public function getGruposByPeriodo($periodoId)
    {
        $grupos = Grupo::where('periodo_id', $periodoId)
            ->with(['materia', 'horario', 'rangoAlumno'])
            ->get();

        return response()->json(['grupos' => $grupos]);
    }

    public function getGruposEstudiante($estudiante_id)
    {
        $grupos = DB::table('inscripciones')
            ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
            ->join('materias', 'grupos.materia_id', '=', 'materias.id')
            ->join('horarios', 'grupos.horario_id', '=', 'horarios.id')
            ->select('grupos.clave', 'grupos.nombre as grupo_nombre', 'materias.nombre as materia_nombre', 'horarios.hora_in', 'horarios.hora_fn')
            ->where('inscripciones.estudiante_id', $estudiante_id)
            ->get();

        return response()->json($grupos);
    }

  


public function getAlumnosByGrupo($grupoId)
{
    $grupo = Grupo::find($grupoId);

    $alumnos = DB::table('inscripciones')
        ->join('estudiantes', 'inscripciones.estudiante_id', '=', 'estudiantes.id')
        ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
        ->join('materias', 'grupos.materia_id', '=', 'materias.id')
        ->select(
            'inscripciones.id',
            'estudiantes.numeroDeControl',
            DB::raw("CONCAT(estudiantes.nombre, ' ', estudiantes.apellidoPaterno, ' ', COALESCE(estudiantes.apellidoMaterno, '')) AS nombre_estudiante"),
            'grupos.clave AS clave_grupo',
            'materias.nombre AS nombre_materia',
            'grupos.activo AS grupo_activo'
        )
        ->where('inscripciones.grupo_id', $grupoId)
        ->paginate(10);
    
    return view('inscripciones.alumnos', compact('alumnos', 'grupo'));
}

}
