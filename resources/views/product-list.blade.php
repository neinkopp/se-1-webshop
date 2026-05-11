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

<body class="bg-gray-100 text-gray-800">

<div
    x-data="{
        mobileMenuOpen: false,
        sidebarOpen: false
    }"
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
        <main class="w-full lg:ml-72">

            <x-content-header 
            :sidePanelTitle="'Filter'"
            :categories="$categories"
            />
            <div class="flex flex-col min-h-screen">
                {{-- PRODUCTS --}}
                <section class="py-10 px-5 lg:px-10 flex-grow">

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

                </section>
                <x-footer />
            </div>
        </main>
    </div>

</div>

</body>
</html>