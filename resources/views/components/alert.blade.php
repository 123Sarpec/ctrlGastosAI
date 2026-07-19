@props(['type' => 'success', 'message' => ''])

@php
    $color = [
        'success' => 'text-green-500 border border-green-500',
        'error' => 'text-red-500 border border-red-500',
    ];
    $class = $color[$type] ?? $color['success'];
@endphp

@if($message) 
    <div class="text-red-500 border border-red-500 {{ $class }}">
        {{ $message }}
    </div>
@endif  