@extends('layout.base')

@section('contents')
       <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-4">@yield('titulo')</h1>
            @yield('actions')
      </div> 


      <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-4">@yield('titulo')</h1>
            @yield('dashboard-contents')
      </div> 
@endsection