<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\PresupuestoTipo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['name', 'amount', 'type', 'user_id'])]
class Presupuesto extends Model
{
    
    use softDeletes, HasFactory;
/*castrar el tipo de presupuesto a la clase PresupuestoTipo*/
    protected $casts = [
        'type' => PresupuestoTipo::class,
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isGeneral() : bool
    {
        return $this->type === PresupuestoTipo::General;
    }
        public function isGoal() : bool
    {
        return $this->type === PresupuestoTipo::Goal;
    }

}
