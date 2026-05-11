<div
    x-data="{
        current: 0,
        images: [
            '{{ Vite::asset('resources/images/banner_1.png') }}',
            '{{ Vite::asset('resources/images/banner_2.png') }}',
            '{{ Vite::asset('resources/images/banner_3.png') }}'
        ],

        next() {
            this.current =
                (this.current + 1) % this.images.length
        },

        previous() {
            this.current =
                (this.current - 1 + this.images.length)
                % this.images.length
        }
    }"

    x-init="
        setInterval(() => {
            next()
        }, 10000)
    "

    class="relative w-full overflow-hidden"
>
    {{-- IMAGE --}}
    <div class="w-full h-[300px] md:h-[400px] bg-black">

        <template x-for="(image, index) in images" :key="index">

            <img
                :src="image"
                x-show="current === index"
                x-transition:enter="transition ease-in-out duration-5000"
                x-transition:leave="transition ease-in-out duration-5000"
                class="w-full h-full object-cover"
            >

        </template>

    </div>

    {{-- LEFT ARROW --}}
    <button
        @click="previous()"
        class="absolute left-4 top-1/2 -translate-y-1/2
               bg-black/40 hover:bg-black/60
               text-white rounded-full p-3"
    >
        ←
    </button>

    {{-- RIGHT ARROW --}}
    <button
        @click="next()"
        class="absolute right-4 top-1/2 -translate-y-1/2
               bg-black/40 hover:bg-black/60
               text-white rounded-full p-3"
    >
        →
    </button>

    {{-- DOTS --}}
    <div
        class="absolute bottom-4 left-1/2
               -translate-x-1/2 flex gap-2"
    >

        <template x-for="(image, index) in images" :key="index">

            <button
                @click="current = index"
                class="w-3 h-3 rounded-full"
                :class="
                    current === index
                    ? 'bg-white'
                    : 'bg-white/40'
                "
            ></button>

        </template>

    </div>
</div>