<?php
namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\RangoAlumno;
use App\Models\Horario;
use App\Models\Materia;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Http\Request;

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
        $grupos = Grupo::with('rangoAlumno', 'horario', 'materia')->get();
        $rangoAlumnos = RangoAlumno::all();
        $horarios = Horario::all();
        $materias = Materia::all();

        return view('grupos.index', compact('grupos', 'rangoAlumnos', 'horarios', 'materias'));
    }

    public function create()
    {
        return view('grupos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'clave' => 'required|string|max:50|unique:grupos',
            // Add any other validation rules for the Grupo model
        ]);

        $grupo = Grupo::create($validatedData);

        return redirect()->route('grupos.index')->with('success', 'Grupo created successfully.');
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        return view('grupos.edit', compact('grupo'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'clave' => 'required|string|max:50|unique:grupos,clave,' . $id,
            // Add any other validation rules for the Grupo model
        ]);

        $grupo = Grupo::findOrFail($id);
        $grupo->update($validatedData);

        return redirect()->route('grupos.index')->with('success', 'Grupo updated successfully.');
    }

    public function destroy($id)
    {
        $grupo = Grupo::findOrFail($id);
        $grupo->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo deleted successfully.');
    }

    public function generarPDF($clave)
    {
        $grupo = Grupo::findOrFail($clave);
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