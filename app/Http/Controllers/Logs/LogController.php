<?php

namespace App\Http\Controllers\Logs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logs\Log;

class LogController extends Controller {

    private $log;

    public function __construct(Log $log) {

        $this->log = $log;
    }

    public function index() {
        $title = "Ações Passadas";
        $logs = Log::where('id', '>=', '1')->orderBy('created_at', 'DESC')->get();
        return view('Logs.listar_logs', compact('title', 'logs'));
    }

   

}
