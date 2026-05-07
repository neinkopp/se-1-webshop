<a class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" href="\products\{{ $productHandle }}">
    <img src="{{ Vite::asset("resources/images/{$productImagePath}") }}"
            alt="Produkt"
            class="w-full">

    <div class="p-5">
        <h4 class="text-xl font-semibold mb-2">{{ $productDisplayName }}</h4>

        <div class="flex justify-between items-center">
            <span class="text-indigo-600 font-bold text-lg">{{ $productDisplayPrice }}€</span>

            <x-button>
                Details
            </x-button>
        </div>
    </div>
</a>