@props(['featuredProducts'])
<div class="relative mt-16 mb-4">
    {{-- SLIDER CONTAINER --}}
    <h4 class="text-xl font-semibold mb-2 ml-4">Unsere Topseller:</h4>
    <div class="overflow-x-auto">
        {{-- SLIDER --}}
        <div class="flex gap-6 transition-transform duration-500">
            @foreach ($featuredProducts as $product)
                <div class="min-w-[296px] max-w-[296px]">
                    <x-featured-product-card
                        :product="$product"
                    />
                </div>
            @endforeach
        </div>
    </div>
</div>