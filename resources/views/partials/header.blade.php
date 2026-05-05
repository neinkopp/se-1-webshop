<header class="fixed top-0 left-0 w-full z-50 bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex items-center gap-6">

        {{-- Logo --}}
        <div class="flex-shrink-0">
            <img src="{{ Vite::asset('resources/images/bhh.png') }}" alt="Logo" class="h-10">
        </div>

        {{-- Search Bar (takes most space) --}}
        <div class="flex-grow">
            <div class="relative">
                <input 
                    type="text" 
                    placeholder="Hier suchen..." 
                    class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >

                {{-- Search Icon --}}
                <svg 
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>
        </div>

        {{-- Order History --}}
        <div>
            <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">
                Order History
            </a>
        </div>

        {{-- Shopping Basket --}}
        <div class="relative group">
            <a href="#" class="flex items-center text-gray-700 hover:text-indigo-600">

                {{-- Cart Icon --}}
                <svg 
                    class="w-7 h-7" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 7h11M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                </svg>

                {{-- Tooltip --}}
                <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 
                            bg-gray-800 text-white text-xs px-2 py-1 rounded 
                            opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                    Einkaufswagen
                </span>

            </a>
        </div>

    </div>
</header>