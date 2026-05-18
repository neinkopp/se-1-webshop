<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body class="bg-gray-50 text-gray-800 h-screen flex flex-col overflow-x-hidden">
        <div x-data="{mobileMenuOpen: false, sidebarOpen: false}" class="h-screen flex flex-col h-full overflow-x-hidden">

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
                    <x-management-actions-container/>
                </x-sidebar>

                <div class="flex flex-1 overflow-hidden flex-col">
                    <x-content-header
                        :sidePanelTitle="'Verwalten'"
                        :categories="[]"
                    />
                    {{-- SCROLLABLE CONTENT --}}
                    <main class="flex-1 overflow-y-auto min-w-0">

                        {{-- PRODUCTS --}}
                        <section class="py-10 px-5 lg:px-10">

                            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-5 lg:gap-8">

                                Karak-A-Karaz

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