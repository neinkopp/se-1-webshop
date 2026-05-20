@props(['product'])
@php

    $defaultPictures =
        $product->attributes['default_pictures']
        ?? [];

    $firstPicture =
        $defaultPictures[0]['picture_storage_key']
        ?? null;

@endphp
<a href="/products/{{ $product->handle }}" class="bg-white rounded-2xl overflow-hidden hover:shadow-lg transition">
    <img src="{{ asset('storage/' . $firstPicture) }}"
            alt="Bild von {{ $product->name }}" class="w-full aspect-square object-contain p-4">
    <div class="p-5">
        <h3 class="text-xl font-semibold text-blue-950 mb-2"> {{ $product->name }}</h3>
        <div class="text-2xl font-bold text-blue-900">{{ number_format($product->price, 2, ',', '.') }}€</div>
    </div>
</a>