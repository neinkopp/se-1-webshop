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

                                            Eigenschaften von {{ $product->name }}

                                        </h1>

                                        <p class="text-gray-500 mt-2">
                                            Bestimmen Sie die Auswahlmöglichkeiten für die Eigenschaften des Produkts. Separieren Sie Ihre Eingaben durch Komma
                                        </p>

                                    </div>
                                    
                                    <div class="grid grid-cols-1 gap-10 mt-8">
                                        <div class="space-y-6">
                                            @foreach($product->attributes['properties'] as $key => $values)
                                                @continue($key === 'color')
                                                <div>
                                                    <label class="block text-sm font-medium mb-2">
                                                        {{ $values['displayName'] ?? $key }}
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="attribute_{{ $key }}"
                                                        value="{{ implode(',', $values['values']) }}"
                                                        class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                    >
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="flex flex-1 gap-3 mt-5 items-center justify-between w-full">
                                            <a href="/manage/products" class="bg-gray-900 hover:bg-gray-950 text-white px-8 py-3 rounded-xl">
                                                Abbrechen
                                            </a>
                                            <button type="button" @click="saveAttributes()" class="bg-blue-900 hover:bg-blue-950 text-white px-8 py-3 rounded-xl">
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
            async function saveAttributes() {
                const formData =
                    new FormData();

                formData.append(
                    'handle',
                    '{{ $product->handle }}'
                );

                @foreach($product->attributes['properties'] as $key => $values)

                    @continue($key === 'color')

                    formData.append(
                        '{{ $key }}',
                        document.getElementById(
                            'attribute_{{ $key }}'
                        ).value
                    );

                @endforeach

                const response =
                    await fetch(
                        '/manage/products/changeAttributes',
                        {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN':
                                    document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content
                            },
                            body: formData
                        }
                    );
                const data = await response.json();
                if (!response.ok) {
                    alert(data.message ?? 'Es ist ein unbekannter Fehler aufgetreten, versuchen Sie es zu einem späterem Zeitpunkt erneut.');
                    return false;
                }
                window.location.href = '/manage/products/pictures/{{ $product->handle }}';
            }
        </script>

    </body>
</html>