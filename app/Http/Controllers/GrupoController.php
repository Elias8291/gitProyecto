<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;



class GrupoController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:ver-grupos|ver_excel_grupo')->only('index');
        $this->middleware('permission:ver_excel_grupo', ['only' => ['generarPDF']]);
   
    }
    
    public function index()
    {
        $grupos = Grupo::all();
        return view('grupos.index', compact('grupos'));
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
        'Número de Control', 'Apellido Paterno', 'Apellido Materno', 'Nombre','Semestre'
    ]);
    $writer->addRow($header);

    foreach ($estudiantes as $estudiante) {
        $row = WriterEntityFactory::createRowFromArray([
            $estudiante->numeroDeControl,
            $estudiante->apellidoPaterno,
            $estudiante->apellidoMaterno,
            $estudiante->nombre,
            $estudiante->semestre,
        ]);
        $writer->addRow($row);
    }

    $writer->close();

    return response()->download($fileName)->deleteFileAfterSend(true);
}
}
