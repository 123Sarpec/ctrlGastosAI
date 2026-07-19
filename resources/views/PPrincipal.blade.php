
@extends("layout.auth")


@section('titulo')
Administra tus presupuestos de manera eficiente
@endsection
@section('auto-contents')
   @if (session('success'))
       <p class="text-green-500 border border-green-500">{{ session('success') }}</p>
   @endif
@endsection
