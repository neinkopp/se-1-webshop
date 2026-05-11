@props([
    'title',
    'options' => [],
    'selected' => [],
])

@foreach ($options as $option)

    <label class="flex items-center justify-between border rounded-lg px-3 py-2 cursor-pointer hover:bg-blue-50 transition">

        <div class="flex items-center gap-3">

            <input
                type="checkbox"
                name="{{ $title }}[]"
                value="{{ $option }}"
                {{ in_array($option, $selected) ? 'checked' : '' }}
            >

            <span>
                {{ $option }}
            </span>

        </div>

    </label>

@endforeach