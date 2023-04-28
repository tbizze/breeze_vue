<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model
{
    use HasFactory;

    /**
     * Habilita o recurso de Apagar para Lixeira.
      */
    use SoftDeletes;

    /**
     * Lista des campos em que é permitido a persistência no BD.. 
     */
    protected $fillable = [
        'lcto_data', 'lcto_historico', 'lcto_tipo', 'lcto_valor', 'lcto_notas', 'lcto_grupo_id'
    ];

    /**
     * Configura o formato da data p/ as colunas 'lcto_data'.
    */
    protected $casts = [
        'lcto_data' => 'date:d/m/Y',
    ];

    /**
     * O Lançamento 'pertence a um' Grupo. 
     * Obtenha esse registro.
     */
    public function toLctoGrupo(): BelongsTo
    {
        return $this->belongsTo(LctoGrupo::class,'lcto_grupo_id');
    }
}
