<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\Presupuesto;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{


    public function store(ExpenseRequest $request, Presupuesto $presupuesto)
    {
        // $data = $request->validated();


        $presupuesto->expenses()->create($request->validated());
        return redirect()->route('Presupuestos.show', $presupuesto)->with('success', 'Gasto agregado correctamente.');
    }


    public function update(Request $request, Expense $expense)
    {
        // 
    }

    public function destroy(Expense $expense)
    {
        //
    }
}
