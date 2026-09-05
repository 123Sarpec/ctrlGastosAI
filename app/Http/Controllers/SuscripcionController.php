<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;

class SuscripcionController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $suscripcion = $user->subscription('default');

        if (!$suscripcion) {
            return redirect()->route('plans');
        }
        //comprobar el plan actual
        $currentPlan = $user->subscribedToPrice(config('services.stripe.price_yearly'), 'default') ? 'yearly' : 'monthly';

        $nextBillingDate = $this->getNextBillingDate($suscripcion);
        // dd($nextBillingDate);

        // dd($currentPlan);
        return Inertia::render('Suscripciones/manage', [
            'subscription' => [
                'plan' => $currentPlan,
                'price' => $currentPlan === 'yearly' ? 100 : 10,
                'status_label' => $this->buildStatusLabel($suscripcion, $nextBillingDate),
                'on_grace_period' => $suscripcion->onGracePeriod(),
                'next_billing_date' => $nextBillingDate,
                'ends_at' => $suscripcion->ends_at?->toIso8601String(),
                'canceled' => $suscripcion->canceled()

            ]
        ]);
    }

    public function swap(Request $request, string $plan)
    {
        // dd('desde swap');
        $prices = [
            'monthly' => config('services.stripe.price_monthly'),
            'yearly' => config('services.stripe.price_yearly')
        ];
        abort_unless(isset($prices[$plan]), 404);
        $user = $request->user();
        $suscripcion = $user->subscription('default');
        $currentPlan = $user->subscribedToPrice(config('services.stripe.price_yearly'), 'default') ? 'yearly' : 'monthly';
        // dd($currentPlan);
        if ($currentPlan === 'yearly' && $plan === 'monthly') {
            return back()->with('error', 'No se puede cambiar de plan anual a mensual');
        }
        if ($currentPlan === $plan) {
            return back()->with('error', 'Ya tienes el plan');
        }
        $suscripcion->swap($prices[$plan]);
        cache()->forget("stripe.next_billing.{$suscripcion->id}");
        // return back()->with('success', 'Plan actualizado correctamente');
        return redirect()->route('subscription.manage')
            ->with('success', 'Plan actualizado correctamente');
    }

    public function cancel(Request $request)
    {
        // dd('desde cancelar ');
        $request->user()->subscription('default')->cancel();
        return back()->with('success', 'Suscripción cancelada correctamente');
    }

    public function resume(Request $request)
    {
        // dd('desde resume');
        $request->user()->subscription('default')->resume();
        return back()->with('success', '¡Bienvenido de nuevo! Tu suscripción ha sido reactivada correctamente.');
    }



    private function getNextBillingDate(Subscription $subscription): ?string
    {
        return cache()->remember(
            "stripe.next_billing.{$subscription->id}",
            now()->addHours(1),
            function () use ($subscription) {
                try {
                    $stripe = $subscription->asStripeSubscription();

                    $periodEnd = $stripe->items->data[0]->current_period_end ?? null;

                    return $periodEnd
                        ? Carbon::createFromTimestamp($periodEnd)->toIso8601String()
                        : null;
                } catch (\Exception $e) {
                    logger()->error('Error obteniendo next billing date', [
                        'error' => $e->getMessage(),
                        'subscription_id' => $subscription->id,
                    ]);
                    return null;
                }
            }
        );
    }

    private function buildStatusLabel(Subscription $subscription, ?string $nextBillingDate): array
    {
        if ($subscription->ended()) {
            return [
                'text' => 'Suscripción terminada',
                'description' => 'Terminó el',
                'date' => $subscription->ends_at?->toIso8601String(),
                'color' => 'gray',
            ];
        }

        if ($subscription->onGracePeriod()) {
            return [
                'text' => 'Cancelada',
                'description' => 'Acceso hasta el ',
                'date' => $subscription->ends_at?->toIso8601String(),
                'color' => 'orange',
            ];
        }

        if ($subscription->hasIncompletePayment() || $subscription->pastDue()) {
            if ($this->latestInvoiceIsPaid($subscription)) {
                return [
                    'text' => 'Suscripción Activa',
                    'description' => 'Tu próximo cobro será el ',
                    'color' => 'green',
                    'date' => $nextBillingDate,
                ];
            }

            if ($subscription->hasIncompletePayment()) {
                return [
                    'text' => 'Pago por confirmar',
                    'description' => 'Completa la verificación de tu tarjeta',
                    'date' => null,
                    'color' => 'red',
                ];
            }

            return [
                'text' => 'Pago pendiente',
                'description' => 'Actualiza tu método de pago para continuar',
                'date' => null,
                'color' => 'red',
            ];
        }

        return [
            'text' => 'Suscripción Activa',
            'description' => 'Tu próximo cobro será el ',
            'color' => 'green',
            'date' => $nextBillingDate,
        ];
    }

    private function latestInvoiceIsPaid($subscription): bool
    {
        try {
            $stripeSub = $subscription->asStripeSubscription();
            if (!$stripeSub->latest_invoice) {
                return false;
            }

            $invoice = \Laravel\Cashier\Cashier::stripe()
                ->invoices
                ->retrieve($stripeSub->latest_invoice);

            return $invoice->status === 'paid';
        } catch (\Exception $e) {
            logger()->error('Error verificando invoice', [
                'error' => $e->getMessage(),
                'subscription_id' => $subscription->id,
            ]);
            return false;
        }
    }
}
