<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{


    public function store(ExpenseRequest $request, Presupuesto $presupuesto)
    {
        // $data = $request->validated();

        Gate::authorize('create', [Expense::class, $presupuesto]);

        $presupuesto->expenses()->create($request->validated());
        return redirect()->route('Presupuestos.show', $presupuesto)->with('success', 'Gasto agregado correctamente.');
    }




    #[Authorize('update', 'expense')]
    public function update(ExpenseRequest $request, Presupuesto $presupuesto, Expense $expense)
    {
        $expense->update($request->validated());
        return redirect()->route('Presupuestos.show', $presupuesto)->with('success', 'Gasto actualizado correctamente.');
    }



    #[Authorize('delete', 'expense')]

    public function destroy(Presupuesto $presupuesto, Expense $expense)
    {
        $expense->delete();
        return redirect()->route('Presupuestos.show', $presupuesto)->with('success', 'Gasto eliminado correctamente.');
    }
}
