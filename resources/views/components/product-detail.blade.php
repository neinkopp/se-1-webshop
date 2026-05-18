@props(['product'])

@php
    $productImages = [];
    $variants = [];

    $variants['default'] = ['pictures' => $product->default_pictures, 'value' => 'default'];
    if(isset($product->attributes["properties"]["color"])) {
        foreach($product->attributes["properties"]["color"]["values"] as $color) {
            $variants[$color['displayName']] = ['pictures' => $color['pictures'], 'value' => $color['displayName']];
        }
    }

    foreach($variants as $variant) {
        for($i = 0; $i < count($variant['pictures']); $i++) {
            $productImages[$variant['value']][$i] = Vite::asset('resources/images/'.$variant['pictures'][$i]['picture_storage_key']);
        }
    }

@endphp

<script>
async function validateForm(event) {
    event.preventDefault(); 

    const form = event.target; 
    const color = document.getElementById("attribute_color");

    if(color) {
        if (!color.value.trim()) {
            alert("Bitte wählen Sie eine Farbe aus.");
            return;
        }
    }

    const formData = new FormData(form);
    try {
        const response = await fetch("/putInBasket", {
            method: "POST",
            body: formData
        });

        if (response.ok) {
            window.location.href="/basket";
        } else {
            alert("Leider ist ein Fehler aufgetreten, bitte versuche es erneut.");
        }
    } catch (error) {
        console.error("Network error:", error);
        alert("Leider ist ein Fehler aufgetreten, bitte versuche es erneut.");
    }
}
</script>

<div class="max-w-7xl mx-auto px-4 lg:px-8 py-10" x-data="{
        selectedColor: '',

        images: @js($productImages),

        currentImages: @js($productImages['default']),

        selectedImage: @js($productImages['default'][0]),

        selectColor(color) {

            this.selectedColor = color;

            this.currentImages = this.images[color];

            this.selectedImage = this.currentImages[0];
        },

        selectImage(image) {
            this.selectedImage = image;
        }
    }">

    {{-- BACK LINK --}}
    <a href="/products" class="inline-flex items-center gap-3 text-blue-900 font-semibold mb-8 hover:underline">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Zurück zur Übersicht
    </a>

    <form class="grid grid-cols-1 lg:grid-cols-2 gap-10" onsubmit="return validateForm(event)" method="POST">
        <div>
            <div class="flex gap-4 flex-col lg:flex-row">
                <div class="flex border rounded-xl overflow-hidden bg-white">
                    <img :src="selectedImage" class="w-full aspect-square object-contain p-6">
                </div>
                <div class="flex flex-row gap-4 mt-4 lg:flex-col gap-4 mt-4">
                    <template x-for="image in currentImages" :key="image">
                        <button @click="selectImage(image)" type="button" class="w-24 h-24 border rounded-xl overflow-hidden">
                            <img :src="image" class="w-full h-full object-contain p-2">
                        </button>
                    </template>
                </div>
            </div>
            <div class="mt-8">
                @for ($i = 0; $i < count($product->attributes['properties']); $i++)
                    @if(array_keys($product->attributes['properties'])[$i] !== 'print')
                        <h3 class="font-semibold text-lg mb-4">
                            <label for="attribute_{{ array_keys($product->attributes['properties'])[$i] }}">{{ $product->attributes['properties'][array_keys($product->attributes['properties'])[$i]]['displayName'] }} wählen:</label>
                        </h3>
                        <div class="flex flex-wrap gap-6 mb-7">
                            @if(array_keys($product->attributes['properties'])[$i] == 'color')
                                @foreach($product->attributes['properties']['color']['values'] as $color)
                                    <button type="button" class="flex flex-col items-center gap-2 group" @click="selectColor('{{ $color['displayName'] }}')">
                                        <div class="w-10 h-10 rounded-full border-2 border-gray-300 group-hover:scale-110 transition" style="background-color: {{ $color['value'] }}"></div>
                                        <span class="text-sm text-gray-700">{{ $color['displayName'] }}</span>
                                    </button>
                                @endforeach
                                <input id="attribute_color" name="color" :value="selectedColor" hidden>                   
                            @else
                                <x-dropdown-list :name="array_keys($product->attributes['properties'])[$i]">
                                    @foreach ($product->attributes['properties'][array_keys($product->attributes['properties'])[$i]]['values'] as $attribute)
                                        <x-dropdown-option 
                                            :value="$attribute"
                                            :displayText="$attribute"
                                        />
                                    @endforeach
                                </x-dropdown-list>
                            @endif
                        </div>
                    @endif
                @endfor
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div>

            {{-- PRODUCT TITLE --}}
            <h1 class="text-4xl font-bold text-blue-950 mb-4">
                {{ $product->name }}
            </h1>

            <input name="productHandle" value="{{ $product->handle }}" hidden>

            {{-- PRICE --}}
            <div class="text-3xl font-bold text-blue-900 mb-6">
                {{ $product->price }}€
            </div>

            <div class="border-b mb-8"></div>
            {{-- ACTIONS --}}
            <div class="flex flex-col gap-4">
                {{-- QUANTITY + ADD TO CART --}}
                <div class="flex flex-col md:flex-row gap-4">
                    {{-- QUANTITY --}}
                    <div class="flex items-center border rounded-xl overflow-hidden h-14">
                        <label class="px-5 font-medium text-gray-700" for="attribute_amount">Menge</label>
                        <input type="number" value="1" min="1" class="w-20 h-full border-l border-r text-center outline-none" name="amount" id="attribute_amount">
                    </div>
                    {{-- ADD TO CART --}}
                    <button class="bg-blue-900 hover:bg-blue-800 text-white font-semibold px-8 h-14 rounded-xl flex items-center justify-center gap-3 transition" type="submit">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 7h11M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        In den Warenkorb
                    </button>
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="mt-10 border rounded-2xl p-6 bg-white">

                <h2 class="text-2xl font-bold mb-4 text-blue-950">
                    Beschreibung
                </h2>

                <p class="text-gray-700 leading-relaxed">
                    {{ $product->description }}
                </p>

            </div>

            <div
            <div class="mt-10 border rounded-2xl p-6 bg-white">

                <h2 class="text-2x3 font-bold mb-4 text-blue-950">
                    Aufdrücke
                </h2>

                <p class="text-gray-700 leading-relaxed">
                    @foreach($product->attributes['properties']['print']['values'] as $print)
                        <span class="inline-flex items-center px-2 py-1 ring-1 ring-inset ring-default text-heading text-sm font-medium rounded bg-neutral-primary-soft">
                            {{ $print }}
                        </span>
                    @endforeach
                </p>

            </div>

            <div

            {{-- PRODUCER --}}
            <div class="mt-6 text-xl font-semibold">
                Produzent: {{ $product->supplier_name }}
            </div>

        </div>

    </form>
</div>