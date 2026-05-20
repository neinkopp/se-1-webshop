@props(['label', 'name', 'value', 'required', 'step'])
<div>
    <label for="productInput{{ $name }}" class="block text-sm font-medium mb-2">{{ $label }}  {{ $required ? '*':'' }}</label>
    <input id="productInput{{ $name }}" type="number" step="{{ $step }}" name="{{ $name }}" class="w-full rounded-xl border border-gray-300 px-4 py-3" {{ $required ? 'required':'' }} value="{{ $value }}">
</div>