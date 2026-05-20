<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body class="bg-gray-50 text-gray-800 h-screen flex flex-col overflow-x-hidden">
        <div x-data="{mobileMenuOpen: false}">
            {{-- Header --}}
            <x-header>
                <x-slot:actionsSlot>
                    <x-header-actions />
                </x-slot:actionsSlot>
                <x-slot:behaviorSlot>
                    <x-header-actions-mobile />
                </x-slot:behaviorSlot>
            </x-header>

            <div class="flex pt-24 flex-1">
                
                <main class="w-full max-w-7xl mx-auto px-5 lg:px-10 pb-20">
                    <section class="py-6">
                        <h1 class="text-3xl font-bold text-blue-900">
                            Ihre Bestellung anzeigen
                        </h1>
                    </section>

                    {{-- CART LAYOUT --}}
                    <section class="flex flex-col lg:flex-row gap-8 items-start">
                        <div class="flex-1 w-full space-y-6">
                            <div class="bg-white border border-gray-200 rounded-md shadow-sm">
                                <div class="bg-gray-50 border-b border-gray-200 px-5 py-3 flex justify-between items-center rounded-t-md">
                                    <h3 class="font-bold text-blue-900">Geben Sie bitte Ihren Bestellungstoken ein</h3>
                                </div>

                                <div class="divide-y divide-gray-100" x-data="{ token: '' }">
                                    <form class="space-y-4 w-full" :action="`/orders/${token}`" method="GET">
                                        <div class="flex flex-1 gap-1 items-center m-2 sm:flex-row flex-col">
                                            <label for="token" class="block text-l font-medium text-gray-700 mb-1 mt-1 text-nowrap">Bestellungstoken:</label>
                                            <input required id="token" type="text" x-model="token" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500transition mt-1 mb-1">
                                            <button
                                            class="inline-flex items-center justify-center px-5 py-2
                                                bg-blue-600 text-white font-medium rounded-md
                                                hover:bg-blue-700 active:bg-blue-800
                                                transition-colors duration-200
                                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-nowrap mb-1 mt-1"
                                        >Bestellung anzeigen</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <x-info>
                                Zu Ihrer Sicherheit werden Ihre Bestellungen jeweils mit einem <b>Bestellungs-Token</b> versehen, der zur Einsichtnahme Ihrer Bestellung genutzt werden kann.
                            </x-info>
                            <x-warning>
                                Sie haben Ihren <b>Bestellungs-Token</b> vergessen? Dann nehmen Sie mit uns 
                                <a href="/contact" class="text-red-700 underline underline-offset-4 hover:text-red-500 transition-colors duration-200">Kontakt</a> auf.
                            </x-warning>

                            {{-- BACK BUTTON --}}
                            <div class="pt-2">
                                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 border border-blue-900 text-blue-900 px-5 py-2.5 rounded hover:bg-gray-100 transition font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                    Weiter einkaufen
                                </a>
                            </div>
                        </div>
                    </section>
                </main>

            </div>
            <x-footer />

        </div>
        </div>
    </body>
</html>