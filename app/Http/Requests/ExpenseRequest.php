<?php

namespace App\Http\Requests;

use App\ExpenseCategoria;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Override;

class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        $presupuesto = $this->route('presupuesto');
        return $presupuesto && $this->user()->can('update', $presupuesto);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del gasto es obligatorio.',
            'name.string' => 'El nombre del gasto debe ser una cadena de texto.',
            'name.decimal' => 'El nombre del gasto no puede tener decimales.',
            'amount.required' => 'El monto del gasto es obligatorio.',
            'amount.min' => 'El monto del gasto debe ser mayor a 0.',
            'category.required' => 'La categoría del gasto es obligatoria.',
            'category.enum' => 'La categoría del gasto debe ser una categoría válida.',
        ];
    }

    public function rules(): array
    {
        $presupuesto = $this->route('presupuesto');

        return [
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric'],
            // 'presupuesto_id' => ['required', 'exists:presupuestos,id'],
            'category' => Rule::when(
                $presupuesto->isGeneral(),
                ['required', new Enum(ExpenseCategoria::class)],
                ['exclude']
            ),

        ];
    }
}
