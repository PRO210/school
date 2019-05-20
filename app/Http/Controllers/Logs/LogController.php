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
//
       
    }
    public function showalunos() {
        $title = "Ações Passadas";
        $logs = $this->log->all();
        return view('Logs.listar_logs', compact('title', 'logs'));
    }

}
