<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col overflow-x-hidden">

    <div
        x-data="{
        mobileMenuOpen: false,
        sidebarOpen: false
    }"
        class="flex flex-col flex-1">

        {{-- HEADER --}}
        <x-header>
            <x-slot:actionsSlot>
                <x-header-actions />
            </x-slot:actionsSlot>
            <x-slot:behaviorSlot>
                <x-header-actions-mobile />
            </x-slot:behaviorSlot>
        </x-header>

        <div class="flex pt-24 flex-1">

            {{-- MAIN CONTENT --}}
            <main class="w-full max-w-7xl mx-auto px-5 lg:px-10 pb-20">

                {{-- TITLE --}}
                <section class="py-6">
                    <h1 class="text-3xl font-bold text-blue-900">
                        Warenkorb
                    </h1>
                </section>

                {{-- CART LAYOUT --}}
                <section class="flex flex-col lg:flex-row gap-8 items-start">

                    {{-- LEFT COLUMN: ITEMS --}}
                    <div class="flex-1 w-full space-y-6">

                        {{-- INFO BANNER --}}
                        <div class="bg-[#f0f4f8] border border-blue-100 rounded-md p-4 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-900 shrink-0">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-blue-900 text-sm font-medium">Ihre Artikel werden im Warenkorb gespeichert.</p>
                        </div>

                        @forelse ($cartItemsBySupplier as $supplierName => $items)
                        <div class="bg-white border border-gray-200 rounded-md shadow-sm">
                            <div class="bg-gray-50 border-b border-gray-200 px-5 py-3 flex justify-between items-center rounded-t-md">
                                <h3 class="font-bold text-blue-900">Hersteller: {{ $supplierName }}</h3>
                                <span class="bg-[#e6eff8] text-blue-900 text-xs font-semibold px-2.5 py-1 rounded">{{ $items->count() }} Artikel</span>
                            </div>

                            <div class="divide-y divide-gray-100">
                                @foreach ($items as $item)
                                <div class="p-5 flex flex-col sm:flex-row gap-5">
                                    <div class="w-24 h-24 bg-gray-100 rounded flex-shrink-0 flex items-center justify-center overflow-hidden">
                                        <img src="{{ Vite::asset('resources/images/'.$item->product->default_pictures[0]['picture_storage_key']) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 flex flex-col justify-between">
                                        <div>
                                            <a href="#" class="text-lg font-bold text-blue-900 hover:underline">{{ $item->product->name }}</a>
                                            @if ($item->selected_options && isset($item->selected_options['properties']))
                                            @foreach ($item->selected_options['properties'] as $key => $value)
                                            <div class="mt-2 text-sm text-gray-700 flex items-center gap-2">
                                                <span>{{ ucfirst($key) }}:</span>
                                                @if ($key == 'color' || $key == 'Farbe')
                                                <span class="w-4 h-4 rounded-full shadow-inner block" style="background-color: {{ $value }}"></span>
                                                @endif
                                                <span>{{ $value }}</span>
                                            </div>
                                            @endforeach
                                            @endif
                                            <div class="mt-1 text-sm text-gray-700">
                                                <span>Menge: {{ $item->amount }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end justify-between sm:w-24 mt-4 sm:mt-0">
                                        <span class="text-xl font-bold text-blue-900">{{ number_format($item->product->price * $item->amount, 2) }} $</span>
                                        <form action="{{ route('basket.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="position_id" value="{{ $item->id }}">
                                            <button type="submit" class="text-blue-900 hover:text-red-600 transition" aria-label="Artikel entfernen">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @empty
                        <p>Ihr Warenkorb ist leer.</p>
                        @endforelse

                        {{-- BACK BUTTON --}}
                        <div class="pt-2">
                            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 border border-blue-900 text-blue-900 px-5 py-2.5 rounded hover:bg-gray-100 transition font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                                Weiter einkaufen
                            </a>
                        </div>
                    </div>

                    {{-- RIGHT COLUMN: ORDER SUMMARY --}}
                    @if($cartItemsBySupplier->count() > 0)
                    <div class="w-full lg:w-[360px] shrink-0">
                        <div class="bg-white border border-gray-200 rounded-md shadow-sm p-6 sticky top-28">
                            <h2 class="text-xl font-bold text-blue-900 mb-6">Bestellübersicht</h2>

                            <div class="space-y-4 text-gray-800">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-blue-900">Zwischensumme:</p>
                                        <p class="text-sm text-gray-500">({{ $totalItems }} Artikel)</p>
                                    </div>
                                    <span class="font-bold text-lg text-blue-900">{{ number_format($totalPrice, 2) }} $</span>
                                </div>

                                <hr class="border-gray-200 py-1">

                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-lg text-blue-900">Gesamtsumme</span>
                                    <span class="font-bold text-xl text-blue-900">{{ number_format($totalPrice, 2) }} $</span>
                                </div>

                                <div class="mt-6">
                                    <form action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-[#003063] text-white font-bold py-3 rounded hover:bg-blue-800 transition-colors">
                                            Zur Kasse
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                </section>
            </main>

        </div>
        <x-footer />

    </div>

</body>

</html>