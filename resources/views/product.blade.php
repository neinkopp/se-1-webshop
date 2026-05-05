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

<body class="bg-gray-50 text-gray-800 pt-24">

    {{-- Header --}}
    @include('partials.header')

    <div class="container mx-auto px-6 py-12">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- Product Image --}}
            <div class="flex justify-center">
                <img 
                    src="{{ Vite::asset($product['productImagePath']) }}"
                    class="w-96 rounded-xl shadow-md"
                    alt="Product Image"
                >
            </div>

            {{-- Product Info --}}
            <div class="flex flex-col gap-6">

                {{-- Name --}}
                <h1 class="text-4xl font-bold">
                    {{ $product['productDisplayName'] }}
                </h1>

                {{-- Price --}}
                <p class="text-2xl text-indigo-600 font-semibold">
                    <span id="unitPrice">
                        {{ $product['productDisplayPrice'] }}€
                    </span>
                </p>

                {{-- Description --}}
                <p class="text-gray-600">
                    {{ $product['productDescription'] }}
                </p>

                {{-- Color Selection --}}
                <div>
                    <label class="font-semibold">Color:</label>
                    <div class="flex gap-4 mt-2">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="color" value="red">
                            <span class="w-5 h-5 bg-red-500 rounded-full"></span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="radio" name="color" value="green">
                            <span class="w-5 h-5 bg-green-500 rounded-full"></span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="radio" name="color" value="blue">
                            <span class="w-5 h-5 bg-blue-500 rounded-full"></span>
                        </label>
                    </div>
                </div>

                {{-- Size Selection --}}
                <div>
                    <label class="font-semibold">Size:</label>
                    <select class="mt-2 border rounded-lg px-3 py-2">
                        <option>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                    </select>
                </div>

                {{-- Quantity --}}
                <div>
                    <label class="font-semibold">Amount:</label>
                    <input 
                        id="quantity"
                        type="number"
                        value="1"
                        min="1"
                        class="mt-2 w-24 border rounded-lg px-3 py-2"
                    >
                </div>

                {{-- Total Price --}}
                <div class="text-xl font-bold">
                    Total: <span id="totalPrice">
                        {{ $product['productDisplayPrice'] }}€
                    </span>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4">

                    <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                        Add to Basket
                    </button>

                    <button class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                        Buy Now
                    </button>

                </div>

            </div>

        </div>

    </div>

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