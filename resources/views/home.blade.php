@extends('layout.app')

@section('title')
Administrador de Presupuestos impulsado por IA
@endsection

@section('contents')

{{-- =========================================================
HERO
========================================================= --}}

<section class="relative overflow-hidden bg-purple-950">

    ```
    {{-- Luces decorativas --}}
    <div class="absolute -top-32 -right-32 h-96 w-96 rounded-full bg-purple-700/30 blur-3xl"></div>
    <div class="absolute -bottom-40 -left-20 h-96 w-96 rounded-full bg-amber-500/10 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-28">

        <div class="grid items-center gap-16 lg:grid-cols-5">

            {{-- CONTENIDO --}}
            <div class="lg:col-span-3">

                {{-- Badge --}}
                <div class="mb-7 inline-flex items-center gap-3 rounded-full
                        border border-amber-400/40 bg-amber-400/10
                        px-5 py-2.5 text-amber-300 backdrop-blur">

                    <span class="flex h-2.5 w-2.5 rounded-full bg-amber-400
                             shadow-[0_0_12px_rgba(251,191,36,0.9)]"></span>

                    <span class="text-sm font-bold tracking-wide">
                        Inteligencia Artificial para tus finanzas
                    </span>

                </div>

                {{-- Título --}}
                <h1 class="max-w-4xl text-5xl font-black leading-[1.05]
                       tracking-tight text-white sm:text-6xl lg:text-7xl">

                    Controla tus gastos.

                    <span class="block">
                        Alcanza tus
                        <span class="text-amber-400">
                            metas.
                        </span>
                    </span>

                </h1>

                {{-- Descripción --}}
                <p class="mt-7 max-w-2xl text-lg leading-8 text-purple-100 sm:text-xl">

                    CashTrackr transforma la manera en que administras tu dinero.
                    Registra tus gastos, crea presupuestos y recibe recomendaciones
                    inteligentes gracias al poder de la IA.

                </p>

                {{-- BOTONES --}}
                <div class="mt-9 flex flex-col gap-4 sm:flex-row">

                    <a
                        href="{{ route('registro.store') }}"
                        class="inline-flex items-center justify-center gap-3
                           rounded-xl bg-amber-500 px-7 py-4
                           text-base font-extrabold text-purple-950
                           shadow-lg shadow-amber-500/20
                           transition duration-200
                           hover:-translate-y-1 hover:bg-amber-400
                           hover:shadow-xl">

                        Comenzar gratis

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />

                        </svg>

                    </a>

                    <a
                        href="#funciones"
                        class="inline-flex items-center justify-center
                           rounded-xl border border-white/20
                           bg-white/5 px-7 py-4
                           text-base font-bold text-white
                           backdrop-blur
                           transition hover:bg-white/10">

                        Conocer más

                    </a>

                </div>

                {{-- FEATURES --}}
                <div class="mt-14 grid grid-cols-2 gap-6 sm:grid-cols-4">

                    {{-- IA --}}
                    <div class="group">

                        <div class="mb-3 flex h-12 w-12 items-center justify-center
                                rounded-xl bg-amber-500/10
                                ring-1 ring-amber-400/30
                                transition group-hover:bg-amber-500/20">

                            <img
                                src="{{ asset('img/icon_01.svg') }}"
                                class="h-7 w-7"
                                alt="IA" />

                        </div>

                        <h3 class="font-bold text-white">
                            IA Avanzada
                        </h3>

                        <p class="mt-1 text-sm leading-5 text-purple-200">
                            Análisis inteligente
                        </p>

                    </div>

                    {{-- Presupuestos --}}
                    <div class="group">

                        <div class="mb-3 flex h-12 w-12 items-center justify-center
                                rounded-xl bg-indigo-500/10
                                ring-1 ring-indigo-400/30
                                transition group-hover:bg-indigo-500/20">

                            <img
                                src="{{ asset('img/icon_02.svg') }}"
                                class="h-7 w-7"
                                alt="Presupuestos" />

                        </div>

                        <h3 class="font-bold text-white">
                            Presupuestos
                        </h3>

                        <p class="mt-1 text-sm leading-5 text-purple-200">
                            Controla tus metas
                        </p>

                    </div>

                    {{-- Categorías --}}
                    <div class="group">

                        <div class="mb-3 flex h-12 w-12 items-center justify-center
                                rounded-xl bg-pink-500/10
                                ring-1 ring-pink-400/30
                                transition group-hover:bg-pink-500/20">

                            <img
                                src="{{ asset('img/icon_03.svg') }}"
                                class="h-7 w-7"
                                alt="Categorías" />

                        </div>

                        <h3 class="font-bold text-white">
                            Categorías
                        </h3>

                        <p class="mt-1 text-sm leading-5 text-purple-200">
                            Organiza tus gastos
                        </p>

                    </div>

                    {{-- Seguridad --}}
                    <div class="group">

                        <div class="mb-3 flex h-12 w-12 items-center justify-center
                                rounded-xl bg-lime-500/10
                                ring-1 ring-lime-400/30
                                transition group-hover:bg-lime-500/20">

                            <img
                                src="{{ asset('img/icon_04.svg') }}"
                                class="h-7 w-7"
                                alt="Seguridad" />

                        </div>

                        <h3 class="font-bold text-white">
                            Seguro
                        </h3>

                        <p class="mt-1 text-sm leading-5 text-purple-200">
                            Tus datos protegidos
                        </p>

                    </div>

                </div>

            </div>


            {{-- MOCKUP --}}
            <div class="relative hidden lg:col-span-2 lg:block">

                {{-- Glow --}}
                <div class="absolute left-1/2 top-1/2 h-80 w-80
                        -translate-x-1/2 -translate-y-1/2
                        rounded-full bg-amber-400/20 blur-3xl">
                </div>

                {{-- Imagen --}}
                <div class="relative z-10 flex justify-center">

                    <img
                        src="{{ asset('img/1.png') }}"
                        alt="Vista de CashTrackr"
                        class="w-80 drop-shadow-[0_30px_50px_rgba(0,0,0,0.45)]" />

                </div>


                {{-- CARD IA --}}
                <div class="absolute right-0 top-16 z-20 w-64
                        rounded-2xl border border-white/10
                        bg-purple-900/80 p-5
                        shadow-2xl backdrop-blur-xl">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-amber-500 text-xl">
                            🤖
                        </div>

                        <div>

                            <p class="font-bold text-white">
                                Asistente IA
                            </p>

                            <p class="text-xs text-purple-300">
                                Análisis financiero
                            </p>

                        </div>

                    </div>

                    <p class="mt-4 text-sm leading-6 text-purple-100">

                        Encontré 3 oportunidades para reducir tus gastos este mes.

                    </p>

                    <div class="mt-4 h-1.5 overflow-hidden rounded-full bg-white/10">

                        <div class="h-full w-[72%] rounded-full bg-amber-400"></div>

                    </div>

                    <p class="mt-2 text-right text-xs text-amber-300">
                        Análisis completado
                    </p>

                </div>


                {{-- CARD META --}}
                <div class="absolute bottom-10 left-0 z-20 w-64
                        rounded-2xl border border-white/10
                        bg-purple-900/80 p-5
                        shadow-2xl backdrop-blur-xl">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center
                                rounded-xl bg-amber-500 text-xl">
                            🎯
                        </div>

                        <div>

                            <p class="font-bold text-white">
                                Meta de ahorro
                            </p>

                            <p class="text-xs text-amber-400">
                                Remodelación
                            </p>

                        </div>

                    </div>

                    <div class="mt-5 flex items-end justify-between">

                        <p class="text-2xl font-black text-white">
                            Q 300
                        </p>

                        <p class="text-sm text-purple-300">
                            / Q 500
                        </p>

                    </div>

                    <div class="mt-3 h-2 overflow-hidden rounded-full bg-white/10">

                        <div class="h-full w-[60%] rounded-full bg-amber-400"></div>

                    </div>

                    <p class="mt-2 text-right text-xs text-purple-300">
                        60% completado
                    </p>

                </div>

            </div>

        </div>

    </div>
    ```

