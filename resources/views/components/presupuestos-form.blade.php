@props([
    'presupuesto' => null
])

<div class="flex flex-col gap-2">

    <label class="font-bold text-2xl" for="name">
        Nombre
    </label>

    <input
        id="name"
        type="text"
        name="name"
        placeholder="Nombre del Presupuesto. Ej. Boda, Casa, Graduación, Semana"
        class="w-full border border-gray-300 p-3 rounded-lg"
        value="{{ old('name', $presupuesto?->name) }}"
    >
    @error('name')
        <p class="text-red-500 text-sm font-semibold">
            {{ $message }}
        </p>
    @enderror
</div>


<div class="flex flex-col gap-2">
    <label class="font-bold text-2xl" for="amount">Cantidad</label>

    <input
        id="amount"
        type="number"
        name="amount"
        {{-- value="{{ old('amount') }}" --}}
        min="0"
        step="0.01"
        placeholder="Cantidad del Presupuesto"
        class="w-full border border-gray-300 p-3 rounded-lg"
        value="{{ old('amount', $presupuesto?->amount) }}"
    >

    @error('amount')
        <p class="text-red-500 text-sm font-semibold">
            {{ $message }}
        </p>
    @enderror
</div>


<div class="flex flex-col gap-2">
    <div class="flex gap-2 items-center">
        <label class="font-bold text-2xl" for="type">Tipo de Presupuesto</label>

        <div class="relative inline-block group">
            <button
                type="button"
                class="w-5 h-5 flex items-center justify-center rounded-full bg-gray-900 text-white text-sm font-bold">
                i
            </button>

            <div
                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-52
                rounded-lg bg-gray-900 text-white px-3 py-2
                opacity-0 invisible
                group-hover:opacity-100 group-hover:visible
                transition-all duration-200">

                <p>
                    <span class="font-bold">Presupuesto General</span>
                    te permite almacenar gastos con categorías.
                </p>

                <p class="mt-2">
                    <span class="font-bold">Proyecto</span>
                    te permite almacenar gastos relacionados con una boda, graduación o remodelación.
                </p>
            </div>
        </div>
    </div>

<select
    id="type"
    name="type"
    class="w-full border border-gray-300 p-3 rounded-lg">
    <option value="">Seleccione un tipo</option>
    <option
        value="general"
        {{ old('type', $presupuesto?->type?->value ?? $presupuesto?->type) == 'general' ? 'selected' : '' }}>
        General - Con Categorías
    </option>
    <option
        value="goal"
        {{ old('type', $presupuesto?->type?->value ?? $presupuesto?->type) == 'goal' ? 'selected' : '' }}>
        Proyecto
    </option>
</select>
    @error('type')
        <p class="text-red-500 text-sm font-semibold">
            {{ $message }}
        </p>
    @enderror
</div>