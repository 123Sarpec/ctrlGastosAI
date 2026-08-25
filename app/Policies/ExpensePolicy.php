<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\Presupuesto;

class ExpensePolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Presupuesto $presupuesto): Response
    {
        return $user->id === $presupuesto->user_id ? Response::allow() : Response::deny('No tienes permiso para crear gastos en este presupuesto');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Expense $expense): Response
    {
        return $user->id === $expense->presupuesto->user_id ? Response::allow() : Response::deny('No tienes permiso para editar gastos en este presupuesto');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Expense $expense): Response
    {
        return $user->id === $expense->presupuesto->user_id ? Response::allow() : Response::deny('No tienes permiso para eliminar gastos en este presupuesto');
    }
}
