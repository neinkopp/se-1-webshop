@props(['title'])

<div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black/40 z-30 lg:hidden " @click="sidebarOpen = false"></div>
    <aside :class="sidebarOpen ? 'block' : 'hidden'" class="fixed h-full lg:h-auto lg:static lg:block w-72 border-r border-gray-200 bg-white overflow-y-auto flex-shrink-0 z-40">
        <div class="p-5">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">{{ $title }}</h2>
                <button @click="sidebarOpen = false" class="lg:hidden text-2xl">×</button>
            </div>
            {{ $slot }}
            <div class="lg:hidden block mt-20 pt-10"></div>
        </div>
    </aside>