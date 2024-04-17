<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\RangoAlumno;
use App\Models\Horario;
use App\Models\Materia;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GrupoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-grupos|ver_excel_grupo')->only('index');
        $this->middleware('permission:ver_excel_grupo', ['only' => ['generarPDF']]);
        $this->middleware('permission:crear-grupos')->only('create', 'store');
        $this->middleware('permission:editar-grupos')->only('edit', 'update');
        $this->middleware('permission:eliminar-grupos')->only('destroy');
    }

    public function index()
    {
        $grupos = Grupo::with('rangoAlumno', 'horario', 'materia', 'inscripciones')->get();
        $rangoAlumnos = RangoAlumno::all();
        $horarios = Horario::all();
        $materias = Materia::all();
    
        // Add the count of inscriptions for each group
        $grupos->each(function ($grupo) {
            $grupo->inscripcionesCount = $grupo->inscripciones()->count();
        });
    
        return view('grupos.index', compact('grupos', 'rangoAlumnos', 'horarios', 'materias'));
    }

    public function create()
{
    $rangoAlumnos = RangoAlumno::all();
    $horarios = Horario::all();
    $materias = Materia::all();

    return view('grupos.crear', compact('rangoAlumnos', 'horarios', 'materias'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'clave' => 'required|string|max:50|unique:grupos',
        'nombre' => 'required|string|max:255',
        'materia_id' => 'required|integer|exists:materias,id',
        'rango_alumnos_id' => 'required|integer|exists:rango_alumnos,id',
        'horario_id' => 'required|integer|exists:horarios,id',
    ]);

    $grupo = Grupo::create($validatedData);

    return redirect()->route('grupos.index')->with('success', 'Grupo created successfully.');
}
public function edit($clave)
{
    $grupo = Grupo::where('clave', $clave)->firstOrFail();
    $rangoAlumnos = RangoAlumno::all();
    $horarios = Horario::all();
    $materias = Materia::all();

    return view('grupos.editar', compact('grupo', 'rangoAlumnos', 'horarios', 'materias'));
}

public function update(Request $request, $clave)
{
    $grupo = Grupo::where('clave', $clave)->firstOrFail();

    $validatedData = $request->validate([
        'clave' => 'required|string|max:50|unique:grupos,clave,' . $grupo->id,
        'nombre' => 'required|string|max:255',
        'materia_id' => 'required|integer|exists:materias,id',
        'rango_alumnos_id' => 'required|integer|exists:rango_alumnos,id',
        'horario_id' => 'required|integer|exists:horarios,id',
    ]);

    $grupo->update($validatedData);

    return redirect()->route('grupos.index')->with('success', 'Grupo updated successfully.');
}
    public function destroy($id)
    {
        try {
            $grupo = Grupo::findOrFail($id);
            $grupo->delete();
            return redirect()->route('grupos.index')->with('success', 'Grupo deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting grupo: ' . $e->getMessage());
            return redirect()->route('grupos.index')->with('error', 'An error occurred while deleting the group.');
        }
    }
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_clave', 'clave');
    }

    public function generarPDF($id)
    {
        $grupo = Grupo::findOrFail($id);
        $estudiantes = $grupo->inscripciones()
            ->with('estudiante')
            ->get()
            ->pluck('estudiante')
            ->sortBy('apellidoPaterno');

        $writer = WriterEntityFactory::createXLSXWriter();
        $fileName = 'lista_estudiantes_' . $grupo->clave . '.xlsx';
        $writer->openToFile($fileName);

        $header = WriterEntityFactory::createRowFromArray([
            'Número de Control', 'Apellido Paterno', 'Apellido Materno', 'Nombre', 'Semestre'
        ]);
        $writer->addRow($header);

        foreach ($estudiantes as $estudiante) {
            $row = WriterEntityFactory::createRowFromArray([
                $estudiante->numeroDeControl, $estudiante->apellidoPaterno, $estudiante->apellidoMaterno, $estudiante->nombre, $estudiante->semestre,
            ]);
            $writer->addRow($row);
        }

        $writer->close();
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}