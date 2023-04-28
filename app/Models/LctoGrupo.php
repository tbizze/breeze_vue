<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LctoGrupo extends Model
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
        'nome', 'notas'
    ];

    /**
     * O Grupo 'tem muitos' (hasMany) Lançamentos.
     * Obtenha essa coleção de registros.
     */
    public function hasLancamentos(): HasMany
    {
        return $this->hasMany(lancamento::class);
    }
}
