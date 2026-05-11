<div x-data="{ open: true }" class="mb-5 border-b pb-4">

    <button
        @click="open = !open"
        class="w-full flex justify-between items-center text-left font-semibold text-gray-700"
    >
        <span>{{ $title }}</span>

        <span x-text="open ? '-' : '+'"></span>
    </button>

    <div x-show="open" class="mt-3">
        {{ $slot }}
    </div>

</div>