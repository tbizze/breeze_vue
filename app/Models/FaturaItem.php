<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaturaItem extends Model
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
          'dt_compra', 'historico', 'parcelas', 'valor_compra', 'notas', 'fatura_id', 'fat_grupo_id',
      ];

      /**
     * Configura o formato da data p/ as colunas 'lcto_data'.
    */
    protected $casts = [
        'dt_compra' => 'date:d/m/Y',
    ];

    /**
     * O Lançamento 'pertence a um' Grupo. 
     * Obtenha esse registro.
     */
    public function toFatGrupo(): BelongsTo
    {
        return $this->belongsTo(FatGrupo::class,'fatura_id');
    }

    /**
     * O Lançamento 'pertence a um' Grupo. 
     * Obtenha esse registro.
     */
    public function toFatura(): BelongsTo
    {
        return $this->belongsTo(Fatura::class,'fat_grupo_id');
    }
}
