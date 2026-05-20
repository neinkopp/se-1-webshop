@props(['value', 'label', 'selected'])
<option value="{{ $value }}" {{ $selected?'selected':'' }}>
    {{ $label }}
</option>