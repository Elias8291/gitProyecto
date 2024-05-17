<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\RangoAlumno;
use App\Models\Horario;
use App\Models\Materia;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\Style\BorderBuilder;
use Box\Spout\Common\Entity\Style\Border;
use Box\Spout\Common\Entity\Style\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-grupos|ver_excel_grupo|crear-grupos|editar-grupos|eliminar-grupos')->only('index');
        $this->middleware('permission:ver_excel_grupo', ['only' => ['generarPDF']]);
        $this->middleware('permission:crear-grupos')->only('create', 'store');
        $this->middleware('permission:editar-grupos')->only('edit', 'update');
        $this->middleware('permission:eliminar-grupos')->only('destroy');
    }

    public function index()
    {
        $grupos = DB::table('grupos')
            ->join('rango_alumnos', 'grupos.rango_alumnos_id', '=', 'rango_alumnos.id')
            ->join('horarios', 'grupos.horario_id', '=', 'horarios.id')
            ->join('materias', 'grupos.materia_id', '=', 'materias.id')
            ->select(
                'grupos.id',
                'grupos.clave',
                'grupos.nombre',
                'materias.nombre as materia_nombre',
                'rango_alumnos.min_alumnos',
                'rango_alumnos.max_alumnos',
                'horarios.hora_in',
                'horarios.hora_fn',
                'grupos.activo', // Asegúrate de seleccionar la propiedad 'activo'
                DB::raw('COUNT(inscripciones.id) AS inscripcionesCount')
            )
            ->leftJoin('inscripciones', 'grupos.id', '=', 'inscripciones.grupo_id')
            ->groupBy(
                'grupos.id',
                'grupos.clave',
                'grupos.nombre',
                'materias.nombre',
                'rango_alumnos.min_alumnos',
                'rango_alumnos.max_alumnos',
                'horarios.hora_in',
                'horarios.hora_fn',
                'grupos.activo' // Asegúrate de agrupar por 'activo'
            )
            ->get();

        $rangoAlumnos = RangoAlumno::all();
        $horarios = Horario::all();
        $materias = Materia::all();

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
            'activo' => 'required|boolean'
        ]);

        $grupo = Grupo::create($validatedData);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado con éxito.');
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        $rangoAlumnos = RangoAlumno::all();
        $horarios = Horario::all();
        $materias = Materia::all();

        return view('grupos.editar', compact('grupo', 'rangoAlumnos', 'horarios', 'materias'));
    }

    public function update(Request $request, $id)
    {
        $grupo = Grupo::findOrFail($id);

        $validatedData = $request->validate([
            'clave' => 'required|string|max:50|unique:grupos,clave,' . $grupo->id,
            'nombre' => 'required|string|max:255',
            'materia_id' => 'required|integer|exists:materias,id',
            'rango_alumnos_id' => 'required|integer|exists:rango_alumnos,id',
            'horario_id' => 'required|integer|exists:horarios,id',
            'activo' => 'required|boolean'
        ]);

        $grupo->clave = $validatedData['clave'];
        $grupo->nombre = $validatedData['nombre'];
        $grupo->materia_id = $validatedData['materia_id'];
        $grupo->rango_alumnos_id = $validatedData['rango_alumnos_id'];
        $grupo->horario_id = $validatedData['horario_id'];
        $grupo->activo = $validatedData['activo']; // Asignar el valor de 'activo' directamente

        $grupo->save();

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
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

        // Estilo para el encabezado
        $headerStyle = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(12)
            ->setFontColor('FFFFFF')
            ->setBackgroundColor('4F81BD')
            ->setBorder((new BorderBuilder())->setBorderBottom(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                ->setBorderLeft(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                ->setBorderRight(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                ->setBorderTop(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                ->build())
            ->build();

        // Estilo para las filas de datos
        $dataStyle = (new StyleBuilder())
            ->setFontSize(10)
            ->setBorder((new BorderBuilder())->setBorderBottom(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                ->setBorderLeft(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                ->setBorderRight(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                ->setBorderTop(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                ->build())
            ->build();

        $header = WriterEntityFactory::createRowFromArray(
            ['Número de Control', 'Apellido Paterno', 'Apellido Materno', 'Nombre', 'Semestre'],
            $headerStyle
        );
        $writer->addRow($header);
        foreach ($estudiantes as $estudiante) {
            $row = WriterEntityFactory::createRowFromArray([
                $estudiante->numeroDeControl,
                $estudiante->apellidoPaterno,
                $estudiante->apellidoMaterno,
                $estudiante->nombre,
                $estudiante->semestre,
            ], $dataStyle);
            $writer->addRow($row);
        }

        $writer->close();
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
