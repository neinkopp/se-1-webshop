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

<body class="bg-gray-50 text-gray-800 pt-24 min-h-screen flex flex-col">

    {{-- Header --}}
    @include('partials.header')
    
    <div class="container mx-auto px-6 py-12">
        <x-product-detail  :product="$product"/>
        <x-featured-products :featuredProducts="$featuredProducts" />
    </div>

    <x-footer />

    {{-- JS: total price calculation --}}
    <script>
        const quantityInput = document.getElementById('quantity');
        const unitPrice = parseFloat(document.getElementById('unitPrice').innerText);
        const totalPrice = document.getElementById('totalPrice');

        function updateTotal() {
            const quantity = parseInt(quantityInput.value) || 1;
            totalPrice.innerText = (unitPrice * quantity).toFixed(2);
        }

        quantityInput.addEventListener('input', updateTotal);
    </script>

</body>
</html>