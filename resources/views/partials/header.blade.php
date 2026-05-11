<header
    class="fixed top-0 left-0 w-full z-50
           bg-gradient-to-r from-sky-400 to-blue-800
           shadow-lg"
>

    <div class="h-24 px-4 lg:px-8 flex items-center gap-4 lg:gap-8">

        {{-- LOGO --}}
        <a href="/" class="flex-shrink-0">

            <img
                src="{{ Vite::asset('resources/images/bhh.png') }}"
                alt="Logo"
                class="h-10 lg:h-14 object-contain"
            >

        </a>

        {{-- SEARCH --}}
        <div class="flex-1">

            <div class="relative">

                <input
                    type="text"
                    placeholder="Search..."
                    class="w-full py-2 lg:py-3 pl-5 pr-14 rounded-md
                           border border-gray-300 shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <div class="absolute right-4 top-1/2 -translate-y-1/2">

                    <svg
                        class="w-5 h-5 text-gray-500"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"
                        />
                    </svg>

                </div>

            </div>

        </div>

        {{-- DESKTOP ACTIONS --}}
        <div class="hidden lg:block">
            <x-header-actions />
        </div>

        {{-- MOBILE MENU BUTTON --}}
        <button
            @click="mobileMenuOpen = true"
            class="lg:hidden text-white"
        >

            <svg
                class="w-8 h-8"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>

        </button>

    </div>

</header>


{{-- MOBILE ACTION DRAWER --}}
    <div
        x-show="mobileMenuOpen"
        x-transition
        class="fixed inset-0 z-[60] bg-black/40 lg:hidden"
        @click="mobileMenuOpen = false"
    >
    </div>

    <div
        x-show="mobileMenuOpen"
        x-transition
        class="fixed top-0 right-0 z-[70] h-full w-72 bg-white shadow-2xl lg:hidden"
    >

        <div class="p-6 border-b flex justify-between items-center">

            <h2 class="text-xl font-bold">
                Menu
            </h2>

            <button
                @click="mobileMenuOpen = false"
                class="text-2xl"
            >
                ×
            </button>

        </div>

        <div class="p-6 space-y-6">

            <a href="#" class="block text-lg hover:text-blue-600">
                Orders
            </a>

            <a href="#" class="block text-lg hover:text-blue-600">
                Shopping Basket
            </a>

        </div>

    </div>