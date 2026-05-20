
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
                        :sidePanelTitle="'Dashboard'"
                        :categories="[]"
                    />

                    {{-- SCROLLABLE CONTENT --}}
                    <main class="flex-1 overflow-y-auto min-w-0">

                        <section class="py-10 px-5 lg:px-10 mb-20" x-data="categoryEditor()">

                            <div class="max-w-5xl mx-auto">

                                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

                                    <div class="flex items-center justify-between mb-8">

                                        <div>
                                            <h1 class="text-3xl font-bold text-gray-900">

                                                {{ $category ? $category->name.' bearbeiten' : 'Kategorie erstellen' }}

                                            </h1>

                                            <p class="text-gray-500 mt-2">
                                                Filter und Eigenschaften verwalten
                                            </p>
                                        </div>
                                    </div>

                                    {{-- CATEGORY NAME --}}
                                    <div class="mb-8">

                                        <label class="block text-sm font-medium mb-2">
                                            Kategoriename
                                        </label>

                                        <input
                                            x-model="name"
                                            type="text"
                                            class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                            placeholder="T-Shirts"
                                        >
                                    </div>

                                    {{-- FILTERS --}}
                                    <div class="space-y-5">

                                        <div class="flex items-center justify-between">

                                            <h2 class="text-xl font-bold">
                                                Filter
                                            </h2>

                                            <button
                                                @click="addFilter()"
                                                type="button"
                                                class="bg-black text-white px-5 py-2 rounded-xl"
                                            >
                                                Filter hinzufügen
                                            </button>
                                        </div>

                                        <template
                                            x-for="(filter, index) in filters"
                                            :key="index"
                                        >

                                            <div class="border border-gray-200 rounded-2xl p-5">

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                                    {{-- KEY --}}
                                                    <div>

                                                        <label class="block text-sm mb-2">
                                                            Filter Key
                                                        </label>

                                                        <input
                                                            x-model="filter.key"
                                                            type="text"
                                                            class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                            placeholder="Technischer Name"
                                                        >
                                                    </div>

                                                    {{-- DISPLAY NAME --}}
                                                    <div>

                                                        <label class="block text-sm mb-2">
                                                            Anzeigename
                                                        </label>

                                                        <input
                                                            x-model="filter.displayName"
                                                            type="text"
                                                            class="w-full rounded-xl border border-gray-300 px-4 py-3"
                                                            placeholder="Anzeigename"
                                                        >
                                                    </div>
                                                </div>

                                                <div
                                                    class="mt-5 flex justify-end"
                                                    x-show="filter.key !== 'print'"
                                                >

                                                    <button
                                                        @click="removeFilter(index)"
                                                        type="button"
                                                        class="text-red-600 hover:text-red-800"
                                                    >
                                                        Entfernen
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    {{-- SAVE --}}
                                    <div class="mt-10 flex justify-end mb-10">

                                        <button
                                            @click="saveCategory()"
                                            type="button"
                                            class="bg-blue-900 hover:bg-blue-950 text-white px-8 py-3 rounded-xl"
                                        >
                                            Speichern
                                        </button>
                                    </div>

                                    <x-warning>Das Ändern von Filtern wirkt sich auf Produkte dieser Kategorie aus. Die Produkteigenschaften des geänderten Filters werden zurückgesetzt und müssen erneut gepflegt werden.</x-warning>
                                </div>
                            </div>

                            <script>

                                function categoryEditor() {

                                    return {

                                        categoryId:
                                            @json($category?->category_id),

                                        name:
                                            @json($category?->name ?? ''),

                                        filters:
                                            @json(
                                                collect($category?->filters ?? [])
                                                    ->map(function($filter, $key) {
                                                        return [
                                                            'key' => $key,
                                                            'displayName' => $filter['displayName']
                                                        ];
                                                    })
                                                    ->values()
                                            ),

                                        addFilter() {

                                            this.filters.push({
                                                key: '',
                                                displayName: ''
                                            });
                                        },

                                        removeFilter(index) {

                                            this.filters.splice(index, 1);
                                        },

                                        async saveCategory() {
                                            try {

                                                if (this.categoryId) {
                                                    if (!confirm('Bist du sicher, dass du die ' + this.name + '-Kategorie ändern möchtest? Diese Aktion wirkt sich auf Produkte dieser Kategorie aus.')) return;
                                                }

                                                const payload = {
                                                    name: this.name,
                                                    filters: this.filters
                                                };

                                                const url = this.categoryId
                                                    ? @json(route('manage.change.category'))
                                                    : @json(route('manage.create.category'));

                                                if (this.categoryId) {

                                                    payload.category_id =
                                                        this.categoryId;
                                                }

                                                const response = await fetch(url, {

                                                    method: 'POST',

                                                    headers: {
                                                        'Content-Type': 'application/json',

                                                        'X-CSRF-TOKEN': document
                                                            .querySelector(
                                                                'meta[name="csrf-token"]'
                                                            )
                                                            .content
                                                    },

                                                    body: JSON.stringify(payload)
                                                });

                                                /*
                                                |--------------------------------------------------------------------------
                                                | HANDLE ERRORS
                                                |--------------------------------------------------------------------------
                                                */

                                                if (!response.ok) {

                                                    let errorMessage =
                                                        'Ein Fehler ist aufgetreten, bitte versuchen Sie es erneut.';

                                                    try {

                                                        const errorData =
                                                            await response.json();

                                                        errorMessage =
                                                            errorData.message
                                                            ?? errorMessage;

                                                    } catch (_) {}

                                                    alert(errorMessage);

                                                    return;
                                                }

                                                window.location.href =
                                                    @json(route('manage.show.categories'));

                                            } catch (error) {

                                                console.error(error);

                                                alert(
                                                    'Es ist Fehler aufgetreten, bitte versuchen Sie es erneut.'
                                                );
                                            }
                                        }
                                    }
                                }
                            </script>
                        </section>

                        {{-- FOOTER --}}
                        <x-footer />

                    </main>
                </div>
            </div>
        </div>
    </body>
</html>