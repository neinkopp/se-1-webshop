@props(['href', 'label', 'image_name', 'deletion_href', 'image_background_color'])
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 flex items-center gap-5 hover:bg-gray-100">
    <a href="{{ $href }}" class="flex items-center gap-5">
        <div class="w-16 h-16 rounded-xl bg-{{ $image_background_color }} flex items-center justify-center text-white">
            <img src="{{ Vite::asset("resources/images/{$image_name}") }}" alt="Bild von {{ $label }}" class="w-16">
        </div>
        <div class="flex flex-1 justify-between">
            <p class="text-gray-500 text-xl">
                {{ $label }}
            </p>
            @if ($deletion_href !== '')
                <a href="{{ $deletion_href }}" class="p-1 rounded-xl hover:bg-gray-200">
                    <img src="{{ Vite::asset("resources/images/trashcan.svg") }}" alt="Produkt" class="w-8">
                </a>
            @endif
        </div>
    </a>
</div>