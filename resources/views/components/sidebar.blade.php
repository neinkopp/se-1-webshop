{{-- SIDEBAR OVERLAY MOBILE --}}

@props(['title'])

<div
    x-show="sidebarOpen"
    x-transition
    class="fixed inset-0 bg-black/40 z-40 lg:hidden"
    @click="sidebarOpen = false"
>
</div>

{{-- SIDEBAR --}}
<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-[100%]'"
    class="fixed top-24 left-0 z-50 w-72 h-[calc(100vh-6rem)]
            bg-white border-r border-gray-200 shadow-lg
            overflow-y-auto transition-transform duration-300
            lg:translate-x-0"
>
{{-- MOBILE FILTER HANDLE --}}
<button
    @click="sidebarOpen = !sidebarOpen"
    class="absolute top-10 -right-12 lg:hidden
        bg-blue-700 text-white
        px-3 py-4 rounded-r-xl shadow-lg
        rotate-0"
>
</button>

    <div class="p-5">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">{{ $title }}</h2>
            <button @click="sidebarOpen = false" class="lg:hidden text-2xl">×</button>
        </div>
        {{ $slot }}
    </div>

</aside>