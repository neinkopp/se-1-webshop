@props(['href'])
<a class="hover:text-indigo-600" href="{{ $href }}">
    {{ $slot }}
</a>