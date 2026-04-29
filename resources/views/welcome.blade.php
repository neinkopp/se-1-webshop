<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- TailwindCSS CDN for quick styling --}}
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-600">ShopWave</h1>

            <nav class="space-x-6 hidden md:block">
                <x-link>Home</x-link>
                <x-link>Products</x-link>
                <x-link>About</x-link>
                <x-link>Contact</x-link>
            </nav>

            <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Cart
            </a>
        </div>
    </header>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-5xl font-bold mb-4">Welcome to ShopWave</h2>
            <p class="text-xl mb-8">Discover amazing products at unbeatable prices.</p>

            <a href="#products"
               class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Shop Now
            </a>
        </div>
    </section>

    {{-- Featured Products --}}
    <section id="products" class="py-16">
        <div class="container mx-auto px-6">
            <h3 class="text-3xl font-bold text-center mb-12">Featured Products</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                {{-- Product Card --}}
                @for ($i = 1; $i <= 5; $i++)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                        <img src="{{ Vite::asset('resources/images/mockup_product_'.$i.'.png') }}"
                             alt="Product"
                             class="w-full">

                        <div class="p-5">
                            <h4 class="text-xl font-semibold mb-2">Product {{ $i }}</h4>
                            <p class="text-gray-600 mb-4">
                                Stylish and high quality item for your store.
                            </p>

                            <div class="flex justify-between items-center">
                                <span class="text-indigo-600 font-bold text-lg">${{ rand(10,100) }},{{ rand(0,9) }}{{ rand(0,9) }}</span>

                                <x-button>
                                    Buy me
                                </x-button>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>
        </div>
    </section>

    {{-- Promo Banner --}}
    <section class="bg-indigo-100 py-14">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-3">Limited Time Offer</h3>
            <p class="text-gray-700 mb-6">Get 25% off selected items this week only.</p>

            <a href="#"
               class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700">
                View Deals
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300 py-10 mt-10">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} ShopWave. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>