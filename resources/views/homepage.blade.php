<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body class="bg-gray-50 text-gray-800 h-screen flex flex-col overflow-x-hidden">
    <div x-data="{mobileMenuOpen: false, sidebarOpen: false}" class="h-screen flex flex-col h-full overflow-x-hidden">

        {{-- HEADER --}}
        <x-header>
            <x-slot:actionsSlot>
                <x-header-actions />
            </x-slot:actionsSlot>

            <x-slot:behaviorSlot>
                <x-header-actions-mobile />
            </x-slot:behaviorSlot>
        </x-header>

        {{-- MAIN AREA --}}
        <div class="flex flex-1 overflow-hidden">

            {{-- SIDEBAR --}}
            <x-sidebar title="Filter">
                <x-filter-container
                    :filters="[]"
                    :category="''" />
            </x-sidebar>

            <div class="flex flex-1 overflow-hidden flex-col">

                {{-- CATEGORY HEADER --}}
                <x-content-header
                    :sidePanelTitle="'Filter'"
                    :categories="$categories" />

                {{-- SCROLLABLE CONTENT --}}
                <main class="flex-1 overflow-y-auto min-w-0">

                    {{-- HERO --}}
                    <x-banner-carousel />

                    {{-- TITLE --}}
                    <section class="bg-gradient-to-b from-[#003063] to-[#003063] text-white py-10">

                        <div class="px-5 lg:px-10">

                            <h1 class="text-2xl sm:text-4xl font-bold mb-3">
                                BHH-Webshop
                            </h1>

                            <p class="text-blue-100 text-sm sm:text-lg">
                                Willkommen im offiziellen Online-Shop der Beruflichen Hochschule Hamburg (BHH).
                            </p>

                        </div>

                    </section>

                    {{-- PRODUCTS --}}
                    <section class="py-10 px-5 lg:px-10">

                        {{-- FEATURED --}}
                        <x-featured-products :featuredProducts="$featuredProducts" />

                        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-5 lg:gap-8">

                            @foreach ($products as $product)

                            <x-product-card
                                :product="$product" 
                            />

                            @endforeach

                        </div>

                    </section>

                    {{-- FOOTER --}}
                    <x-footer />

                </main>
            </div>
        </div>
    </div>
</body>

</html>