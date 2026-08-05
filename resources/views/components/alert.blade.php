@props(['type' => 'success', 'message' => ''])

@php
    $color = [
        'success' => 'border border-green-100 text-green-500 bg-green-200 mt-2',
        'error' => 'text-red-500 border border-red-100 text-red-500 bg-red-100',
    ];
    $class = $color[$type] ?? $color['success'];
@endphp

@if($message) 
    <div class=" text-center border-l-2 my-2 font-bold uppercase {{ $class }}">
        {{ $message }}
    </div>
@endif  