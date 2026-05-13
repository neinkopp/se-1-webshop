@props([
    'colors' => [],
    'selected' => [],
])
@foreach ($colors as $color)

<labelclass="flex items-center justify-between border rounded-lg px-3 py-2 cursor-pointer hover:bg-blue-50 transition">

    <div class="flex items-center gap-3">

        <input
            type="checkbox"
            name="color[]"
            value="{{ $color['displayName'] }}"
            {{ in_array($color['displayName'], $selected) ? 'checked' : '' }}
        >

        {{-- COLOR PREVIEW --}}
        <div class="w-5 h-5 rounded-full border" style="background-color: {{ $color['value'] }}ff"></div>

        {{-- ACCESSIBLE LABEL --}}
        <span>
            {{ $color['displayName'] }}
        </span>

    </div>

</label>

@endforeach