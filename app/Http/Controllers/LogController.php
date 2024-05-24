<?php

namespace App\Http\Controllers;
use Carbon\Carbon;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-log')->only('index');
    }

    public function index()
    {
        $logs = DB::table('logs')
            ->select('id', 'created_at', 'action', 'table', 'record_id', 'executedSQL', 'reverseSQL', 'user_name')
            ->orderBy('created_at', 'desc')
            ->paginate(30); // Ajusta el número de registros por página como prefieras
    
        // Formatear las fechas en letras y en español
        foreach ($logs as $log) {
            $log->formatted_date = Carbon::parse($log->created_at)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
        }
    
        return view('logs.index', compact('logs'));
    }
    
    
}