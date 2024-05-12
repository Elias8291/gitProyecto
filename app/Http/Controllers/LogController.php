<?php

namespace App\Http\Controllers;

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
            ->select('id', 'created_at', 'action','table','record_id', 'executedSQL', 'reverseSQL','user_name')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('logss.index', compact('logs'));
    }
}