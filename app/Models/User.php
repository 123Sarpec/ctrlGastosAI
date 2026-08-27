<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerificacionEmail;
use Laravel\Cashier\Billable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, Billable;

    public function sendEmailVerificationNotification()
    {
        // $this->notify(new \App\Notifications\VerifyEmail);
        // dd('Email verification notification sent.');
        $this->notify(new VerificacionEmail());
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class);
    }

    public function currentPlan(): ?string
    {
        if (! $this->subscribed('default')) {
            return null;
        }

        return match (true) {
            $this->subscribedToPrice(config('services.stripe.price_monthly'), 'default') => 'monthly',

            $this->subscribedToPrice(config('services.stripe.price_yearly'), 'default') => 'yearly',

            default => null,
        };
    }

    public function isOnMonthlyPlan(): bool
    {
        return $this->currentPlan() === 'monthly';
    }

    public function isOnYearlyPlan(): bool
    {
        return $this->currentPlan() === 'yearly';
    }
}
