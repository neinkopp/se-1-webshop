<a {{ $attributes->merge([
    'class' => 'hover:text-indigo-600',
    'href' => '#'
]) }}>
    {{ $slot }}
</a>