@props([
    'label',
    'current' => null,
    'name',
    'id'
])

<div class="space-y-2">

    <div class="w-32 h-32 rounded-xl overflow-hidden border bg-gray-100">
        @if($current)
            <img src="{{ asset('storage/'.$current) }}" class="w-full h-full object-cover" alt="{{ $label }}">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                Kein Bild
            </div>
        @endif
    </div>
    <input id="{{ $id }}" type="file" name="{{ $name }}" class="rounded-xl border border-gray-300 px-4 py-3 w-full">
</div>