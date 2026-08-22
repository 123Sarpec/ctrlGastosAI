<?php

namespace App\Http\Controllers;

use App\ExpenseCategoria;
use App\Models\Presupuesto;
use Illuminate\Http\Request;
use App\Http\Requests\PresupuestoRequest;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Attributes\Controllers\Prefix;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Inertia\Inertia;
use App\Models\Expense;




#[Middleware('auth')]
#[Middleware('verified')]
class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presupuestos = Auth::user()->presupuestos()->get();

        // la pagia de inicio del dashboard, donde se mostrara el presupuesto general y los presupuestos por metas
        return view('PPrincipal', [
            // 'presupuestos' => Auth::user()->presupuestos()->get(),
            'presupuestos' => $presupuestos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presupuestos.CrearPresupuesto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PresupuestoRequest $request)
    {

        $presupuesto = Auth::user()->presupuestos()->create($request->validated());
        return redirect()->route('dashboard')->with('success', 'Presupuesto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    #[Authorize('view', 'presupuesto')]
    public function show(Presupuesto $presupuesto)
    {
        // mosrtar resultado de gasto y de maner ordenada los gastos
        // $expenses = Expense::where('presupuesto_id', $presupuesto->id)->orderBy('created_at', 'desc')->get();
        // $expenses = $presupuesto->expenses()->latest()->get();

        $presupuesto->load([
            'expenses' => fn($query) => $query->latest()
        ]);
        $spent = $presupuesto->expenses->sum('amount');
        // dd($expenses);
        return Inertia::render('Presupuestos/Show', [
            'presupuesto' => $presupuesto,
            'spent' => $spent,
            'categories' => collect(ExpenseCategoria::cases())->map(fn($categoria) => [
                'value' => $categoria->value,
                'label' => $categoria->Label()
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    #[Authorize('update', 'presupuesto')]
    public function edit(Presupuesto $presupuesto)
    {
        // dd($presupuesto); 
        // dd($presupuesto->name);
        // dd($presupuesto->toArray()); 
        return view('presupuestos.EditarPresupuesto', [
            'presupuesto' => $presupuesto
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    #[Authorize('update', 'presupuesto')]
    public function update(PresupuestoRequest $request, Presupuesto $presupuesto)
    {
        $presupuesto->update($request->validated());
        return redirect()->route('dashboard')->with('success', 'Presupuesto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    #[Authorize('delete', 'presupuesto')]
    public function destroy(Presupuesto $presupuesto)
    {
        $presupuesto->delete();
        return redirect()->route('dashboard')->with('success', 'Presupuesto eliminado correctamente.');
    }
}
