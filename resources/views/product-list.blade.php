<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body class="bg-gray-50 text-gray-800 h-screen flex flex-col overflow-x-hidden">
        <div x-data="{mobileMenuOpen: false, sidebarOpen: false}" class="h-screen flex flex-col h-full">

            <x-header>
                <x-slot:actionsSlot>
                    <x-header-actions />
                </x-slot:actionsSlot>
                <x-slot:behaviorSlot>
                    <x-header-actions-mobile />
                </x-slot:behaviorSlot>
            </x-header>

            <div class="flex flex-1 overflow-hidden">

                <x-sidebar title="Filter">
                    <x-filter-container
                        :filters="$selected_category->filters ?? []"
                        :category="$selected_category->category_id ?? ''"
                    />
                </x-sidebar>

                <div class="flex flex-1 overflow-hidden flex-col">

                    <x-content-header 
                        :sidePanelTitle="'Filter'"
                        :categories="$categories"
                    />

                    {{-- MAIN CONTENT --}}
                    <main class="flex-1 overflow-y-auto min-w-0">
                        {{-- PRODUCTS --}}
                        <section class="py-10 px-5 lg:px-10">
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

                            {{-- FEATURED --}}
                            <x-featured-products
                                :featuredProducts="$featuredProducts"
                            />
                        </section>
                        <x-footer />
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>