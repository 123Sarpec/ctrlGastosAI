@extends('layout.app')

@section('title', 'Pago Exitoso')

@section('dashboard-contents')
<div class="max-w-2xl mx-auto px-4 py-8 sm:py-12 card">
    <!-- Alerta de éxito -->
    <div class="rounded-lg bg-green-50 p-4 shadow-sm dark:bg-green-500/10 dark:outline dark:outline-green-500/20">
        <div class="flex items-center">
            <div class="shrink-0">
                <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-5 text-green-500 dark:text-green-400">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800 dark:text-green-300">¡Transacción completada con éxito!</p>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="mt-6 text-center sm:text-left">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
            ¡Ahora eres PRO!
        </h1>
        <p class="mt-3 text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
            Tu cuenta ha sido actualizada correctamente. Comienza a explorar todos los beneficios exclusivos en tus
            <a href="{{ route('dashboard') }}" class="font-medium text-amber-600 hover:text-amber-500 dark:text-amber-400 underline underline-offset-4 transition-colors">
                Presupuestos
            </a>.
        </p>

        <div class="mt-8">
            <a href="{{ route('dashboard') }}" class="inline-flex w-full sm:w-auto items-center justify-center rounded-lg bg-amber-500 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-amber-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 transition-all">
                Ir a mis Presupuestos
            </a>
        </div>
    </div>
</div>
@endsection