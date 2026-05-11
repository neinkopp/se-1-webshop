{{-- CATEGORY HEADER --}}
<div class="sticky top-24 z-30 bg-white border-b border-gray-300 shadow-sm">

    <div class="flex items-center overflow-x-auto">

        {{-- MOBILE FILTER BUTTON --}}
        <button @click="sidebarOpen = true" class="lg:hidden px-5 py-3 border-r font-medium whitespace-nowrap">
            {{ $sidePanelTitle }}
        </button>

        @foreach ($categories as $category)
            <a href="/products?category={{ $category->category_id }}" class="px-6 py-3 border-r whitespace-nowrap hover:bg-blue-50">
                {{ $category->name }}
            </a>
        @endforeach

    </div>

</div>