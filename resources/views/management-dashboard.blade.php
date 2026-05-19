@php
    $translatedDays = [
        'monday' => 'Montag',
        'tuesday' => 'Dienstag',
        'wednesday' => 'Mittwoch',
        'thursday' => 'Donnerstag',
        'friday' => 'Freitag',
        'saturday' => 'Samstag',
        'sunday' => 'Sonntag',
    ];

    $chartLabels = array_map(fn($day) => $translatedDays[$day], array_keys($lastWeekSalesCount));
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')

    <body class="bg-gray-50 text-gray-800 h-screen flex flex-col overflow-x-hidden" x-data="dashboardData()">

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
                                    Dashboard
                                </h1>

                                <p class="text-gray-500 mt-1">
                                    Übersicht
                                </p>
                            </div>

                            {{-- STATS --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                                {{-- CARD --}}
                                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 flex items-center gap-5">

                                    <div class="w-16 h-16 rounded-xl bg-blue-800 flex items-center justify-center text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-8 h-8"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 5h13M10 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-gray-500 text-sm">
                                            Bestellungen
                                        </p>

                                        <h2 class="text-4xl font-bold text-blue-900">
                                            <span x-text="stats.orders"></span>
                                        </h2>
                                    </div>
                                </div>

                                {{-- CARD --}}
                                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 flex items-center gap-5">

                                    <div class="w-16 h-16 rounded-xl bg-blue-800 flex items-center justify-center text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-8 h-8"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-gray-500 text-sm">
                                            Verkaufte Produkte
                                        </p>

                                        <h2 class="text-4xl font-bold text-blue-900">
                                            <span x-text="stats.products"></span>
                                        </h2>
                                    </div>
                                </div>

                                {{-- CARD --}}
                                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 flex items-center gap-5">

                                    <div class="w-16 h-16 rounded-xl bg-blue-800 flex items-center justify-center text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-8 h-8"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-gray-500 text-sm">
                                            Meistverkauftes Produkt
                                        </p>

                                        <h4 class="text-xl font-bold text-blue-900">
                                            <span x-text="stats.mostSoldProduct"></span>
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            {{-- CHART --}}
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">

                                <div class="flex items-center justify-between mb-8">

                                    <div>
                                        <h2 class="text-2xl font-bold text-blue-900">
                                            Verkäufe
                                        </h2>

                                        <p class="text-gray-500 mt-1">
                                            Verkäufe der letzten Tage
                                        </p>
                                    </div>

                                    <select
                                        class="rounded-xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-800"
                                    >
                                        <option>Letzte 7 Tage</option>
                                    </select>
                                </div>

                                <div class="h-[400px]">
                                    <canvas id="salesChart"></canvas>
                                </div>
                            </div>

                        </section>

                        {{-- FOOTER --}}
                        <x-footer />

                    </main>
                </div>
            </div>
        </div>

        {{-- CHART.JS --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const salesData = @json(array_values($lastWeekSalesCount));
            const labels = @json(array_values($chartLabels));
            console.log(salesData, labels);
            function dashboardData() {
                return {
                    stats: {
                        orders: {{ $orderCount }},
                        products: {{ $soldProductsCount }},
                        mostSoldProduct: "{{ $mostSoldProductName }}"
                    },

                    init() {

                        this.renderChart();
                    },

                    renderChart() {

                        const ctx = document
                            .getElementById('salesChart')
                            .getContext('2d');

                        new Chart(ctx, {

                            type: 'line',

                            data: {

                                labels: labels,

                                datasets: [{
                                    label: 'Verkäufe',

                                    data: salesData,

                                    borderColor: '#1E3A8A',

                                    backgroundColor: 'rgba(30, 58, 138, 0.1)',

                                    tension: 0.4,

                                    fill: true,

                                    pointRadius: 5,

                                    pointHoverRadius: 7
                                }]
                            },

                            options: {

                                responsive: true,

                                maintainAspectRatio: false,

                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },

                                scales: {

                                    y: {
                                        beginAtZero: true,

                                        ticks: {
                                            stepSize: 10
                                        }
                                    }
                                }
                            }
                        });
                    }
                }
            }
        </script>

    </body>
</html>