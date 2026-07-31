
@extends("layout.auth")


@section('titulo')
Crear Cuenta
@endsection
@section('auto-contents')
    <p class="text-center text-gray-500 text-sm"> 
        Antes de continuar, por favor verifica tu correo electrónico para obtener un enlace de verificación.
        Si no recibiste el correo electrónico.
    </p>
    @if(session('success'))
     <x-alert :message="session('success')" /> 
@endif 
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf   
        <input type="submit" class="bg-blue-500 w-full px-5 py-2 text-sm text-center font-bold mt-5 uppercase cursor-pointer" value="Reenviar correo de verificación"/>
    </form>
@endsection