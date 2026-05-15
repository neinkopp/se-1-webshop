<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
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
    
    <div class="container mx-auto px-6 py-12">
        <x-product-detail  :product="$product"/>
        <x-featured-products :featuredProducts="$featuredProducts" />
    </div>

    <x-footer />
</div>

</body>
</html>