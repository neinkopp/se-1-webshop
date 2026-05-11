<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- TailwindCSS CDN for quick styling --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 pt-24 min-h-screen flex flex-col">
<div x-data="{mobileMenuOpen: false}">
    {{-- Header --}}
    <x-header>
        <x-slot:actionsSlot>
            <x-header-actions />
        </x-slot:actionsSlot>
        <x-slot:behaviorSlot>
            <x-header-actions-mobile />
        </x-slot:behaviorSlot>
    </x-header>
    
    <div class="container mx-auto px-6 py-12">
        <x-product-detail  :product="$product"/>
        <x-featured-products :featuredProducts="$featuredProducts" />
    </div>

    <x-footer />
</div>

</body>
</html>