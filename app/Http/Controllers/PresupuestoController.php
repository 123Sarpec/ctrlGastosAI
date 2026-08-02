<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;


#[Middleware('auth')]
#[Middleware('verified')]
class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // la pagia de inicio del dashboard, donde se mostrara el presupuesto general y los presupuestos por metas
            return view('PPrincipal');

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Presupuesto $presupuesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presupuesto $presupuesto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presupuesto $presupuesto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presupuesto $presupuesto)
    {
        //
    }
}
