<?php

namespace App\Policies;

use App\Models\Presupuesto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PresupuestoPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Presupuesto $presupuesto): Response
    {
        return $user->id === $presupuesto->user_id ? Response::allow() : Response::deny('no tienes permiso para ver es presupuesto');
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Presupuesto $presupuesto): Response
    {
        return $user->id === $presupuesto->user_id ? Response::allow() : Response::deny('no tiens permiso para editar es presupuesto');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Presupuesto $presupuesto): Response
    {
        return $user->id === $presupuesto->user_id ? Response::allow() : Response::deny('no tienes permiso para eliminar este presupuesto');
    }
}
