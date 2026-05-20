<div
    x-data="{
        current: 0,
        images: [
            '{{ asset('images/banner_1.png') }}',
            '{{ asset('images/banner_2.png') }}',
            '{{ asset('images/banner_3.png') }}'
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

    class="relative w-full overflow-hidden">
    {{-- IMAGE --}}
    <div class="w-full h-[300px] md:h-[400px] bg-black">

        <template x-for="(image, index) in images" :key="index">

            <img
                :src="image"
                x-show="current === index"
                x-transition:enter="transition ease-in-out duration-5000"
                x-transition:leave="transition ease-in-out duration-5000"
                class="w-full h-full object-cover">

        </template>

    </div>

    {{-- DOTS --}}
    <div
        class="absolute bottom-4 left-1/2
               -translate-x-1/2 flex gap-2">

        <template x-for="(image, index) in images" :key="index">

            <button
                @click="current = index"
                class="w-3 h-3 rounded-full"
                :class="
                    current === index
                    ? 'bg-white'
                    : 'bg-white/40'
                "></button>

        </template>

    </div>
</div>