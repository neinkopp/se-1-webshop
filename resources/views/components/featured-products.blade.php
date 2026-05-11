@props(['featuredProducts'])
<section class="mt-20">

    <div class="flex items-center justify-between mb-8">

        <h2 class="text-3xl font-bold text-blue-950">
            Unsere Empfehlung
        </h2>

    </div>

    <div class="relative">

        {{-- LEFT ARROW --}}
        <button
            class="absolute -left-6 top-1/2 -translate-y-1/2
                    w-14 h-14 rounded-full border-2 border-blue-800
                    text-blue-800 hover:bg-blue-50 transition
                    hidden lg:flex items-center justify-center z-10"
        >
            ←
        </button>

        {{-- PRODUCTS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            @foreach($featuredProducts as $product)
                <x-featured-product-card 
                    :productHandle="$product['handle']"
                    :productDisplayName="$product['name']"
                    :productDisplayPrice="$product['price']"
                    :productImagePath="$product['default_pictures'][0]['picture_storage_key']"
                />
            @endforeach

        </div>

        {{-- RIGHT ARROW --}}
        <button
            class="absolute -right-6 top-1/2 -translate-y-1/2
                    w-14 h-14 rounded-full border-2 border-blue-800
                    text-blue-800 hover:bg-blue-50 transition
                    hidden lg:flex items-center justify-center z-10"
        >
            →
        </button>

    </div>

</section>