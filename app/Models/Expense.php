<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Presupuesto;

#[Fillable(['name', 'amount', 'category', 'budget_id'])]
class Expense extends Model
{
    use SoftDeletes;

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }
}
