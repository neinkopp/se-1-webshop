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
                            <div class="bg-[#f0f4f8] border border-blue-100 rounded-md p-4 flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-900 shrink-0">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-blue-900 text-xl font-medium">Zu Ihrer Sicherheit werden Ihre Bestellungen jeweils mit einem <b>Bestellungs-Token</b> versehen, der zur Einsichtnahme Ihrer Bestellung genutzt werden kann.</p>
                            </div>
                            <div class="bg-[#f4f0f0] border border-red-100 rounded-md p-4 flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="w-6 h-6 text-red-900 shrink-0">

                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.401 3.003c1.155-2.004 4.043-2.004 5.198 0l7.5 13.004c1.154 2.003-.29 4.493-2.599 4.493H4.5c-2.309 0-3.753-2.49-2.599-4.493l7.5-13.004ZM12 8.25a.75.75 0 0 0-.75.75v4.5a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" />
                                </svg>
                                <p class="text-red-900 text-xl font-medium">
                                    Sie haben Ihren <b>Bestellungs-Token</b> vergessen? Dann nehmen Sie mit uns 
                                    <a href="/contact" class="text-red-700 underline underline-offset-4 hover:text-red-500 transition-colors duration-200">Kontakt</a> auf.
                                </p>
                            </div>

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