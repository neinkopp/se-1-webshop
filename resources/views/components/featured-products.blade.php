@props(['featuredProducts'])
<div
    x-data="{
        current: 0,
        cardWidth: 320,

        next(max) {
            if (this.current < max) {
                this.current++
            }
        },

        previous() {
            if (this.current > 0) {
                this.current--
            }
        }
    }"
    class="relative"
>

    {{-- LEFT BUTTON --}}
    <button
        @click="previous()"
        class="absolute -left-6 top-1/2 -translate-y-1/2
               w-14 h-14 rounded-full border-2 border-blue-800
               text-blue-800 hover:bg-blue-50 transition
               hidden lg:flex items-center justify-center z-10 bg-white"
    >
        ←
    </button>

    {{-- SLIDER CONTAINER --}}
    <div class="overflow-hidden">

        {{-- SLIDER --}}
        <div
            class="flex gap-6 transition-transform duration-500"
            :style="`
                transform:
                translateX(-${current * cardWidth}px)
            `"
        >

            @foreach ($featuredProducts as $product)

                <div class="min-w-[296px] max-w-[296px]">

                    <x-featured-product-card
                        :productHandle="$product->handle"
                        :productDisplayName="$product->name"
                        :productDisplayPrice="$product->price"
                        :productImagePath="$product->default_pictures[0]['picture_storage_key']"
                    />

                </div>

            @endforeach

        </div>

    </div>

    {{-- RIGHT BUTTON --}}
    <button
        @click="next({{ max(count($featuredProducts) - 4, 0) }})"
        class="absolute -right-6 top-1/2 -translate-y-1/2
               w-14 h-14 rounded-full border-2 border-blue-800
               text-blue-800 hover:bg-blue-50 transition
               hidden lg:flex items-center justify-center z-10 bg-white"
    >
        →
    </button>

</div>