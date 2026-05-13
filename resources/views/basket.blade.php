<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

<div
    x-data="{
        mobileMenuOpen: false,
        sidebarOpen: false
    }"
    class="flex flex-col flex-1"
>

    {{-- HEADER --}}
    <x-header>
        <x-slot:actionsSlot>
            <x-header-actions />
        </x-slot:actionsSlot>
        <x-slot:behaviorSlot>
            <x-header-actions-mobile />
        </x-slot:behaviorSlot>
    </x-header>

    <div class="flex pt-24">

        {{-- MAIN CONTENT --}}
        <main class="w-full lg:ml-72">
            {{-- PRODUCTS --}}
            <section class="py-10 px-5 lg:px-10">

                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-5 lg:gap-8">

                </div>

            </section>
        </main>

    </div>
    <x-footer />

</div>

</body>
</html>