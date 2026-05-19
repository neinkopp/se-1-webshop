{{-- MOBILE ACTION DRAWER --}}
<div x-show="mobileMenuOpen" x-transition class="fixed inset-0 z-[60] bg-black/40 lg:hidden" @click="mobileMenuOpen = false"></div>

<div x-show="mobileMenuOpen" x-transition class="fixed top-0 right-0 z-[70] h-full w-72 bg-white shadow-2xl lg:hidden">
    <div class="p-6 border-b flex justify-between items-center">
        <h2 class="text-xl font-bold">Menu</h2>
        <button @click="mobileMenuOpen = false" class="text-2xl">×</button>
    </div>
    <div class="p-6 space-y-6">
        <a href="/logout" class="block text-lg hover:text-blue-600">Abmelden</a>
    </div>
</div>