@extends('layout.base')

@section('title')
Olvidé mi contraseña
@endsection

@section('contents')

<div class="min-h-[70vh] flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-md">

        <div class="text-center mb-8">

            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-purple-100">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-8 w-8 text-purple-900">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 5.25a3.75 3.75 0 1 1-7.5 0
                       3.75 3.75 0 0 1 7.5 0ZM4.501 20.118
                       a7.5 7.5 0 0 1 14.998 0A17.933 17.933
                       0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900">
                ¿Olvidaste tu contraseña?
            </h1>

            <p class="mt-3 text-gray-500 leading-relaxed">
                No te preocupes. Ingresa tu correo electrónico
                y te enviaremos instrucciones para recuperar tu cuenta.
            </p>

        </div>


        <div class="rounded-2xl bg-white p-6 shadow-2xl ring-1 ring-gray-100 sm:p-8">

            <form method="POST" action="{{ route('password.email')}}" class="space-y-6" novalidate>

                @csrf

                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold text-gray-700">
                        Correo electrónico
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-5 w-5 text-gray-400">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21.75 6.75v10.5
                                   a2.25 2.25 0 0 1-2.25 2.25H4.5
                                   a2.25 2.25 0 0 1-2.25-2.25V6.75
                                   m19.5 0A2.25 2.25 0 0 0 19.5 4.5H4.5
                                   a2.25 2.25 0 0 0-2.25 2.25m19.5 0
                                   -8.69 5.79a2.25 2.25 0 0 1-2.52 0L2.25 6.75" />
                            </svg>
                        </div>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="ejemplo@correo.com"
                            autocomplete="email"
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 py-3.5 pl-12 pr-4 text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-purple-700 focus:bg-white focus:ring-2 focus:ring-purple-100" />

                    </div>

                    @error('email')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Botón --}}
                <button
                    type="submit"
                    class="w-full rounded-xl bg-purple-950 px-5 py-3.5 text-base font-bold text-white shadow-md transition duration-200 hover:bg-purple-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    Enviar instrucciones
                </button>

            </form>


            {{-- Volver al login --}}
            <div class="mt-6 border-t border-gray-100 pt-6 text-center">

                <a
                    href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-purple-900 transition hover:text-purple-700">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-4 w-4">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>

                    Volver a iniciar sesión
                </a>

            </div>

        </div>

    </div>
</div>

@endsection