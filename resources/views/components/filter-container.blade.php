{{-- FILTERS --}}
<form method="GET" action="{{ url()->current() }}">
    <x-filter-section title="Preis">
            <x-filter-range
                :min="''"
                :max="''"
                :minValue="'0'"
                :maxValue="''"
            />
    </x-filter-section>

    @foreach ($filters as $filterName => $filter)

        <x-filter-section title="{{ $filter['displayName'] }}">

        @switch($filter['type'])
            @case("select")
                <x-filter-select 
                :options="$filter['options']"
                :title="$filterName"
                />
                @break
            @case("color")
                <x-filter-color-select 
                :colors="$filter['options']"
                />
                @break
            @default
                
        @endswitch

        </x-filter-section>
        
    @endforeach


    <input type="text" name="category" value="{{ $category }}" hidden>
    <button type="submit" class="mt-8 w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-lg transition">Anwenden</button>
</form>