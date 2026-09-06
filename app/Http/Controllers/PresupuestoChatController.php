<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Nette\Schema\Message;
use App\Ai\Agents\PresupuestoAsistente;

class PresupuestoChatController extends Controller
{
    //
    #[Middleware('auth')]
    #[Middleware('verified')]
    public function store(Request $request, Presupuesto $presupuesto)
    {

        // return Inertia::render("Presupuestos/Chat");
        // dd('deses');
        $message = $request->input('messages', []);
        $lastMessage = collect($message)->last();

        $prompt = collect(data_get($lastMessage, 'parts', []))
            ->where('type', 'text')
            ->pluck('text')
            ->implode('')
            ?: data_get($lastMessage, 'content', '');

        // dd($prompt);
        $agent = new PresupuestoAsistente();
        $agent->presupuestoID = $presupuesto->id;
        $agent->hasCategories = $presupuesto->isGeneral();


        if ($presupuesto->isGoal()) {
            $agent->presupuestoContext = "Este presupuesto es de tipo Meta/Objetivo llamado '{$presupuesto->name}' con un monto total de \${$presupuesto->amount}. Los gastos NO tienen categorías, solo nombre y monto.";
        } else {
            $agent->presupuestoContext = "Este presupuesto es de tipo General llamado '{$presupuesto->name}' con un monto total de \${$presupuesto->amount}. Los gastos tienen nombre, monto y categoría.";
        }
        // $agent->stream($prompt, provider: '', model: '');
        return $agent
            ->stream(
                $prompt,
                provider: [
                    'groq' => 'openai/gpt-oss-20b',
                    'gemini' => 'gemini-3.1-flash-lite-preview',
                    'openrouter' => 'nvidia/nemotron-3.5-lightning:free',
                ],

            )->usingVercelDataProtocol();
    }
}