</section>

{{-- =========================================================
CURVA
========================================================= --}}

<div class="-mt-px bg-purple-950">

    ```
    <svg
        class="block h-20 w-full"
        viewBox="0 0 1440 120"
        preserveAspectRatio="none"
        xmlns="http://www.w3.org/2000/svg">

        <path
            fill="#f5f3ff"
            d="M0,80 C240,120 480,20 720,60 C960,100 1200,20 1440,60 L1440,120 L0,120 Z" />

    </svg>
    ```

</div>

{{-- =========================================================
FUNCIONES
========================================================= --}}

<section
    id="funciones"
    class="bg-violet-50 px-6 py-24 lg:px-8 lg:py-32">

    ```
    <div class="mx-auto max-w-7xl">

        {{-- Encabezado --}}
        <div class="max-w-3xl">

            <p class="text-sm font-black uppercase tracking-[0.2em] text-purple-700">
                Visualiza · Entiende · Decide
            </p>

            <h2 class="mt-4 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">

                Todo lo que necesitas para

                <span class="text-amber-500">
                    controlar tu dinero.
                </span>

            </h2>

            <p class="mt-6 text-lg leading-8 text-slate-600">

                Una plataforma diseñada para que puedas entender tus finanzas
                sin complicaciones y tomar mejores decisiones cada día.

            </p>

        </div>


        {{-- CONTENIDO --}}
        <div class="mt-20 grid items-center gap-16 lg:grid-cols-5">

            {{-- IMAGEN --}}
            <div class="lg:col-span-2">

                <div class="relative">

                    <div class="absolute inset-0 rounded-3xl
                            bg-purple-300/30 blur-3xl">
                    </div>

                    <div class="relative overflow-hidden rounded-3xl
                            border border-white bg-white p-4
                            shadow-2xl">

                        <img
                            src="{{ asset('img/2.png') }}"
                            alt="Asistente IA de CashTrackr"
                            class="w-full rounded-2xl" />

                    </div>

                </div>

            </div>


            {{-- FEATURES --}}
            <div class="lg:col-span-3">

                <div class="space-y-0 divide-y divide-slate-200">

                    {{-- 01 --}}
                    <article class="group flex gap-5 py-8 first:pt-0">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center
                                rounded-2xl bg-purple-100
                                ring-1 ring-purple-200
                                transition group-hover:bg-purple-600">

                            <svg
                                class="h-6 w-6 text-purple-600 transition group-hover:text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-slate-900">
                                Gráficas claras
                            </h3>

                            <p class="mt-2 leading-7 text-slate-600">
                                Visualiza tus gastos de manera sencilla mediante
                                gráficos intuitivos que te permiten entender
                                rápidamente a dónde va tu dinero.
                            </p>

                        </div>

                    </article>


                    {{-- 02 --}}
                    <article class="group flex gap-5 py-8">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center
                                rounded-2xl bg-orange-100
                                ring-1 ring-orange-200
                                transition group-hover:bg-orange-500">

                            <svg
                                class="h-6 w-6 text-orange-500 transition group-hover:text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-slate-900">
                                Presupuestos flexibles
                            </h3>

                            <p class="mt-2 leading-7 text-slate-600">
                                Define límites de gasto, crea presupuestos por
                                categoría y ajusta tus metas cuando sea necesario.
                            </p>

                        </div>

                    </article>


                    {{-- 03 --}}
                    <article class="group flex gap-5 py-8">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center
                                rounded-2xl bg-pink-100
                                ring-1 ring-pink-200
                                transition group-hover:bg-pink-500">

                            <svg
                                class="h-6 w-6 text-pink-500 transition group-hover:text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-slate-900">
                                Inteligencia Artificial
                            </h3>

                            <p class="mt-2 leading-7 text-slate-600">
                                Registra gastos hablando con la IA, consulta tus
                                presupuestos y analiza tus tickets de compra
                                de manera inteligente.
                            </p>

                        </div>

                    </article>


                    {{-- 04 --}}
                    <article class="group flex gap-5 py-8 last:pb-0">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center
                                rounded-2xl bg-lime-100
                                ring-1 ring-lime-200
                                transition group-hover:bg-lime-500">

                            <svg
                                class="h-6 w-6 text-lime-600 transition group-hover:text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-slate-900">
                                Tus datos siempre disponibles
                            </h3>

                            <p class="mt-2 leading-7 text-slate-600">
                                Mantén organizada tu información financiera y
                                consulta tus datos cuando los necesites.
                            </p>

                        </div>

                    </article>

                </div>

            </div>

        </div>

    </div>
    ```

