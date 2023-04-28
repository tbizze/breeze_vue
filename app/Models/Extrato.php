<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'tp_pgto',
        'valor_bruto',
        'valor_taxa',
        'valor_liquido',
        'dt_transacao',
        'dt_compensacao',
        'ref_transacao',
        'serial_leitor',
        'memo',
    ];

    protected $casts = [
        'dt_transacao' => 'datetime:Y-m-d H:i',
        'dt_compensacao' => 'datetime:Y-m-d H:i',
    ];
}
