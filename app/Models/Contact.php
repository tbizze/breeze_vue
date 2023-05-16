<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'celular', 'notas', 'dt_nasc',
    ];

    /**
     * O Contato 'pertence a um' Usuário. 
     * Obtenha esse registro.
     */
    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
