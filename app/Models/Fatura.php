<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

class Fatura extends Model implements Auditable
{
    use HasFactory;
    // Invoca  driver de auditoria.
    use \OwenIt\Auditing\Auditable;

    /**
     * Habilita o recurso de Apagar para Lixeira.
      */
    use SoftDeletes;

    /**
     * Lista des campos em que é permitido a persistência no BD.. 
     */
    protected $fillable = [
        'dt_venc', 'dt_pgto', 'valor_pgto', 'notas', 'fat_operadora_id'
    ];

    /**
     * Configura o formato da data p/ as colunas 'dt_pgto' e dt_venc. 
    */
    protected $casts = [
        'dt_venc' => 'date:d/m/Y',
        //'dt_venc' => 'date:Y-m-d',
        'dt_pgto' => 'date:d/m/Y',
    ];

    /**
     * A Fatura 'tem muitos' (hasMany) Itens de Fatura.
     * Obtenha essa coleção de registros.
     */
    public function hasFaturaItens(): HasMany
    {
        return $this->hasMany(FaturaItem::class);
    }

    /**
     * A Fatura 'pertence a uma' Operadora. 
     * Obtenha esse registro.
     */
    public function toFatOperadora(): BelongsTo
    {
        return $this->belongsTo(FatOperadora::class,'fat_operadora_id');
    }
}
