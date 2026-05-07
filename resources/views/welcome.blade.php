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
    @include('partials.header')

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
                @foreach ($products as $product)
                    <x-product-card 
                    :productHandle="$product->handle"
                    :productDisplayName="$product->name"
                    :productDisplayPrice="$product->price"
                    :productImagePath="$product->default_pictures[0]['picture_storage_key']"
                    />
                @endforeach
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