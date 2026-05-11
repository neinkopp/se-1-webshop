<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

<div
    x-data="{
        mobileMenuOpen: false,
        sidebarOpen: false
    }"
    class="flex flex-col flex-1"
>

    {{-- HEADER --}}
    @include('partials.header')

    <div class="flex pt-24">

        <x-sidebar title="Filter">
            <x-filter-container
                :filters="$selected_category->filters ?? []"
                :category="$selected_category->category_id ?? ''"
            />
        </x-sidebar>

        {{-- MAIN CONTENT --}}
        <main class="w-full lg:ml-72 flex-1">

            <x-content-header 
            :sidePanelTitle="'Filter'"
            :categories="$categories"
            />
            {{-- PRODUCTS --}}
            <section class="py-10 px-5 lg:px-10 flex-grow">
                @if(count($products) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-5 lg:gap-8">
                        @foreach ($products as $product)

                            <x-product-card 
                                :productHandle="$product->handle"
                                :productDisplayName="$product->name"
                                :productDisplayPrice="$product->price"
                                :productImagePath="$product->default_pictures[0]['picture_storage_key']"
                            />

                        @endforeach
                    </div>
                @else
                    <section class="bg-gradient-to-b from-blue-800 to-blue-500 text-white py-10">
                        <div class="px-5 lg:px-10">
                            <h1 class="text-2xl sm:text-4xl font-bold mb-3">
                                Keine Suchergebnisse
                            </h1>
                            <p class="text-blue-100 text-sm sm:text-lg">
                                Leider haben wir keine entsprechenden Produkte auf Lager. Passe eventuell deine Suche an und probiere es erneut!
                            </p>
                        </div>
                    </section>
                @endif

            </section>
        </main>
    </div>
    <x-footer />

</div>

</body>
</html>