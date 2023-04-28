<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLctoGrupoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** Se a App não tiver implementado autorizações, deverá estar sempre em TRUE.
         *  Do contrário não irá deixar passar para as validações.
         */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // Regras de validações.
            'nome' => 'required|string|max:20',
            'notas' => 'nullable|string|max:70',
        ];
    }
}
