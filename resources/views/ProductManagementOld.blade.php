<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')

    <body class="bg-gray-50 text-gray-800 h-screen flex flex-col overflow-x-hidden">

        <div
            x-data="{mobileMenuOpen: false, sidebarOpen: false}"
            class="h-screen flex flex-col overflow-x-hidden"
        >

            {{-- HEADER --}}
            <x-header>
                <x-slot:actionsSlot>
                    <x-header-management-actions />
                </x-slot:actionsSlot>

                <x-slot:behaviorSlot>
                    <x-header-management-actions-mobile />
                </x-slot:behaviorSlot>
            </x-header>

            {{-- MAIN AREA --}}
            <div class="flex flex-1 overflow-hidden" x-data="productEditor()">

                {{-- SIDEBAR --}}
                <x-sidebar title="Verwaltungsansicht">
                    <x-management-actions-container />
                </x-sidebar>

                <div class="flex flex-1 overflow-hidden flex-col">

                    {{-- CONTENT HEADER --}}
                    <x-content-header
                        :sidePanelTitle="$product ? 'Produkt bearbeiten' : 'Produkt hinzufügen'"
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

                                            {{ $product ? 'Produkt bearbeiten' : 'Produkt hinzufügen' }}

                                        </h1>

                                        <p class="text-gray-500 mt-2">
                                            Produkte verwalten, Bilder hochladen und Eigenschaften definieren
                                        </p>

                                    </div>

                                    {{-- WARNING --}}
                                    <template x-if="categoryChanged">

                                        <x-warning>
                                            Sie haben die Kategorie geändert. Bitte speichern Sie das Produkt und öffnen Sie es erneut, um die Eigenschaften zu bearbeiten.
                                        </x-warning>

                                    </template>

                                    {{-- BASIC INFORMATION --}}
                                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-10 mt-8">

                                        {{-- LEFT --}}
                                        <div class="space-y-6">

                                            {{-- NAME --}}
                                            <div>

                                                <label class="block text-sm font-medium mb-2">
                                                    Name *
                                                </label>

                                                <input
                                                    type="text"
                                                    x-model="name"
                                                    class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                >

                                            </div>

                                            {{-- HANDLE --}}
                                            <div>

                                                <label class="block text-sm font-medium mb-2">
                                                    Handle *
                                                </label>

                                                <input
                                                    type="text"
                                                    x-model="handle"
                                                    class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                >

                                            </div>

                                            {{-- PRICE --}}
                                            <div>

                                                <label class="block text-sm font-medium mb-2">
                                                    Preis *
                                                </label>

                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    x-model="price"
                                                    class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                >

                                            </div>

                                            {{-- CATEGORY --}}
                                            <div>

                                                <label class="block text-sm font-medium mb-2">
                                                    Kategorie
                                                </label>

                                                <select
                                                    x-model="categoryId"
                                                    @change="onCategoryChange()"
                                                    class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                >

                                                    <option value="">
                                                        Kategorie auswählen
                                                    </option>

                                                    @foreach($categories as $category)

                                                        <option
                                                            value="{{ $category->category_id }}"
                                                        >
                                                            {{ $category->name }}
                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                            {{-- SUPPLIER --}}
                                            <div>

                                                <label class="block text-sm font-medium mb-2">
                                                    Hersteller
                                                </label>

                                                <input
                                                    type="text"
                                                    x-model="supplierName"
                                                    class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                >

                                            </div>

                                        </div>

                                        {{-- RIGHT --}}
                                        <div>

                                            <label class="block text-sm font-medium mb-2">
                                                Beschreibung
                                            </label>

                                            <textarea
                                                rows="12"
                                                x-model="description"
                                                class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                            ></textarea>

                                        </div>

                                    </div>

                                    {{-- DEFAULT PICTURES --}}
                                    <div class="mt-12">

                                        <div class="flex items-center justify-between mb-5">

                                            <h2 class="text-2xl font-bold">
                                                Standardbilder
                                            </h2>

                                            <span class="text-sm text-gray-500">
                                                Maximal 4 Bilder
                                            </span>

                                        </div>

                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                                            <template
                                                x-for="(picture, index) in getDefaultPictureSlots()"
                                                :key="index"
                                            >

                                                <div
                                                    class="relative aspect-square border-2 border-dashed border-gray-300 rounded-2xl overflow-hidden"
                                                >

                                                    {{-- IMAGE --}}
                                                    <template x-if="picture.preview">

                                                        <img
                                                            :src="picture.preview"
                                                            class="w-full h-full object-cover"
                                                        >

                                                    </template>

                                                    {{-- INPUT --}}
                                                    <input
                                                        type="file"
                                                        accept="image/*"
                                                        class="absolute inset-0 opacity-0 cursor-pointer"
                                                        @change="setDefaultPicture($event, index)"
                                                    >

                                                    {{-- EMPTY --}}
                                                    <template x-if="!picture.preview">

                                                        <div
                                                            class="absolute inset-0 flex items-center justify-center text-gray-400 text-sm"
                                                        >
                                                            Bild hinzufügen
                                                        </div>

                                                    </template>

                                                    {{-- REMOVE --}}
                                                    <button
                                                        x-show="picture.preview"
                                                        type="button"
                                                        @click="removeDefaultPicture(index)"
                                                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8"
                                                    >
                                                        ×
                                                    </button>

                                                </div>

                                            </template>

                                        </div>

                                    </div>

                                    {{-- ASSETS --}}
                                    <div class="mt-12">

                                        <div class="flex items-center justify-between mb-5">

                                            <h2 class="text-2xl font-bold">
                                                Assets
                                            </h2>

                                            <button
                                                type="button"
                                                @click="addAsset()"
                                                class="bg-black text-white px-4 py-2 rounded-xl"
                                            >
                                                Asset hinzufügen
                                            </button>

                                        </div>

                                        <div class="space-y-4">

                                            <template
                                                x-for="(asset, index) in assets"
                                                :key="index"
                                            >

                                                <div
                                                    class="border border-gray-200 rounded-2xl p-5"
                                                >

                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                                                        <input
                                                            type="text"
                                                            x-model="asset.position"
                                                            placeholder="front"
                                                            class="rounded-xl border border-gray-300 px-4 py-3"
                                                        >

                                                        <input
                                                            type="file"
                                                            @change="setAsset($event, index)"
                                                            class="rounded-xl border border-gray-300 px-4 py-3"
                                                        >

                                                        <button
                                                            type="button"
                                                            @click="removeAsset(index)"
                                                            class="bg-red-600 text-white rounded-xl px-4 py-3"
                                                        >
                                                            Entfernen
                                                        </button>

                                                    </div>

                                                </div>

                                            </template>

                                        </div>

                                    </div>

                                    {{-- ATTRIBUTES --}}
                                    <div
                                        class="mt-12"
                                        :class="categoryChanged ? 'opacity-50 pointer-events-none' : ''"
                                    >

                                        <h2 class="text-2xl font-bold mb-6">
                                            Eigenschaften
                                        </h2>

                                        <template
                                            x-for="(attribute, key) in properties"
                                            :key="key"
                                        >

                                            <div class="mb-10">

                                                {{-- DISPLAY NAME --}}
                                                <div class="flex items-center justify-between mb-4">

                                                    <h3
                                                        class="text-xl font-semibold"
                                                        x-text="getDisplayName(key)"
                                                    ></h3>

                                                    <button
                                                        type="button"
                                                        @click="addPropertyValue(key)"
                                                        class="text-blue-700"
                                                    >
                                                        + Wert hinzufügen
                                                    </button>

                                                </div>

                                                {{-- NORMAL ATTRIBUTES --}}
                                                <template x-if="key !== 'color'">

                                                    <div class="flex flex-wrap gap-3">

                                                        <template
                                                            x-for="(value, index) in attribute"
                                                            :key="index"
                                                        >

                                                            <div class="flex gap-2">

                                                                <input
                                                                    type="text"
                                                                    x-model="attribute[index]"
                                                                    class="rounded-xl border border-gray-300 px-4 py-3"
                                                                >

                                                                <button
                                                                    type="button"
                                                                    @click="attribute.splice(index, 1)"
                                                                    class="bg-red-600 text-white rounded-xl px-4"
                                                                >
                                                                    ×
                                                                </button>

                                                            </div>

                                                        </template>

                                                    </div>

                                                </template>

                                                {{-- COLOR --}}
                                                <template x-if="key === 'color'">

                                                    <div class="space-y-8">

                                                        <template
                                                            x-for="(color, colorIndex) in attribute"
                                                            :key="colorIndex"
                                                        >

                                                            <div
                                                                class="border border-gray-200 rounded-2xl p-5"
                                                            >

                                                                {{-- HEADER --}}
                                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">

                                                                    <input
                                                                        type="text"
                                                                        x-model="color.displayName"
                                                                        placeholder="weiß"
                                                                        class="rounded-xl border border-gray-300 px-4 py-3"
                                                                    >

                                                                    <input
                                                                        type="color"
                                                                        x-model="color.value"
                                                                        class="h-12 rounded-xl border border-gray-300"
                                                                    >

                                                                    <button
                                                                        type="button"
                                                                        @click="removeColor(colorIndex)"
                                                                        class="bg-red-600 text-white rounded-xl px-4 py-3"
                                                                    >
                                                                        Farbe entfernen
                                                                    </button>

                                                                </div>

                                                                {{-- PICTURES --}}
                                                                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                                                                    <template
                                                                        x-for="(picture, pictureIndex) in getColorPictureSlots(color)"
                                                                        :key="pictureIndex"
                                                                    >

                                                                        <div
                                                                            class="relative aspect-square border-2 border-dashed border-gray-300 rounded-2xl overflow-hidden"
                                                                        >

                                                                            {{-- IMAGE --}}
                                                                            <template x-if="picture.preview">

                                                                                <img
                                                                                    :src="picture.preview"
                                                                                    class="w-full h-full object-cover"
                                                                                >

                                                                            </template>

                                                                            {{-- INPUT --}}
                                                                            <input
                                                                                type="file"
                                                                                accept="image/*"
                                                                                class="absolute inset-0 opacity-0 cursor-pointer"
                                                                                @change="setColorPicture(
                                                                                    $event,
                                                                                    colorIndex,
                                                                                    pictureIndex
                                                                                )"
                                                                            >

                                                                            {{-- EMPTY --}}
                                                                            <template x-if="!picture.preview">

                                                                                <div
                                                                                    class="absolute inset-0 flex items-center justify-center text-gray-400 text-sm"
                                                                                >
                                                                                    Bild hinzufügen
                                                                                </div>

                                                                            </template>

                                                                            {{-- REMOVE --}}
                                                                            <button
                                                                                x-show="picture.preview"
                                                                                type="button"
                                                                                @click="removeColorPicture(
                                                                                    colorIndex,
                                                                                    pictureIndex
                                                                                )"
                                                                                class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8"
                                                                            >
                                                                                ×
                                                                            </button>

                                                                        </div>

                                                                    </template>

                                                                </div>

                                                            </div>

                                                        </template>

                                                    </div>

                                                </template>

                                            </div>

                                        </template>

                                    </div>

                                    {{-- ACTIONS --}}
                                    <div class="mt-12 flex justify-end gap-4">

                                        <a
                                            href="{{ route('manage.show.products') }}"
                                            class="border border-gray-300 px-6 py-3 rounded-xl"
                                        >
                                            Abbrechen
                                        </a>

                                        <button
                                            type="button"
                                            @click="saveProduct()"
                                            class="bg-blue-900 hover:bg-blue-950 text-white px-8 py-3 rounded-xl"
                                        >
                                            Produkt speichern
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

            function productEditor() {

                return {

                    product:
                        @json($product),

                    categories:
                        @json($categories),

                    createUrl:
                        @json(route('manage.create.product')),

                    changeUrl:
                        @json(route('manage.change.product')),

                    name:
                        @json($product?->name ?? ''),

                    handle:
                        @json($product?->handle ?? ''),

                    description:
                        @json($product?->description ?? ''),

                    supplierName:
                        @json($product?->supplier_name ?? ''),

                    price:
                        @json($product?->price ?? ''),

                    categoryId:
                        @json($product?->category_id ?? ''),

                    originalCategoryId:
                        @json($product?->category_id ?? ''),

                    categoryChanged: false,

                    properties:
                        @json($product?->attributes['properties'] ?? []),

                    assets:
                        @json($product?->attributes['assets'] ?? []),

                    defaultPictures:
                        @json($product?->attributes['default_pictures'] ?? []),

                    init() {

                        if (!this.properties.print) {
                            this.properties.print = [];
                        }

                        if (!this.properties.color) {
                            this.properties.color = [];
                        }
                    },

                    onCategoryChange() {

                        if (
                            this.originalCategoryId
                            && this.categoryId != this.originalCategoryId
                        ) {
                            this.categoryChanged = true;
                        }
                    },

                    getDisplayName(key) {

                        const category =
                            this.categories.find(
                                c => c.category_id == this.categoryId
                            );

                        if (!category) {
                            return key;
                        }

                        return category.filters?.[key]?.displayName
                            ?? key;
                    },

                    getDefaultPictureSlots() {

                        const pictures =
                            [...this.defaultPictures];

                        while (pictures.length < 4) {

                            pictures.push({
                                preview: null,
                                file: null
                            });
                        }

                        return pictures.slice(0, 4);
                    },

                    getColorPictureSlots(color) {

                        const pictures =
                            [...(color.pictures ?? [])];

                        while (pictures.length < 4) {

                            pictures.push({
                                preview: null,
                                file: null
                            });
                        }

                        return pictures.slice(0, 4);
                    },

                    addPropertyValue(key) {

                        if (key === 'color') {

                            this.properties.color.push({

                                displayName: '',

                                value: '#ffffff',

                                externalId:
                                    crypto.randomUUID(),

                                pictures: []
                            });

                            return;
                        }

                        this.properties[key].push('');
                    },

                    removeColor(index) {

                        this.properties.color.splice(index, 1);
                    },

                    setDefaultPicture(event, index) {

                        const file =
                            event.target.files[0];

                        if (!file) {
                            return;
                        }

                        this.defaultPictures[index] = {

                            file,

                            preview:
                                URL.createObjectURL(file)
                        };
                    },

                    removeDefaultPicture(index) {

                        this.defaultPictures[index] = {

                            file: null,

                            preview: null
                        };
                    },

                    addAsset() {

                        this.assets.push({

                            position: '',

                            file: null
                        });
                    },

                    setAsset(event, index) {

                        this.assets[index].file =
                            event.target.files[0];
                    },

                    removeAsset(index) {

                        this.assets.splice(index, 1);
                    },

                    setColorPicture(
                        event,
                        colorIndex,
                        pictureIndex
                    ) {

                        const file =
                            event.target.files[0];

                        if (!file) {
                            return;
                        }

                        if (
                            !this.properties.color[
                                colorIndex
                            ].pictures
                        ) {

                            this.properties.color[
                                colorIndex
                            ].pictures = [];
                        }

                        this.properties.color[
                            colorIndex
                        ].pictures[pictureIndex] = {

                            file,

                            preview:
                                URL.createObjectURL(file)
                        };
                    },

                    removeColorPicture(
                        colorIndex,
                        pictureIndex
                    ) {

                        this.properties.color[
                            colorIndex
                        ].pictures[pictureIndex] = {

                            file: null,

                            preview: null
                        };
                    },

                    async saveProduct() {

                        if (this.product) {

                            const confirmed =
                                confirm(
                                    'Änderungen speichern?'
                                );

                            if (!confirmed) {
                                return;
                            }
                        }

                        try {

                            const formData =
                                new FormData();

                            formData.append(
                                'name',
                                this.name
                            );

                            formData.append(
                                'handle',
                                this.handle
                            );

                            formData.append(
                                'description',
                                this.description
                            );

                            formData.append(
                                'supplier_name',
                                this.supplierName
                            );

                            formData.append(
                                'price',
                                this.price
                            );

                            formData.append(
                                'category_id',
                                this.categoryId
                            );

                            formData.append(
                                'properties',
                                JSON.stringify(
                                    this.properties
                                )
                            );

                            /*
                            |--------------------------------------------------------------------------
                            | DEFAULT PICTURES
                            |--------------------------------------------------------------------------
                            */

                            this.defaultPictures
                                .forEach((picture, index) => {

                                    if (picture?.file) {

                                        formData.append(
                                            `default_pictures[${index}]`,
                                            picture.file
                                        );
                                    }
                                });

                            /*
                            |--------------------------------------------------------------------------
                            | ASSETS
                            |--------------------------------------------------------------------------
                            */

                            this.assets
                                .forEach((asset, index) => {

                                    formData.append(
                                        `assets[${index}][position]`,
                                        asset.position
                                    );

                                    if (asset.file) {

                                        formData.append(
                                            `assets[${index}][file]`,
                                            asset.file
                                        );
                                    }
                                });

                            /*
                            |--------------------------------------------------------------------------
                            | COLOR PICTURES
                            |--------------------------------------------------------------------------
                            */

                            this.properties.color
                                ?.forEach((color, colorIndex) => {

                                    color.pictures
                                        ?.forEach((picture, pictureIndex) => {

                                            if (picture?.file) {

                                                formData.append(
                                                    `color_pictures[${colorIndex}][${pictureIndex}]`,
                                                    picture.file
                                                );
                                            }
                                        });
                                });

                            const response =
                                await fetch(

                                    this.product
                                        ? this.changeUrl
                                        : this.createUrl,

                                    {

                                        method: 'POST',

                                        headers: {

                                            'X-CSRF-TOKEN':

                                                document
                                                    .querySelector(
                                                        'meta[name=\"csrf-token\"]'
                                                    )
                                                    .content
                                        },

                                        body: formData
                                    }
                                );

                            const data =
                                await response.json();

                            if (!response.ok) {

                                if (response.status === 500) {

                                    alert(
                                        data.message
                                        ?? 'Serverfehler'
                                    );
                                }

                                return;
                            }

                            window.location.href =
                                '/manage/products';

                        } catch(error) {

                            console.error(error);

                            alert(
                                'Netzwerkfehler'
                            );
                        }
                    }
                }
            }

        </script>

    </body>
</html>