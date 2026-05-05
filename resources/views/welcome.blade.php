<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- TailwindCSS CDN for quick styling --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 pt-20">

    {{-- Navbar --}}
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

    {{-- Hero Section --}}
    <section class="bg-gradient-to-r from-indigo-400 to-purple-400 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-5xl font-bold mb-4">Willkommen auf der BHH-Shopseite</h2>
            <p class="text-xl mb-8">Hier findest du alle Fanartikel deiner lieblings Hochschule</p>
        </div>
    </section>

    {{-- Featured Products --}}
    <section id="products" class="py-16">
        <div class="container mx-auto px-6">
            <h3 class="text-3xl font-bold text-center mb-12">Unser Sortiment</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                {{-- Product Card --}}
                @for ($i = 1; $i <= 5; $i++)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                        <img src="{{ Vite::asset('resources/images/mockup_product_'.$i.'.png') }}"
                             alt="Produkt"
                             class="w-full">

                        <div class="p-5">
                            <h4 class="text-xl font-semibold mb-2">Produkt {{ $i }}</h4>
                            <p class="text-gray-600 mb-4">
                                Das Produkt mit der Nummer {{ $i }}.
                            </p>

                            <div class="flex justify-between items-center">
                                <span class="text-indigo-600 font-bold text-lg">${{ rand(10,100) }},{{ rand(0,9) }}{{ rand(0,9) }}</span>

                                <x-button>
                                    Details
                                </x-button>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300 py-10 mt-10">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} BHH. Alle Rechte vorbehalten</p>
        </div>
    </footer>

</body>
</html>