</section>

{{-- =========================================================
CTA FINAL
========================================================= --}}

<section class="bg-white px-6 py-20 lg:px-8">

    ```
    <div class="mx-auto max-w-5xl">

        <div class="relative overflow-hidden rounded-3xl bg-purple-950 px-8 py-14 text-center shadow-2xl sm:px-14">

            <div class="absolute -right-20 -top-20 h-60 w-60 rounded-full
                    bg-purple-700/40 blur-3xl">
            </div>

            <div class="absolute -bottom-20 -left-20 h-60 w-60 rounded-full
                    bg-amber-500/10 blur-3xl">
            </div>

            <div class="relative">

                <span class="text-4xl">
                    ✨
                </span>

                <h2 class="mt-5 text-3xl font-black text-white sm:text-4xl">

                    Empieza a tomar el control de tus finanzas.

                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-purple-200">

                    Registra tus gastos, crea tus metas y deja que CashTrackr
                    te ayude a tomar mejores decisiones.

                </p>

                <a
                    href="{{ route('registro.store') }}"
                    class="mt-8 inline-flex rounded-xl bg-amber-500
                       px-8 py-4 font-black text-purple-950
                       transition hover:-translate-y-1
                       hover:bg-amber-400">

                    Crear mi cuenta gratis

                </a>

            </div>

        </div>

    </div>
    ```

</section>

{{-- =========================================================
FOOTER
========================================================= --}}

<footer class="bg-purple-950 px-6 py-10">

    ```
    <div class="mx-auto max-w-7xl text-center">

        <div class="flex items-center justify-center gap-2">

            <span class="text-2xl font-black text-white">
                Cash
            </span>

            <span class="text-2xl font-black text-amber-400">
                Trackr
            </span>

        </div>

        <p class="mt-3 text-sm text-purple-300">
            Finanzas inteligentes impulsadas por IA.
        </p>

        <div class="mt-6 h-px bg-white/10"></div>

        <p class="mt-6 text-sm text-purple-400">
            © {{ date('Y') }} CashTrackr. Todos los derechos reservados.
        </p>

    </div>
    ```

</footer>

@endsection