{{-- <div>
    <!-- It always seems impossible until it is done. - Nelson Mandela -->
</div> --}}

@props(['field'])

    @error($field)
        <p class=" text-red-500 rounded-lg text-sm fw-bold border-b border-red-500 pb-1">{{ $message }}</p>
    @enderror