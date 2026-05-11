@props(['product'])

<div class="max-w-7xl mx-auto px-4 lg:px-8 py-10">

    {{-- BACK LINK --}}
    <a
        href="products"
        class="inline-flex items-center gap-3 text-blue-900 font-semibold mb-8 hover:underline"
    >
        <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M15 19l-7-7 7-7"
            />
        </svg>

        Zurück zur Übersicht
    </a>

    {{-- PRODUCT SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        {{-- LEFT SIDE --}}
        <div>

            {{-- PRODUCT IMAGE + THUMBNAILS --}}
            <div class="flex gap-4">

                {{-- MAIN IMAGE --}}
                <div class="flex-1 border rounded-xl overflow-hidden bg-white">

                    <img
                        src="{{ Vite::asset('resources/images/'.$product->default_pictures[0]['picture_storage_key']) }}"
                        alt="Produkt"
                        class="w-full aspect-square object-contain p-6"
                    >

                </div>

                {{-- THUMBNAILS --}}
                <div class="flex flex-col gap-4">

                    @foreach($product->default_pictures as $defaultPicture)

                        <button class="w-24 h-24 border-2 border-blue-900 rounded-xl overflow-hidden bg-white hover:border-blue-600 transition">
                            <img src="{{ Vite::asset('resources/images/'.$defaultPicture['picture_storage_key']) }}" alt="Thumbnail" class="w-full h-full object-contain p-2">

                        </button>

                    @endforeach

                </div>

            </div>

            {{-- COLORS --}}
            <div class="mt-8">

                <h3 class="font-semibold text-lg mb-4">
                    Farbe wählen:
                </h3>

                <div class="flex flex-wrap gap-6">

                    {{-- COLOR OPTION --}}

                    @foreach ($product->attributes["properties"]["color"] as $color)

                        <button class="flex flex-col items-center gap-2 group">

                            <div class="w-10 h-10 rounded-full border-2 border-gray-300 group-hover:scale-110 transition" style="background-color: {{ $color['value'] }}"></div>

                            <span class="text-sm text-gray-700">
                                {{ $color['displayName'] }}
                            </span>

                        </button>

                    @endforeach

                </div>

            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div>

            {{-- PRODUCT TITLE --}}
            <h1 class="text-4xl font-bold text-blue-950 mb-4">
                {{ $product->name }}
            </h1>

            {{-- PRICE --}}
            <div class="text-5xl font-bold text-blue-900 mb-6">
                {{ $product->price }}€
            </div>

            <div class="border-b mb-8"></div>

            {{-- ACTIONS --}}
            <div class="flex flex-col gap-4">

                {{-- QUANTITY + ADD TO CART --}}
                <div class="flex flex-col md:flex-row gap-4">

                    {{-- QUANTITY --}}
                    <div
                        class="flex items-center border rounded-xl overflow-hidden h-14"
                    >

                        <span class="px-5 font-medium text-gray-700">
                            Menge
                        </span>

                        <input
                            type="number"
                            value="1"
                            min="1"
                            class="w-20 h-full border-l border-r text-center outline-none"
                        >

                        <div class="flex flex-col">

                            <button
                                class="px-3 py-1 hover:bg-gray-100 border-b"
                            >
                                ▲
                            </button>

                            <button
                                class="px-3 py-1 hover:bg-gray-100"
                            >
                                ▼
                            </button>

                        </div>

                    </div>

                    {{-- ADD TO CART --}}
                    <button
                        class="bg-blue-900 hover:bg-blue-800 text-white
                               font-semibold px-8 h-14 rounded-xl
                               flex items-center justify-center gap-3
                               transition"
                    >

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 7h11M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"
                            />
                        </svg>

                        In den Warenkorb

                    </button>

                </div>

            </div>

            {{-- DESCRIPTION --}}
            <div class="mt-10 border rounded-2xl p-6 bg-white">

                <h2 class="text-2xl font-bold mb-4 text-blue-950">
                    Beschreibung
                </h2>

                <p class="text-gray-700 leading-relaxed">
                    {{ $product->description }}
                </p>

            </div>

            {{-- PRODUCER --}}
            <div class="mt-6 text-xl font-semibold">
                Produzent: {{ $product->supplier_name }}
            </div>

        </div>

    </div>
</div>