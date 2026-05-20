<div class="bg-[#f4f0f0] border border-red-100 rounded-md p-4 flex items-center gap-3">
    <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        class="w-6 h-6 text-red-900 shrink-0">

        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M9.401 3.003c1.155-2.004 4.043-2.004 5.198 0l7.5 13.004c1.154 2.003-.29 4.493-2.599 4.493H4.5c-2.309 0-3.753-2.49-2.599-4.493l7.5-13.004ZM12 8.25a.75.75 0 0 0-.75.75v4.5a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" />
    </svg>
    <p class="text-red-900 text-xl font-medium">
        {{ $slot }}
    </p>
</div>