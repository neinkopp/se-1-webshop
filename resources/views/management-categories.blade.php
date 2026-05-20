
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

                        <section class="py-10 px-5 lg:px-10 space-y-8">
                            {{-- PAGE TITLE --}}
                            <div>
                                <h1 class="text-3xl font-bold text-blue-900">
                                    Kategorien verwalten
                                </h1>

                                <p class="text-gray-500 mt-1">
                                    Wählen Sie die Kategorie zum Ändern aus, löschen Sie Kategorien oder legen Sie eine neue Kategorie an.
                                </p>
                            </div>
                            <div class="flex flex-1 gap-10 flex-col">
                                @for ($i = 0; $i < count($categories); $i++)
                                    <x-management-link
                                        :label="$categories[$i]->name"
                                        :href="'/manage/categories/'.$categories[$i]->category_id"
                                        :deletion_href="'/manage/categories/'.$categories[$i]->category_id.'/delete'"
                                        :image_source="Vite::asset('resources/images/basket.svg')"
                                        :image_background_color="'blue-800'"
                                    />
                                @endfor
                                <x-management-link
                                    :label="'Neue Kategorie anlegen'"
                                    :href="'/manage/categories/new'"
                                    :deletion_href="''"
                                    :image_source="Vite::asset('resources/images/new.svg')"
                                    :image_background_color="'blue-800'"
                                />
                            </div>
                        </section>

                        {{-- FOOTER --}}
                        <x-footer />

                    </main>
                </div>
            </div>
        </div>
    </body>
</html>