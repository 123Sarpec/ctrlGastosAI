<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Presupuesto;
use App\ExpenseCategoria;

#[Fillable(['name', 'amount', 'category', 'budget_id'])]
class Expense extends Model
{
    use SoftDeletes;
    /*pasar el nombre de categoria en espan ol*/
    protected $casts = ['category' => ExpenseCategoria::class];
    protected $appends = ['category_label', 'category_color'];

    public function getCategoryLabelAttribute(): string
    {
        return $this->category->label();
    }

    public function getCategoryColorAttribute(): string
    {
        return $this->category->color();
    }






    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }
}
