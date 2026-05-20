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
            <div class="flex flex-1 overflow-hidden">

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
                                            Grundinformationen verwalten
                                        </p>

                                    </div>
                                    
                                    <div class="grid grid-cols-1 gap-10 mt-8">

                                        <div class="space-y-6">

                                            <x-management-product-input-text 
                                                label="Anzeigename"
                                                :value="$product?->name"
                                                :required="true"
                                                name="name"
                                            />
                                            <x-management-product-input-text 
                                                label="Technischer Name"
                                                :value="$product?->handle"
                                                :required="true"
                                                name="handle"
                                            />
                                            <x-management-product-input-number
                                                label="Preis"
                                                :value="$product?->price"
                                                :required="true"
                                                name="price"
                                                step="0.01"
                                            />
                                            <x-management-product-input-select label="Kategorie" :value="$product?->category_id" :required="true" name="category_id">
                                                @foreach($categories as $category)
                                                    <x-management-product-input-option :label="$category->name" :value="$category->category_id" :selected="$product?->category_id == $category->category_id"/>
                                                @endforeach
                                            </x-management-product-input-select>

                                            <x-management-product-input-select label="Lieferant (Druckshop)" :value="$product?->supplier_name" :required="true" name="supplier_name">
                                                @foreach($suppliers as $supplier)
                                                    <x-management-product-input-option :label="$supplier->display_name" :value="$supplier->supplier_name" :selected="$product?->supplier_name == $supplier->supplier_name"/>
                                                @endforeach
                                            </x-management-product-input-select>
                                        </div>
                                        <x-management-product-input-text-area
                                            label="Produktbeschreibung"
                                            :value="$product?->description"
                                            :required="false"
                                            name="description"
                                        />
                                        <div class="flex flex-1 gap-3 mt-5 items-center justify-between w-full">
                                            <a href="/manage/products" class="bg-gray-900 hover:bg-gray-950 text-white px-8 py-3 rounded-xl">
                                                Abbrechen
                                            </a>
                                            <button type="button" @click="saveProduct()" class="bg-blue-900 hover:bg-blue-950 text-white px-8 py-3 rounded-xl">
                                                Produkt speichern und fortfahren
                                            </button>
                                        </div>
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
            async function saveProduct(event) {
                const isNew = {{ $product ? 'false':'true' }};
                if(!isNew) {
                    const oldCategory = '{{ $product?->category_id }}';
                    const newCategory = document.getElementById('productInputcategory_id').value != oldCategory;
                    let confirmed = false;
                    if (newCategory) {
                        confirmed = confirm('Wenn Sie diese Aktion ausführen, werden die Eigenschaften des Produktes komplett zurückgesetzt. Sind Sie sicher, dass Sie speichern möchten?');
                    } else {
                        confirmed = confirm('Diese Aktion kann nicht rückgängig gemacht werden. Sind Sie sicher, dass Sie speichern möchten?');
                    }
                    if (!confirmed) {
                        return false;
                    }
                }

                try {
                    const formData = new FormData();

                    formData.append('name', document.getElementById('productInputname').value);
                    formData.append('handle', document.getElementById('productInputhandle').value);
                    formData.append('price', document.getElementById('productInputprice').value);
                    formData.append('description', document.getElementById('productInputdescription').value);
                    formData.append('supplier_name', document.getElementById('productInputsupplier_name').value);
                    formData.append('category_id', document.getElementById('productInputcategory_id').value);

                    document.getElementById('productInputhandle').value
                    const response = await fetch(isNew ? "/manage/products/create" : "/manage/products/change",
                    {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN':
                                document.querySelector('meta[name=\"csrf-token\"]').content
                        },
                        body: formData
                    });
                    const data = await response.json();
                    if (!response.ok) {
                        if (response.status === 500) {
                            alert(data.message ?? 'Es ist ein unbekannter Fehler aufgetreten, versuchen Sie es zu einem späterem Zeitpunkt erneut.');
                        }
                        return false;
                    }
                    window.location.href = '/manage/products/attributes/' + document.getElementById('productInputhandle').value;
                } catch(error) {
                    console.error(error);
                    alert('Es ist ein unbekannter Netzwerkfehler aufgetreten, versuchen Sie es zu einem späterem Zeitpunkt erneut.');
                }
                
            }
        </script>

    </body>
</html>