@extends("layout.auth")

@section('titulo')
Nueva Contraseña
@endsection

@section('contents')

<div class="min-h-[80vh] flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">

            {{-- Encabezado --}}
            <div class="text-center mb-8">

                <div class="mx-auto mb-5 flex items-center justify-center
                        w-16 h-16 rounded-full bg-purple-100">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-purple-900"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />

                    </svg>

                </div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Nueva contraseña
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Crea una nueva contraseña segura para proteger tu cuenta.
                </p>

            </div>

            <form method="POST"
                action="{{ route('password.update') }}"
                class="space-y-6"
                novalidate>

                @csrf

                {{-- Errores --}}
                <x-mensage-error field="token" />
                <x-mensage-error field="email" />

                {{-- Password --}}
                <div class="space-y-2">

                    <label
                        for="password"
                        class="block text-sm font-semibold text-gray-700">
                        Nueva contraseña
                    </label>

                    <div class="relative">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Ingresa tu nueva contraseña"
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-gray-300
                               bg-gray-50 px-4 py-3.5
                               text-gray-900
                               outline-none
                               transition
                               focus:border-purple-700
                               focus:bg-white
                               focus:ring-4
                               focus:ring-purple-100">

                    </div>

                    <x-mensage-error field="password" />

                </div>

                {{-- Confirmar Password --}}
                <div class="space-y-2">

                    <label
                        for="password_confirmation"
                        class="block text-sm font-semibold text-gray-700">
                        Confirmar contraseña
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Repite tu nueva contraseña"
                        autocomplete="new-password"
                        class="w-full rounded-xl border border-gray-300
                           bg-gray-50 px-4 py-3.5
                           text-gray-900
                           outline-none
                           transition
                           focus:border-purple-700
                           focus:bg-white
                           focus:ring-4
                           focus:ring-purple-100">

                </div>

                {{-- Token --}}
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <input type="hidden" name="email" value="{{ $email }}">

                {{-- Botón --}}
                <button
                    type="submit"
                    class="w-full rounded-xl
                       bg-purple-950
                       hover:bg-purple-900
                       active:bg-purple-950
                       px-4 py-3.5
                       text-white
                       font-bold
                       text-lg
                       shadow-lg
                       shadow-purple-950/20
                       transition
                       duration-200
                       hover:-translate-y-0.5
                       hover:shadow-xl
                       focus:outline-none
                       focus:ring-4
                       focus:ring-purple-200">

                    Guardar nueva contraseña

                </button>

            </form>

            {{-- Información --}}
            <div class="mt-6 rounded-xl bg-purple-50 border border-purple-100 p-4">

                <div class="flex gap-3">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-purple-800 shrink-0 mt-0.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M12 20.5a8.5 8.5 0 100-17 8.5 8.5 0 000 17z" />

                    </svg>

                    <p class="text-xs leading-5 text-purple-900">
                        Utiliza una contraseña de al menos 8 caracteres,
                        combinando letras, números y símbolos para mayor seguridad.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection