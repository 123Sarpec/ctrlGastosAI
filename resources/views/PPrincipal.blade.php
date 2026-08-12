@extends("layout.app")


@section('titulo')

@section('actions')


<div class="sm:flex sm:items-center mt-10">
    <div class="sm:flex-auto">
        <h1 class="font-bold text-4xl">Administra tus Presupuestos</h1>
        <p class="mt-2 text-xl text-gray-500">Administra tus Presupuestos en esta sección</p>
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">

        <a href="{{ route('Presupuestos.create') }}"
            class="block bg-amber-500 text-white w-full px-5 py-3 rounded-lg  font-bold  text-xl cursor-pointer text-center">Nuevo Presupuesto</a>
    </div>
</div>

@endsection
@section('dashboard-contents')
@if (count($presupuestos)>0)

<div class="mt-8 mx-auto max-w-6xl rounded-2xl bg-gray-50 p-8 shadow-lg ring-1 ring-gray-100">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($presupuestos as $presupuesto)
        <div class="relative overflow-hidden rounded-2xl bg-white shadow-md ring-1 ring-gray-100 hover:shadow-xl transition">
            {{-- Tipo --}}
            <div class="absolute top-0 left-0">
                <p class="inline-flex rounded-br-2xl px-4 py-2 text-sm font-bold
                        {{ $presupuesto->isGeneral() 
                            ? 'bg-green-400 text-green-900' 
                            : 'bg-purple-400 text-purple-900' }}">
                    {{ $presupuesto->isGeneral() ? 'General' : 'Proyecto' }}
                </p>
            </div>

            <div class="p-6 pt-10">
                <a
                    class="block text-2xl font-bold text-gray-800 hover:text-amber-500 transition"
                    href="{{ route('Presupuestos.show', $presupuesto) }}">
                    {{ $presupuesto->name }}
                </a>
                <p class="mt-3 text-3xl font-extrabold text-gray-900">
                    Q. {{ number_format($presupuesto->amount,2) }}
                </p>
                <div class="my-5 border-t border-gray-100"></div>
                <div class="flex justify-end">
                    <x-presupuesto-dropdown
                        :presupuesto="$presupuesto" />

                    <x-confirmar-eliminacion
                        :id="'delete-dialog-'.$presupuesto->id"
                        :title="'Eliminar Presupuesto: ' . $presupuesto->name"
                        :message="'¿Estás seguro de que deseas eliminar el presupuesto ' . $presupuesto->name . '? Esta acción no se puede deshacer.'"
                        :action="route('Presupuestos.destroy', $presupuesto)" />
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<p class="text-center text-xl mt-10 ">No Hay Presupuestos.
    <a href="{{ route('Presupuestos.create') }}" class="text-amber-500">Comienza creando uno</a>
</p>
@endif
@endsection