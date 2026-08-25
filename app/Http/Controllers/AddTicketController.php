<?php

namespace App\Http\Controllers;

use App\Ai\Agents\AddTicketImage;
use App\Models\Expense;
use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Laravel\Ai\Files;

class AddTicketController extends Controller
{
    public function store(Request $request, Presupuesto $presupuesto)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);
        set_time_limit(120);

        $response = (new AddTicketImage)->prompt(
            'Analiza la imagen del ticket y extrae la información de los productos.',
            attachments: [Files\Image::fromUpload($request->file('image'))],
            provider: 'gemini',
            model: 'gemini-3-flash-preview',
            timeout: 120
        );
        if (empty($response['items'])) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo leer el ticket, intente nuevamente'
            ]);
        }
        return response()->json(
            $this->createExpenses($presupuesto, $response['store'], $response['category'], $response['items'])
        );
    }

    private function createExpenses(Presupuesto $presupuesto, string $store, string $category, array $items): array
    {
        $created = [];

        foreach ($items as $item) {
            $expense = Expense::create([
                'presupuesto_id' => $presupuesto->id,
                'name' => $store . ' - ' . $item['name'],
                'amount' => $item['amount'],
                'category' => $presupuesto->isGeneral() ? $category : null,
            ]);

            $cat = $expense->category ? $expense->category->label() : 'Sin categoría';
            $created[] = "- {$expense->name}: \${$expense->amount} ({$cat})";
        }

        $total = array_sum(array_column($items, 'amount'));

        return [
            'success' => true,
            'message' => "Se registraron " . count($created) . " gastos del ticket:\n" .
                implode("\n", $created) .
                "\nTotal: \${$total}",
        ];
    }
}
