<?php

namespace App\Ai\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;
use App\Models\Expense;

class SearchExpenses implements Tool
{

    public function __construct(
        public int $presupuestoID,
    ) {}
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Busca gasto del presupuesto actual, puedes buscar o filtrar por nombre, categoría, fecha, monto, gastos mas barato o costosos, traer y mostrar todos los gastos.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {

        $query = Expense::where('presupuesto_id', $this->presupuestoID);

        if ($request['name'] ?? null) {
            $query->where('name', 'ilike', '%' . $request['name'] . '%');
        }

        if ($request['category'] ?? null) {
            $query->where('category', 'ilike', '%' . $request['category'] . '%');
        }

        $expenses = $query->get(['name', 'amount', 'category', 'created_at']);

        if ($expenses->isEmpty()) {
            return 'No se encontraron gastos con esos criterios.';
        }

        $total = $expenses->sum('amount');

        return "Gastos encontrados ({$expenses->count()}):\n" .
            $expenses->map(function ($e) {

                $cat = $e->category
                    ? $e->category->label()
                    : 'Sin categoría';

                return "- {$e->name}: Q {$e->amount} ({$cat})";
            })->implode("\n") .
            "\n\nTotal: Q {$total}";
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'name' => $schema->string()->description('Texto para buscar dentro de los gastos(ejemplo:Uber, Pizza, Netflix, renta, etc)'),
            'category' => $schema->string()->description('Categoría del gasto (ejemplo:food, transportation, health, entertainment, subscriptions, beauty, clothing, home, education, pets, other)'),
        ];
    }
}
