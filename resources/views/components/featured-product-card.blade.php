@props(['productHandle', 'productDisplayName', 'productDisplayPrice', 'productImagePath'])
<a href="/products/{{ $productHandle }}" class="bg-white border rounded-2xl overflow-hidden hover:shadow-lg transition">
    <img src="{{ Vite::asset('resources/images/'.$productImagePath) }}" alt="Produkt" class="w-full aspect-square object-contain p-4">
    <div class="p-5">
        <h3 class="text-xl font-semibold text-blue-950 mb-2"> {{ $productDisplayName }}</h3>
        <div class="text-2xl font-bold text-blue-900">{{ $productDisplayPrice }}€</div>
    </div>
</a>