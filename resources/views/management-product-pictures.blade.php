<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')

    <body class="bg-gray-50 text-gray-800 h-screen flex flex-col overflow-x-hidden">

        <div x-data="{mobileMenuOpen: false, sidebarOpen: false}" class="h-screen flex flex-col overflow-x-hidden">

            {{-- HEADER --}}
            <x-header>
                <x-slot:actionsSlot>
                    <x-header-management-actions />
                </x-slot:actionsSlot>

                <x-slot:behaviorSlot>
                    <x-header-management-actions-mobile />
                </x-slot:behaviorSlot>
            </x-header>

            {{-- MAIN --}}
            <div class="flex flex-1 overflow-hidden" x-data="productPicturesManager()">

                {{-- SIDEBAR --}}
                <x-sidebar title="Verwaltungsansicht">
                    <x-management-actions-container />
                </x-sidebar>

                <div class="flex flex-1 overflow-hidden flex-col">

                    {{-- CONTENT HEADER --}}
                    <x-content-header
                        :sidePanelTitle="'Produktbilder verwalten'"
                        :categories="[]"
                    />

                    {{-- CONTENT --}}
                    <main class="flex-1 overflow-y-auto min-w-0">

                        <section class="py-10 px-5 lg:px-10">

                            <div class="max-w-7xl mx-auto">

                                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

                                    {{-- TITLE --}}
                                    <div class="mb-10">

                                        <h1 class="text-3xl font-bold text-blue-900">
                                            Bilder & Assets
                                        </h1>

                                        <p class="text-gray-500 mt-2">
                                            Farben, Bilder und Assets verwalten
                                        </p>

                                    </div>

                                    {{-- DEFAULT PICTURES --}}
                                    <div class="mb-16">

                                        <div class="flex items-center justify-between mb-5">

                                            <div>
                                                <h2 class="text-xl font-semibold">
                                                    Standardbilder
                                                </h2>

                                                <p class="text-gray-500 text-sm">
                                                    Maximal 4 Bilder
                                                </p>
                                            </div>

                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                                            @for($i = 0; $i < 4; $i++)

                                                @php
                                                    $picture = $product->attributes['default_pictures'][$i]['picture_storage_key'] ?? null;
                                                @endphp

                                                <x-management-product-image-upload
                                                    :current="$picture"
                                                    :name="'defaultPicture' . $i"
                                                    :id="'defaultPicture' . $i"
                                                    :label="'Bild ' . ($i + 1)"
                                                />

                                            @endfor

                                        </div>

                                    </div>
                                    {{-- COLORS --}}
                                    @if(isset($product->attributes['properties']['color']))
                                        <div class="mb-16">

                                            <div class="flex items-center justify-between mb-5">

                                                <div>

                                                    <h2 class="text-xl font-semibold">
                                                        Farben
                                                    </h2>

                                                    <p class="text-gray-500 text-sm">
                                                        Jede Farbe besitzt bis zu 4 Bilder
                                                    </p>

                                                </div>

                                                <button
                                                    type="button"
                                                    @click="addColor()"
                                                    class="bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl"
                                                >
                                                    Farbe hinzufügen
                                                </button>

                                            </div>

                                            <div class="space-y-8">

                                                <template
                                                    x-for="(color, colorIndex) in colors"
                                                    :key="color.id"
                                                >

                                                    <div class="border border-gray-200 rounded-2xl p-6">

                                                        {{-- HEADER --}}
                                                        <div class="flex items-start justify-between gap-5 mb-6">

                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 flex-1">

                                                                <div>

                                                                    <label class="block text-sm font-medium mb-2">
                                                                        Anzeigename
                                                                    </label>

                                                                    <input
                                                                        type="text"
                                                                        x-model="color.displayName"
                                                                        class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                                        placeholder="weiß"
                                                                    >

                                                                </div>

                                                                <div>

                                                                    <label class="block text-sm font-medium mb-2">
                                                                        Farbwert
                                                                    </label>

                                                                    <input type="color" x-model="color.value"
                                                                        class="w-12 h-12 rounded-xl border border-gray-300 px-2 py-2"
                                                                    >

                                                                </div>

                                                            </div>

                                                            <button
                                                                type="button"
                                                                @click="removeColor(colorIndex)"
                                                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-xl"
                                                            >
                                                                Entfernen
                                                            </button>

                                                        </div>

                                                        {{-- PICTURES --}}
                                                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                                                            <template
                                                                x-for="slot in 4"
                                                                :key="slot"
                                                            >

                                                                <div>

                                                                    <label class="block text-sm font-medium mb-2">
                                                                        Bild <span x-text="slot"></span>
                                                                    </label>

                                                                    <div
                                                                        class="space-y-3"
                                                                    >

                                                                        <div
                                                                            class="aspect-square rounded-2xl overflow-hidden border bg-gray-100"
                                                                        >

                                                                            <template
                                                                                x-if="color.currentPictures[slot - 1]"
                                                                            >

                                                                                <img
                                                                                    :src="'/storage/' + color.currentPictures[slot - 1]"
                                                                                    class="w-full h-full object-cover"
                                                                                >

                                                                            </template>

                                                                            <template
                                                                                x-if="!color.currentPictures[slot - 1]"
                                                                            >

                                                                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                                                                                    Kein Bild
                                                                                </div>

                                                                            </template>

                                                                        </div>

                                                                        <input
                                                                            type="file"
                                                                            :id="'colorPicture_' + colorIndex + '_' + slot"
                                                                            class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                                        >

                                                                    </div>

                                                                </div>

                                                            </template>

                                                        </div>

                                                    </div>

                                                </template>

                                            </div>

                                        </div>
                                    @endif

                                    {{-- ASSETS --}}
                                    <div class="mb-12">

                                        <div class="flex items-center justify-between mb-5">

                                            <div>

                                                <h2 class="text-xl font-semibold">
                                                    Aufdrücke
                                                </h2>
                                                <p class="text-gray-500 text-sm">
                                                    Stelle die Bilder bereit, die auf das Produkt gedruckt werden sollen.
                                                </p>

                                            </div>

                                            <button
                                                type="button"
                                                @click="addAsset()"
                                                class="bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl"
                                            >
                                                Aufdrücke hinzufügen
                                            </button>

                                        </div>

                                        <div class="space-y-6">

                                            <template x-for="(asset, assetIndex) in assets" :key="asset.id">
                                                <div class="border border-gray-200 rounded-2xl p-6">
                                                    <div class="flex items-start justify-between gap-5">
                                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 flex-1">
                                                            <div>
                                                                <label class="block text-sm font-medium mb-2">
                                                                    Position (Englisch)
                                                                </label>
                                                                <input type="text" x-model="asset.position" placeholder="front" class="w-full rounded-xl border border-gray-300 px-4 py-3">
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium mb-2">
                                                                    Aktueller Aufdruck
                                                                </label>

                                                                <div class="aspect-square w-32 rounded-3xl overflow-hidden border bg-gray-100">

                                                                    <template x-if="asset.currentAsset">
                                                                        <img :src="'/storage/' + asset.currentAsset" class="w-full h-full object-stretch">
                                                                    </template>

                                                                    <template x-if="!asset.currentAsset">
                                                                        <div class="w-full h-full flex items-center justify-center text-black text-sm">
                                                                            Kein Aufdruck
                                                                        </div>
                                                                    </template>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" @click="removeAsset(assetIndex)" class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-xl">
                                                            Entfernen
                                                        </button>
                                                    </div>
                                                    <input type="file" :id="'asset_'+ assetIndex" class="w-full rounded-xl border border-gray-300 px-4 py-3 mt-1">
                                                </div>

                                            </template>

                                        </div>

                                    </div>

                                    {{-- ACTIONS --}}
                                    <div class="flex items-center justify-between pt-8 border-t">

                                        <a href="/manage/products/attributes/{{ $product->handle }}" class="bg-gray-900 hover:bg-gray-950 text-white px-8 py-3 rounded-xl">
                                            Abbrechen
                                        </a>

                                        <button type="button" @click="savePictures()" class="bg-blue-900 hover:bg-blue-950 text-white px-8 py-3 rounded-xl">
                                            Bilder speichern
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </section>

                        <x-footer />

                    </main>

                </div>

            </div>

        </div>

        <script>

            @php
            $colors = collect($product->attributes['properties']['color'] ?? [])
                ->map(function ($color) {
                    return [
                        'id' => $color['externalId'] ?? \Illuminate\Support\Str::uuid(),
                        'displayName' => $color['displayName'] ?? '',
                        'value' => $color['value'] ?? '#000000',
                        'currentPictures' => collect($color['pictures'] ?? [])
                            ->map(fn ($picture) => $picture['picture_storage_key'] ?? null)->values()->toArray(),
                    ];
                })->values()->toArray();


            $assets = collect($product->attributes['assets'] ?? []
                )->map(function ($asset) {
                    return [
                        'id' => Str::uuid(),
                        'position' => $asset['position'] ?? '',
                        'currentAsset' => $asset['asset_storage_key'] ?? null
                    ];
                })->values()->toArray();
            @endphp

            function productPicturesManager() {

                return {
                    colors: @json($colors),

                    assets: @json($assets),

                    addColor() {

                        this.colors.push({

                            id: crypto.randomUUID(),

                            displayName: '',

                            value: '#000000',

                            pictures: [],

                            currentPictures: []
                        });
                    },

                    removeColor(index) {

                        this.colors.splice(index, 1);
                    },

                    addAsset() {

                        this.assets.push({

                            id: crypto.randomUUID(),

                            position: '',

                            asset_storage_key: null
                        });
                    },

                    removeAsset(index) {

                        this.assets.splice(index, 1);
                    },

                    async savePictures() {

                        const confirmed =
                            confirm(
                                'Sind Sie sicher, dass Sie speichern möchten?'
                            );

                        if (!confirmed) {
                            return false;
                        }

                        try {

                            const formData =
                                new FormData();

                            formData.append(
                                'handle',
                                '{{ $product->handle }}'
                            );

                            /*
                            |--------------------------------------------------------------------------
                            | COLORS
                            |--------------------------------------------------------------------------
                            */

                            this.colors.forEach((color, colorIndex) => {

                                formData.append(
                                    `colors[${colorIndex}][displayName]`,
                                    color.displayName
                                );

                                formData.append(
                                    `colors[${colorIndex}][value]`,
                                    color.value
                                );

                                for (let i = 1; i <= 4; i++) {

                                    const input =
                                        document.getElementById(
                                            `colorPicture_${colorIndex}_${i}`
                                        );

                                    if (
                                        input &&
                                        input.files[0]
                                    ) {

                                        formData.append(
                                            `color_pictures[${colorIndex}][${i}]`,
                                            input.files[0]
                                        );
                                    }
                                }
                            });

                            /*
                            |--------------------------------------------------------------------------
                            | DEFAULT PICTURES
                            |--------------------------------------------------------------------------
                            */

                            for (let i = 0; i < 4; i++) {

                                const input =
                                    document.getElementById(
                                        `defaultPicture${i}`
                                    );

                                if (
                                    input &&
                                    input.files[0]
                                ) {

                                    formData.append(
                                        `default_pictures[${i}]`,
                                        input.files[0]
                                    );
                                }
                            }

                            /*
                            |--------------------------------------------------------------------------
                            | ASSETS
                            |--------------------------------------------------------------------------
                            */

                            this.assets.forEach((asset, assetIndex) => {

                                formData.append(
                                    `assets[${assetIndex}][position]`,
                                    asset.position
                                );

                                const input =
                                    document.getElementById(
                                        `asset_${assetIndex}`
                                    );

                                if (
                                    input &&
                                    input.files[0]
                                ) {

                                    formData.append(
                                        `assets[${assetIndex}][file]`,
                                        input.files[0]
                                    );
                                }
                            });

                            const response =
                                await fetch('/manage/products/changePictures',
                                    {
                                        method: 'POST',

                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                            'Accept': 'application/json'
                                        },

                                        body: formData
                                    }
                                );

                            const contentType = response.headers.get('content-type');
                            const data = contentType && contentType.includes('application/json')
                                ? await response.json()
                                : await response.text();

                            if (!response.ok) {

                                alert(data.message ?? 'Fehler beim Speichern');

                                return false;
                            }

                            window.location.href = '/manage/products';

                        } catch(error) {
                            alert(
                                'Netzwerkfehler' + error
                            );
                        }
                    }
                }
            }

        </script>

    </body>
</html>