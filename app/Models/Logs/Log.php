<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
     protected $fillable = ['USUARIO', 'TABELA', 'DETALHES_ACAO', 'ACAO',
        
    ];
}
