@props(['label', 'name', 'value', 'required'])
<div>
    <label for="productInput{{ $name }}" class="block text-sm font-medium mb-2">{{ $label }}  {{ $required ? '*':'' }}</label>
    <select id="productInput{{ $name }}" class="w-full rounded-xl border border-gray-300 px-4 py-3" value="{{ $value }}">
        {{ $slot }}
    </select>
</div>