@props(['product'])
@php

    $defaultPictures =
        $product->attributes['default_pictures']
        ?? [];

    $firstPicture =
        $defaultPictures[0]['picture_storage_key']
        ?? null;

@endphp

<a
    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition flex flex-1 flex-col justify-between"
    href="/products/{{ $product->handle }}"
>

    @if($firstPicture)

        <img
            src="{{ asset('storage/' . $firstPicture) }}"
            alt="{{ $product->name }}"
            class="w-full object-cover"
        >

    @else

        <div class="w-full aspect-square bg-gray-200 flex items-center justify-center text-gray-500">
            Kein Bild
        </div>

    @endif

    <div class="p-5">

        <h4 class="text-xl font-semibold mb-2">
            {{ $product->name }}
        </h4>

        <div class="flex justify-between items-center">

            <span class="text-indigo-600 font-bold text-lg">
                {{ number_format($product->price, 2, ',', '.') }}€
            </span>

        </div>

    </div>

</a>