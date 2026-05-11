@props([
    'min' => '',
    'max' => '',
    'minValue',
    'maxValue'
])
<div class="space-y-2">
    <input
        type="number"
        placeholder="Min"
        steps="1"
        name="priceMin"
        value="{{ $min }}"
        max="{{ $maxValue }}"
        min="{{ $minValue }}"
        class="w-full border rounded-lg px-3 py-2"
    >

    <input
        type="number"
        placeholder="Max"
        steps="1"
        name="priceMax"
        value="{{ $max }}"
        max="{{ $maxValue }}"
        min="{{ $minValue }}"
        class="w-full border rounded-lg px-3 py-2"
    >
</div>