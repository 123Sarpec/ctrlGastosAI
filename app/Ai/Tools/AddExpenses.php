<?php

namespace App\Ai\Tools;

use App\Models\Expense;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class AddExpenses implements Tool
{


    public function __construct(
        public int $presupuestoID,
        public bool $hasCategories = true
    ) {}

    public function description(): Stringable|string
    {
        if ($this->hasCategories) {
            return 'Registra un nuevo gasto en el presupuesto actual, puedes usar la categoría si lo deseas, la categoría debe ser una de las siguientes: food, transportation, health, entertainment, subscriptions, beauty, clothing, home, education, pets, other';
        }

        return 'Registra un nuevo gasto en el presupuesto actual, requiere nombre y monto. la categoria no aplica para esta parte.';
    }

    public function handle(Request $request): Stringable|string
    {


        $name = $request['name'] ?? null;
        $amount = $request['amount'] ?? null;

        if (!$name || $amount === null) {
            return '[EXPENSE_ERROR] Se necesita un nombre y un monto para agregar el gasto.';
        }

        $data = [
            'presupuesto_id' => $this->presupuestoID,
            'name' => $name,
            'amount' => $amount,
        ];

        if ($this->hasCategories && ($request['category'] ?? null)) {
            $data['category'] = $request['category'];
        }

        $expense = Expense::create($data);

        $cat = $expense->category
            ? $expense->category->label()
            : 'Sin categoría';

        return "[EXPENSE_CREATED] Gasto agregado exitosamente: {$expense->name} por Q {$expense->amount} ({$cat})";
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'name' => $schema->string()
                ->description('Nombre del gasto (ej: Cemento, Uber, Renta)')
                ->required(),

            'amount' => $schema->number()
                ->description('Monto del gasto en número (ej: 30, 100.50)')
                ->required(),

            'category' => $schema->string()
                ->description('Categoría del gasto. Opcional. Valores permitidos: food, transportation, health, entertainment, subscriptions, beauty, clothing, home, education, pets, other')
        ];
    }
}
