<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SuscripcionChekout extends Controller
{
    public function store(Request $request, string $plan)
    {

        $prices = [
            'monthly' => config('services.stripe.price_monthly'),
            'yearly' => config('services.stripe.price_yearly'),
        ];
        abort_unless(isset($prices[$plan]), 400, 'plan no valida');
        $checkout = $request->user()
            ->newSubscription('default', $prices[$plan])
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('billing.success'),
                'cancel_url' => route('billing.cancel'),
            ]);
        return Inertia::location($checkout->url);
    }
}
